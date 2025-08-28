<?php
require_once __DIR__ . '/config.php';

$slug = $_GET['code'] ?? '';
if (!$slug) {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('~/file/([a-zA-Z0-9]+)~', $uri, $m)) { $slug = $m[1]; }
}
if (!$slug) { echo 'Missing link code'; exit; }

$stmt = $mysqli->prepare("SELECT l.id, l.permissions, d.filepath FROM links l JOIN documents d ON l.document_id=d.id WHERE l.slug=?");
$stmt->bind_param('s', $slug);
$stmt->execute();
$stmt->bind_result($linkId, $permJson, $filepath);
if (!$stmt->fetch()) { echo 'Invalid link'; exit; }
$stmt->close();

$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
$pdfUrl   = $basePath . '/' . ltrim($filepath, '/');

$perms = json_decode($permJson, true) ?? [];
if (!empty($perms['analytics'])) {
    $ins = $mysqli->prepare("INSERT INTO link_analytics (link_id, event) VALUES (?, 'view')");
    $ins->bind_param('i', $linkId);
    $ins->execute();
}
$allowDownload = !empty($perms['download']);
$allowSearch   = !empty($perms['search']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Premium PDF Viewer</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.css"/>

<style>
  /* ---------- THEME VARIABLES ---------- */
  :root{
    --bg:#f6f7fb; --panel:#ffffff; --ink:#111827; --muted:#6b7280; --border:#e5e7eb;
    --brand:#6366f1; --brand-2:#8b5cf6; --radius:12px; --shadow:0 4px 22px rgba(2,8,20,.05),0 1px 2px rgba(2,8,20,.05);
    --trans-panel: rgba(255,255,255,.86); --bottombar-h:56px;
  }
  [data-theme="dark"]{
    --bg:#0f1115; --panel:#0f141c; --ink:#e5e7eb; --muted:#9aa4b2; --border:#1f2937; --trans-panel: rgba(17,20,26,.85);
  }

  *{ box-sizing:border-box }
  html,body{ height:100% }
  body{ margin:0; background:var(--bg); color:var(--ink); font-family:Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif; }

  /* Top toolbar */
  .topbar{
    position:sticky; top:0; z-index:30; backdrop-filter:saturate(180%) blur(8px);
    background:var(--trans-panel); border-bottom:1px solid var(--border);
    display:flex; gap:10px; align-items:center; padding:10px 14px;
  }
  .brand{ display:flex; align-items:center; gap:10px; font-weight:800; letter-spacing:.3px; }
  .brand i{ color:var(--brand); font-size:1.1rem; }
  .toolbar-group{ display:flex; align-items:center; gap:8px; }
  .btn{
    border:1px solid var(--border); background:var(--panel); color:var(--ink);
    border-radius:10px; padding:.45rem .65rem; line-height:1; display:inline-flex; align-items:center; gap:.35rem;
    cursor:pointer; box-shadow:var(--shadow);
  }
  .btn:hover{ border-color:#c7cdd6; }
  [data-theme="dark"] .btn:hover{ border-color:#334155; }
  .btn-primary{ background:linear-gradient(90deg,var(--brand),var(--brand-2)); border:0; color:#fff; }
  .btn-pill{ border-radius:999px; }
  .sep{ width:1px; height:28px; background:var(--border); margin:0 4px; }
  .search{
    display:flex; align-items:center; gap:6px; border:1px solid var(--border); background:var(--panel);
    border-radius:10px; padding:0 .5rem; box-shadow:var(--shadow);
  }
  .search input{
    border:0; outline:0; height:36px; width:240px; padding:0 .25rem; background:transparent; color:var(--ink); font:inherit;
  }
  .scale{ min-width:64px; text-align:center; font-variant-numeric:tabular-nums; }

  /* Layout */
  .sheet{ display:grid; grid-template-columns:260px 1fr; gap:14px; padding:14px; height:calc(100vh - 72px); }
  .panel{ background:var(--panel); border:1px solid var(--border); border-radius:var(--radius); box-shadow:var(--shadow); }

  /* Sidebar */
  .sidebar{ overflow:auto; height:100%; }
  .sidebar-head{ padding:10px 12px; border-bottom:1px solid var(--border); font-weight:700; }
  #thumbnailView{ padding:12px; display:grid; gap:12px; }
  .thumb{ border:1px solid var(--border); border-radius:10px; overflow:hidden; background:#fafafa; cursor:pointer; transition:.15s; padding:6px; }
  .thumb:hover{ transform:translateY(-1px); box-shadow:var(--shadow); }
  .thumb.selected{ outline:2px solid var(--brand); outline-offset:2px; }
  .thumb canvas{ display:block; width:100%; }
  [data-theme="dark"] .thumb{ background:#0b0f16; }

  /* Viewer */
  .panel.viewer-panel{ position:relative; }
  #viewerContainer{
    position:absolute; top:0; left:0; right:0; bottom:var(--bottombar-h);
    overflow:auto; border-top-left-radius:var(--radius); border-top-right-radius:var(--radius);
  }
  .pdfViewer .page{ margin:10px auto; border:1px solid var(--border); border-radius:10px; overflow:hidden; box-shadow:var(--shadow); background:#fff; }

  /* Bottom controls */
  .bottombar{
    position:absolute; bottom:0; left:0; right:0; height:var(--bottombar-h);
    display:flex; align-items:center; justify-content:space-between; gap:10px;
    padding:10px 12px; border-top:1px solid var(--border); background:var(--panel);
    border-bottom-left-radius:var(--radius); border-bottom-right-radius:var(--radius);
  }
  .muted{ color:var(--muted); }

  @media (max-width:1024px){
    .sheet{ grid-template-columns:1fr; }
    .sidebar{ order:2; }
  }
</style>
</head>
<body>

<!-- Top toolbar -->
<div class="topbar">
  <div class="brand"><i class="bi bi-file-earmark-text"></i><span>Premium Viewer</span></div>

  <div class="toolbar-group">
    <button class="btn" id="prevPage" title="Previous"><i class="bi bi-chevron-left"></i></button>
    <div class="btn scale" id="pageScale">100%</div>
    <button class="btn" id="nextPage" title="Next"><i class="bi bi-chevron-right"></i></button>
    <span class="sep"></span>
    <button class="btn" id="fitWidth" title="Fit width"><i class="bi bi-arrows-fullscreen"></i></button>
    <button class="btn" id="fitPage"  title="Fit page"><i class="bi bi-aspect-ratio"></i></button>
    <button class="btn" id="zoomOut"  title="Zoom out"><i class="bi bi-zoom-out"></i></button>
    <button class="btn" id="zoomIn"   title="Zoom in"><i class="bi bi-zoom-in"></i></button>
    <button class="btn" id="rotate"   title="Rotate 90°"><i class="bi bi-arrow-repeat"></i></button>
    <span class="sep"></span>
    <button class="btn" id="toggleSidebar" title="Toggle thumbnails"><i class="bi bi-layout-sidebar-inset"></i></button>
    <button class="btn" id="fullscreen" title="Fullscreen"><i class="bi bi-fullscreen"></i></button>
  </div>

  <div class="toolbar-group" style="margin-left:auto">
    <?php if($allowSearch){ ?>
    <div class="search" id="searchBoxWrap">
      <i class="bi bi-search" style="opacity:.7"></i>
      <input type="text" id="searchInput" placeholder="Find in document…">
      <button class="btn btn-pill" id="findPrev"><i class="bi bi-chevron-up"></i></button>
      <button class="btn btn-pill" id="findNext"><i class="bi bi-chevron-down"></i></button>
    </div>
    <div class="muted" id="matchCount" style="min-width:90px;text-align:right">&nbsp;</div>
    <?php } ?>

    <?php if($allowDownload){ ?>
      <a class="btn btn-primary" id="btnDownload" href="<?php echo htmlspecialchars($pdfUrl); ?>" download>
        <i class="bi bi-download"></i> Download
      </a>
    <?php } ?>

    <!-- Theme toggle only -->
    <button class="btn" id="toggleTheme" title="Toggle theme"><i class="bi bi-moon-stars"></i></button>
  </div>
</div>

<!-- Content -->
<div class="sheet">
  <!-- Sidebar -->
  <div class="panel sidebar" id="sidebar">
    <div class="sidebar-head">Thumbnails</div>
    <div id="thumbnailView"></div>
  </div>

  <!-- Viewer -->
  <div class="panel viewer-panel">
    <div id="viewerContainer" class="viewerContainer">
      <div id="viewer" class="pdfViewer"></div>
    </div>
    <div class="bottombar">
      <div class="toolbar-group">
        <span class="muted">Page</span>
        <input type="number" id="pageNumber" min="1" value="1" style="width:74px;height:36px;border:1px solid var(--border);border-radius:10px;padding:0 .5rem;background:var(--panel);color:var(--ink)">
        <span class="muted">/ <span id="pageCount">—</span></span>
      </div>
      <div class="muted" id="statusText">Loading…</div>
    </div>
  </div>
</div>

<!-- PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.js"></script>
<script>
(() => {
  /* -------- Theme boot (no flicker) -------- */
  const savedTheme = localStorage.getItem('viewerTheme');
  const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  const theme = savedTheme || (prefersDark ? 'dark' : 'light');
  if (theme === 'dark') document.documentElement.setAttribute('data-theme','dark');

  function setTheme(next){
    if(next === 'dark'){ document.documentElement.setAttribute('data-theme','dark'); }
    else{ document.documentElement.removeAttribute('data-theme'); }
    localStorage.setItem('viewerTheme', next);
    document.querySelector('#toggleTheme i').className = next === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
  }
  setTheme(theme);
  document.getElementById('toggleTheme').onclick = () => {
    const now = document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    setTheme(now);
  };

  /* -------- PDF.js wiring -------- */
  pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";

  const pdfUrl = <?php echo json_encode($pdfUrl); ?>;
  const allowSearch = <?php echo $allowSearch ? 'true' : 'false'; ?>;

  const eventBus = new pdfjsViewer.EventBus();
  const container = document.getElementById('viewerContainer');

  const linkService = new pdfjsViewer.PDFLinkService({ eventBus });
  const findController = new pdfjsViewer.PDFFindController({ eventBus, linkService });
  const pdfViewer = new pdfjsViewer.PDFViewer({
    container,
    eventBus,
    linkService,
    findController,
    maxCanvasPixels: 0,              // replaces deprecated useOnlyCssZoom
    textLayerMode: 2,
    removePageBorders: true
  });
  linkService.setViewer(pdfViewer);

  let pdfDoc = null;

  pdfjsLib.getDocument(pdfUrl).promise.then(async (doc) => {
    pdfDoc = doc;
    pdfViewer.setDocument(doc);
    linkService.setDocument(doc);
    document.getElementById('pageCount').textContent = doc.numPages;
    document.getElementById('statusText').textContent = "Ready";
    pdfViewer.currentScaleValue = 'page-width';
    updateScaleDisplay();
    await buildThumbnails(doc);
  }).catch(err => {
    document.getElementById('statusText').textContent = "Failed to load";
    console.error(err);
    alert('Unable to load PDF.');
  });

  /* -------- Custom thumbnails -------- */
  const thumbView = document.getElementById('thumbnailView');
  async function buildThumbnails(doc){
    thumbView.innerHTML = '';
    const maxWidth = 220;

    for (let i = 1; i <= doc.numPages; i++){
      const page = await doc.getPage(i);
      const vp0 = page.getViewport({ scale: 1 });
      const scale = maxWidth / vp0.width;
      const viewport = page.getViewport({ scale });

      const wrap = document.createElement('div');
      wrap.className = 'thumb'; wrap.dataset.page = i;

      const canvas = document.createElement('canvas');
      canvas.width = Math.floor(viewport.width);
      canvas.height = Math.floor(viewport.height);
      const ctx = canvas.getContext('2d', { alpha: false });

      wrap.appendChild(canvas);
      thumbView.appendChild(wrap);

      page.render({ canvasContext: ctx, viewport }).promise.then(() => page.cleanup?.());
      wrap.addEventListener('click', () => { pdfViewer.currentPageNumber = i; });
    }
    selectThumb(1);
  }
  function selectThumb(n){
    [...thumbView.querySelectorAll('.thumb')].forEach(el => el.classList.toggle('selected', +el.dataset.page === +n));
  }

  /* -------- Events -------- */
  eventBus.on('pagechanging', (e) => {
    const n = e.pageNumber || pdfViewer.currentPageNumber;
    document.getElementById('pageNumber').value = n;
    selectThumb(n);
    // Optional analytics
    fetch('track.php', {
      method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:'event=page&slug='+encodeURIComponent(<?php echo json_encode($slug); ?>)+'&page='+n
    }).catch(()=>{});
  });
  eventBus.on('scalechanging', updateScaleDisplay);

  function updateScaleDisplay(){
    const pct = Math.round((pdfViewer.currentScale || 1) * 100);
    document.getElementById('pageScale').textContent = pct + '%';
  }

  /* -------- Controls -------- */
  document.getElementById('zoomIn').onclick  = () => { pdfViewer.currentScale *= 1.1; };
  document.getElementById('zoomOut').onclick = () => { pdfViewer.currentScale = Math.max(0.25, pdfViewer.currentScale/1.1); };
  document.getElementById('fitWidth').onclick= () => { pdfViewer.currentScaleValue = 'page-width'; };
  document.getElementById('fitPage').onclick = () => { pdfViewer.currentScaleValue = 'page-fit'; };
  document.getElementById('rotate').onclick  = () => { pdfViewer.pagesRotation = (pdfViewer.pagesRotation + 90) % 360; };

  document.getElementById('prevPage').onclick = () => { pdfViewer.currentPageNumber = Math.max(1, pdfViewer.currentPageNumber - 1); };
  document.getElementById('nextPage').onclick = () => { pdfViewer.currentPageNumber = Math.min(pdfDoc?.numPages || 1, pdfViewer.currentPageNumber + 1); };

  const pageNumber = document.getElementById('pageNumber');
  pageNumber.onchange = () => {
    const n = Math.min(Math.max(1, parseInt(pageNumber.value || '1', 10)), pdfDoc?.numPages || 1);
    pdfViewer.currentPageNumber = n;
  };

  const sidebar = document.getElementById('sidebar');
  let sidebarOpen = true;
  document.getElementById('toggleSidebar').onclick = () => {
    sidebarOpen = !sidebarOpen;
    sidebar.style.display = sidebarOpen ? '' : 'none';
  };

  document.getElementById('fullscreen').onclick = () => {
    const el = document.documentElement;
    if (!document.fullscreenElement) el.requestFullscreen?.(); else document.exitFullscreen?.();
  };

  // Search
  if (allowSearch){
    const q = document.getElementById('searchInput');
    const matchCount = document.getElementById('matchCount');
    function doFind(back){ findController.executeCommand('find', { query:q.value||'', highlightAll:true, findPrevious:!!back }); }
    q.addEventListener('keydown', (e)=>{ if (e.key==='Enter') doFind(e.shiftKey); });
    document.getElementById('findNext').onclick = () => doFind(false);
    document.getElementById('findPrev').onclick = () => doFind(true);
    eventBus.on('updatefindmatchescount', (e) => {
      const total = e?.matchesCount?.total; matchCount.textContent = (typeof total==='number') ? (total+' match'+(total===1?'':'es')) : '';
    });
  } else {
    const wrap = document.getElementById('searchBoxWrap'); wrap && (wrap.style.display='none');
    const mc = document.getElementById('matchCount'); mc && (mc.style.display='none');
  }
})();
</script>
</body>
</html>
