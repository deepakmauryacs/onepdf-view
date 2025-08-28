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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Premium PDF Viewer</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.css"/>

<style>
  /* ---------- LIGHT as default ---------- */
  :root{
    --ui-bg:#111315;
    --ui-bar:#2b3034;
    --ui-bar-darker:#23272b;
    --ui-ink:#ffffff;
    --ui-muted:#9aa4b2;
    --ui-border:#3d434b;
    --ui-accent:#4c8bf5;
  }

  *{box-sizing:border-box}
  html,body{height:100%}
  body{
    margin:0;
    background:var(--ui-bg);
    color:var(--ui-ink);
    font-family:"DM Sans", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
    transition: background .15s ease, color .15s ease;
  }

  /* Top bar */
  .topbar{
    height:48px;
    background:var(--ui-bar);
    display:flex;align-items:center;gap:10px;padding:0 16px;
    border-bottom:1px solid var(--ui-border);
    position:sticky;top:0;z-index:50
  }
  .tb{
    height:32px;min-width:32px;border:0;
    color:var(--ui-ink);background:transparent;
    border-radius:4px;display:inline-flex;align-items:center;justify-content:center;
    padding:0 8px;cursor:pointer
  }
  .tb:hover{background:rgba(255,255,255,0.1)}
  .tb i{font-size:16px}
  .spacer{flex:1 1 auto}

  .zoom-wrap{position:relative}
  .zoom-btn{display:inline-flex;align-items:center;gap:6px;font-weight:600;color:var(--ui-ink)}
  .zoom-menu{
    position:absolute;top:38px;left:0;min-width:180px;background:color-mix(in srgb, var(--ui-bar) 70%, black 10%);
    border:1px solid var(--ui-border);border-radius:8px;padding:6px;display:none;z-index:40
  }
  .zoom-menu .item{display:flex;align-items:center;height:34px;padding:0 10px;border-radius:8px;color:var(--ui-ink);cursor:pointer;white-space:nowrap}
  .zoom-menu .item:hover{background:color-mix(in srgb, var(--ui-bar) 50%, black 10%)}

  .sheet{display:grid;grid-template-columns:260px 1fr;height:calc(100vh - 48px)}
  .sidebar{border-right:1px solid var(--ui-border);background:color-mix(in srgb, var(--ui-bg) 80%, black 10%);display:flex;flex-direction:column;min-width:220px;max-width:340px}
  .side-tabs{display:flex;gap:8px;padding:10px;border-bottom:1px solid var(--ui-border)}
  .side-tabs .tb{background:var(--ui-bar-darker)}
  .side-tabs .tb.active{outline:2px solid var(--ui-accent);outline-offset:-2px}
  #thumbnailView{padding:12px;overflow:auto;flex:1;display:none}
  #outlineView{padding:12px;overflow:auto;flex:1;font-size:14px;display:none}
  #outlineView ul{list-style:none;margin:0;padding-left:0}
  .outline-item{display:flex;align-items:center;gap:4px;padding:4px 0;cursor:pointer;color:var(--ui-ink)}
  .outline-item i{font-size:12px}
  .outline-item:hover{color:var(--ui-accent)}
  .outline-children{padding-left:16px}
  .thumb{border:1px solid var(--ui-border);border-radius:10px;background:color-mix(in srgb, var(--ui-bg) 92%, black 8%);margin-bottom:12px;padding:6px;cursor:pointer}
  .thumb.selected{outline:2px solid var(--ui-accent);outline-offset:2px}
  .thumb canvas{width:100%;display:block}

  .viewer{position:relative;background:color-mix(in srgb, var(--ui-bg) 70%, black 10%);height:100%}
  #viewerContainer{position:absolute;inset:0;overflow:auto}
  .pdfViewer .page{margin:10px auto;background:#fff;border-radius:10px;border:1px solid #d7dae0}

  .search{display:flex;align-items:center;gap:8px;background:var(--ui-bar-darker);border:1px solid var(--ui-border);border-radius:20px;padding:0 10px;height:32px}
  .search input{border:0;outline:0;height:28px;width:260px;color:var(--ui-ink);background:transparent;font:inherit}

  ::-webkit-scrollbar{width:10px;height:10px}
  ::-webkit-scrollbar-thumb{background:color-mix(in srgb, var(--ui-border) 40%, var(--ui-ink) 40%);border-radius:999px}
  ::-webkit-scrollbar-track{background:color-mix(in srgb, var(--ui-bg) 70%, black 15%)}

  .page-info{display:flex;align-items:center;gap:6px;color:var(--ui-ink)}
  .page-info input{width:40px;height:26px;border:1px solid var(--ui-border);background:var(--ui-bar-darker);color:var(--ui-ink);text-align:center;border-radius:4px}
</style>
</head>
<body>

<div class="topbar">
  <button class="tb" id="toggleSidebar" title="Toggle sidebar"><i class="bi bi-layout-sidebar"></i></button>

  <button class="tb" id="prevPage" title="Previous page"><i class="bi bi-chevron-left"></i></button>
  <div class="page-info">
    <input type="text" id="pageNumber" value="1" />
    <span id="pageCount">0</span>
  </div>
  <button class="tb" id="nextPage" title="Next page"><i class="bi bi-chevron-right"></i></button>

  <div class="spacer"></div>

  <button class="tb" id="zoomOut" title="Zoom out"><i class="bi bi-dash-lg"></i></button>

  <div class="zoom-wrap">
    <button class="tb zoom-btn" id="zoomBtn"><span id="zoomLabel">100%</span> <i class="bi bi-caret-down-fill"></i></button>
    <div class="zoom-menu" id="zoomMenu">
      <div class="item" data-scale="page-width">Fit to Width</div>
      <div class="item" data-scale="page-fit">Fit to Page</div>
      <div class="item" data-scale="auto">Auto Zoom</div>
      <div class="item" data-scale="page-actual">Actual Size</div>
      <div class="item" data-scale="0.5">50%</div>
      <div class="item" data-scale="0.75">75%</div>
      <div class="item" data-scale="1">100%</div>
      <div class="item" data-scale="1.25">125%</div>
      <div class="item" data-scale="1.5">150%</div>
      <div class="item" data-scale="2">200%</div>
      <div class="item" data-scale="3">300%</div>
      <div class="item" data-scale="4">400%</div>
    </div>
  </div>

  <button class="tb" id="zoomIn" title="Zoom in"><i class="bi bi-plus-lg"></i></button>

  <div class="spacer"></div>

  <button class="tb" id="printBtn" title="Print"><i class="bi bi-printer"></i></button>
  <a class="tb" id="downloadBtn" title="Download" href="<?php echo htmlspecialchars($pdfUrl); ?>" download><i class="bi bi-download"></i></a>
  <a class="tb" id="openNew" title="Open in new tab" href="<?php echo htmlspecialchars($pdfUrl); ?>" target="_blank"><i class="bi bi-box-arrow-up-right"></i></a>
</div>

<div class="sheet" id="sheet">
  <aside class="sidebar" id="sidebar">
    <div class="side-tabs">
      <button class="tb" id="thumbTab" title="Thumbnails"><i class="bi bi-grid-3x3-gap"></i></button>
      <button class="tb" id="outlineTab" title="Outlines"><i class="bi bi-list-task"></i></button>
    </div>
    <div id="thumbnailView"></div>
    <div id="outlineView"></div>
  </aside>

  <main class="viewer">
    <div id="viewerContainer">
      <div id="viewer" class="pdfViewer"></div>
    </div>
  </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.js"></script>
<script>
(() => {
  /* ---------- PDF.js ---------- */
  pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";
  const pdfUrl = <?php echo json_encode($pdfUrl); ?>;
  const slug = <?php echo json_encode($slug); ?>;
  const pageNumber = document.getElementById('pageNumber');
  const pageCount  = document.getElementById('pageCount');

  const eventBus   = new pdfjsViewer.EventBus();
  const container  = document.getElementById('viewerContainer');
  const linkSvc    = new pdfjsViewer.PDFLinkService({ eventBus });
  const pdfViewer = new pdfjsViewer.PDFViewer({
    container, eventBus, linkService: linkSvc,
    maxCanvasPixels: 0, textLayerMode: 2, removePageBorders: true
  });
  linkSvc.setViewer(pdfViewer);

  let pdfDoc = null;
  const thumbTab   = document.getElementById('thumbTab');
  const outlineTab = document.getElementById('outlineTab');
  const thumbView  = document.getElementById('thumbnailView');
  const outlineView = document.getElementById('outlineView');

  pdfjsLib.getDocument(pdfUrl).promise.then(async (doc) => {
    pdfDoc = doc;
    pdfViewer.setDocument(doc);
    linkSvc.setDocument(doc);
    pdfViewer.currentScaleValue = 'page-width';
    updateZoomLabel();
    await buildThumbnails(doc);
    const outline = await doc.getOutline();
    buildOutline(outline);
    if (outline && outline.length) {
      outlineTab.classList.add('active');
      thumbTab.classList.remove('active');
      outlineView.style.display = '';
      thumbView.style.display = 'none';
    } else {
      thumbTab.classList.add('active');
      outlineTab.classList.remove('active');
      thumbView.style.display = '';
      outlineView.style.display = 'none';
    }
    pageCount.textContent = doc.numPages;
  }).catch(err => {
    console.error(err);
    alert('Failed to load PDF.');
  });

  /* ---------- Sidebar Tabs ---------- */
  thumbTab.onclick = () => {
    thumbTab.classList.add('active');
    outlineTab.classList.remove('active');
    thumbView.style.display = '';
    outlineView.style.display = 'none';
  };
  outlineTab.onclick = () => {
    outlineTab.classList.add('active');
    thumbTab.classList.remove('active');
    outlineView.style.display = '';
    thumbView.style.display = 'none';
  };

  /* ---------- Thumbnails ---------- */
  async function buildThumbnails(doc){
    thumbView.innerHTML = '';
    const maxW = 220;
    for (let i=1;i<=doc.numPages;i++){
      const page = await doc.getPage(i);
      const v0 = page.getViewport({ scale:1 });
      const scale = maxW / v0.width;
      const viewport = page.getViewport({ scale });

      const wrap = document.createElement('div');
      wrap.className = 'thumb'; wrap.dataset.page = i;

      const cv = document.createElement('canvas');
      cv.width  = Math.floor(viewport.width);
      cv.height = Math.floor(viewport.height);
      const ctx = cv.getContext('2d', { alpha:false });

      wrap.appendChild(cv);
      thumbView.appendChild(wrap);

      page.render({ canvasContext: ctx, viewport }).promise.then(()=> page.cleanup?.());
      wrap.onclick = () => { pdfViewer.currentPageNumber = i; };
    }
    selectThumb(1);
  }
  function selectThumb(n){
    [...thumbView.querySelectorAll('.thumb')].forEach(el => el.classList.toggle('selected', +el.dataset.page === +n));
  }
  eventBus.on('pagechanging', (e) => {
    const n = e.pageNumber || pdfViewer.currentPageNumber;
    selectThumb(n);
    pageNumber.value = n;
    fetch('track.php', {
      method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'},
      body:'event=page&slug='+encodeURIComponent(slug)+'&page='+n
    }).catch(()=>{});
  });

  /* ---------- Outline ---------- */
  function buildOutline(outline){
    outlineView.innerHTML = '';
    if (!outline){
      outlineView.textContent = 'No outline available';
      return;
    }
    const render = (items, parent, depth = 0) => {
      const ul = document.createElement('ul');
      parent.appendChild(ul);
      items.forEach(it => {
        const li = document.createElement('li');
        ul.appendChild(li);

        const row = document.createElement('div');
        row.className = 'outline-item';
        li.appendChild(row);

        const text = document.createElement('span');
        text.textContent = it.title || '';
        row.appendChild(text);
        text.onclick = () => { if (it.dest) linkSvc.navigateTo(it.dest); };

        if (it.items && it.items.length){
          const caret = document.createElement('i');
          const open = depth < 1; // expand first level by default
          caret.className = 'bi ' + (open ? 'bi-caret-down' : 'bi-caret-right');
          row.prepend(caret);

          const child = document.createElement('div');
          child.className = 'outline-children';
          child.style.display = open ? 'block' : 'none';
          li.appendChild(child);

          caret.onclick = (e) => {
            e.stopPropagation();
            const isOpen = child.style.display === 'none';
            child.style.display = isOpen ? 'block' : 'none';
            caret.className = 'bi ' + (isOpen ? 'bi-caret-down' : 'bi-caret-right');
          };

          render(it.items, child, depth + 1);
        }
      });
    };
    render(outline, outlineView, 0);
  }

  /* ---------- Zoom ---------- */
  const zoomBtn   = document.getElementById('zoomBtn');
  const zoomMenu  = document.getElementById('zoomMenu');
  const zoomLabel = document.getElementById('zoomLabel');

  const toggleMenu = el => el.style.display = (el.style.display==='block'?'none':'block');
  const closeMenu  = el => el && (el.style.display='none');

  document.addEventListener('click', ()=>{ closeMenu(zoomMenu); });

  zoomBtn.onclick = (e)=>{ e.stopPropagation(); toggleMenu(zoomMenu); };
  zoomMenu.querySelectorAll('.item').forEach(it=>{
    it.onclick = ()=>{
      const v = it.dataset.scale;
      if (['page-width','page-fit','page-actual','auto'].includes(v)) pdfViewer.currentScaleValue = v;
      else pdfViewer.currentScale = Math.max(0.25, Math.min(4, parseFloat(v)));
      closeMenu(zoomMenu); updateZoomLabel();
    };
  });

  document.getElementById('zoomIn').onclick  = ()=>{ pdfViewer.currentScale = Math.min(4, (pdfViewer.currentScale||1)*1.1); updateZoomLabel(); };
  document.getElementById('zoomOut').onclick = ()=>{ pdfViewer.currentScale = Math.max(0.25, (pdfViewer.currentScale||1)/1.1); updateZoomLabel(); };
  eventBus.on('scalechanging', updateZoomLabel);
  function updateZoomLabel(){
    const val = pdfViewer.currentScaleValue;
    if (typeof val === 'string'){
      const map = { 'page-width':'Fit to Width', 'page-fit':'Fit to Page', 'page-actual':'Actual Size', 'auto':'Auto Zoom' };
      zoomLabel.textContent = map[val] ?? (Math.round((pdfViewer.currentScale||1)*100)+'%');
    } else {
      zoomLabel.textContent = Math.round((pdfViewer.currentScale||1)*100) + '%';
    }
  }

  /* ---------- Page navigation ---------- */
  document.getElementById('prevPage').onclick = ()=>{
    if (pdfViewer.currentPageNumber > 1) pdfViewer.currentPageNumber--;
  };
  document.getElementById('nextPage').onclick = ()=>{
    if (pdfViewer.currentPageNumber < (pdfDoc?.numPages||1)) pdfViewer.currentPageNumber++;
  };
  pageNumber.addEventListener('keydown', (e)=>{
    if (e.key==='Enter' && pdfDoc){
      const v = parseInt(pageNumber.value,10);
      if (v>=1 && v<=pdfDoc.numPages) pdfViewer.currentPageNumber = v;
    }
  });

  /* ---------- Print ---------- */
  document.getElementById('printBtn').onclick = ()=>window.print();

  /* ---------- Sidebar toggle ---------- */
  const sidebar = document.getElementById('sidebar');
  let open = true;
  document.getElementById('toggleSidebar').onclick = ()=>{
    open = !open; sidebar.style.display = open ? '' : 'none';
    setTimeout(()=>{ pdfViewer.currentScaleValue = pdfViewer.currentScaleValue; }, 50);
  };
})();
</script>
</body>
</html>
