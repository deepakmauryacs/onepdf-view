<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login');
    exit;
}
define('INCLUDE_PATH', __DIR__ . '/includes/');

// (Optional) stats
$totalFiles = $totalLinks = $totalViews = $totalUsers = 0;
if (isset($mysqli)) {
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM documents")) { $totalFiles = (int)$res->fetch_assoc()['cnt']; }
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM links")) { $totalLinks = (int)$res->fetch_assoc()['cnt']; }
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM link_analytics")) { $totalViews = (int)$res->fetch_assoc()['cnt']; }
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM users")) { $totalUsers = (int)$res->fetch_assoc()['cnt']; }
}

include(INCLUDE_PATH . 'header.php');
include(INCLUDE_PATH . 'sidebar.php');
include(INCLUDE_PATH . 'topbar.php');
?>

<style>
/* ===== Modern Document Grid UI ===== */
.header-row {
  display:flex; align-items:center; justify-content:space-between;
  padding:12px 0; margin-bottom:16px; border-bottom:1px solid #e5e7eb;
}
.header-row .title { font-size:1.25rem; font-weight:600; color:#111827; }
.header-row .actions { display:flex; align-items:center; gap:16px; }

.btn-new {
  display:inline-flex; align-items:center; gap:6px;
  background:#22c55e; color:#fff; border:none; border-radius:8px;
  padding:8px 16px; font-weight:600; font-size:.95rem;
  box-shadow:0 2px 6px rgba(34,197,94,.3);
}
.btn-new:hover{ background:#16a34a; color:#fff; text-decoration:none; }

.doc-grid {
  display:grid;
  grid-template-columns:repeat(auto-fill, minmax(260px, 1fr));
  gap:24px;
}
.doc-card {
  background:#fff; border-radius:10px; overflow:hidden;
  box-shadow:0 2px 6px rgba(0,0,0,.08);
  transition:.2s ease;
  text-decoration:none;
}
.doc-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.12); }

.doc-preview {
  background:#f3f4f6; display:flex; align-items:center; justify-content:center;
  padding:12px; height:280px;
}
.doc-preview canvas{
  max-height:100%; max-width:100%;
  border:1px solid #e5e7eb; border-radius:4px; background:#fff;
}

.doc-filename {
  padding:10px; text-align:center; font-size:.9rem;
  font-weight:500; color:#1f2937; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;
}
</style>

<div class="container-fluid">

  <!-- Header row -->
  <div class="header-row">
    <div class="title">Home</div>
    <div class="actions">
      <div class="sort text-sm text-gray-500">Uploaded date <i class="fas fa-sort-down ml-1"></i></div>
      <a href="upload.php" class="btn-new"><i class="fas fa-plus"></i> New</a>
    </div>
  </div>

  <!-- Documents Grid -->
  <h2 class="h5 mb-3">Documents</h2>
  <div class="doc-grid">
    <?php
    $docs = [];
    if (isset($mysqli)) {
        // Try to get filepath if your table has it; fallback to filename only
        $stmt = $mysqli->prepare("SELECT id, filename, IFNULL(filepath,'') AS filepath FROM documents WHERE user_id = ? ORDER BY uploaded_at DESC");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->get_result();
        $docs = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
        $stmt->close();
    }

    if ($docs):
      foreach ($docs as $doc):
        // Build the URL to the stored PDF
        $pdfUrl = '';
        if (!empty($doc['filepath'])) {
          // if 'filepath' already holds a web path like 'storage/docs/abc.pdf'
          $pdfUrl = '/' . ltrim($doc['filepath'], '/');
        } else {
          // fallback: assume uploads/<filename>
          $pdfUrl = '/uploads/' . rawurlencode($doc['filename']);
        }
    ?>
        <a href="document.php?id=<?php echo (int)$doc['id']; ?>" class="doc-card">
          <div class="doc-preview">
            <!-- Canvas will render page 1 of the PDF -->
            <canvas class="pdf-thumb" data-src="<?php echo htmlspecialchars($pdfUrl, ENT_QUOTES); ?>"></canvas>
          </div>
          <div class="doc-filename"><?php echo htmlspecialchars($doc['filename']); ?></div>
        </a>
    <?php
      endforeach;
    else: ?>
      <p class="text-muted">No documents uploaded yet.</p>
    <?php endif; ?>
  </div>

</div>

<!-- PDF.js (from jsDelivr CDN) -->
<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.min.js"></script>
<script>
  // Configure PDF.js worker
  if (window['pdfjsLib']) {
    pdfjsLib.GlobalWorkerOptions.workerSrc = "https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/build/pdf.worker.min.js";
  }

  // Render first page into a canvas
  async function renderThumb(canvas, url){
    try{
      const pdf = await pdfjsLib.getDocument({ url }).promise;
      const page = await pdf.getPage(1);
      // Scale so that the thumbnail height fits the preview area nicely
      const viewport = page.getViewport({ scale: 1.0 });
      const maxH = canvas.parentElement.clientHeight - 24; // padding guard
      const scale = Math.min(1.6, Math.max(0.5, maxH / viewport.height)); // clamp scale
      const v2 = page.getViewport({ scale });

      canvas.width  = v2.width;
      canvas.height = v2.height;

      const ctx = canvas.getContext('2d', { alpha: false });
      await page.render({ canvasContext: ctx, viewport: v2 }).promise;
    }catch(e){
      // If it fails, show a simple fallback
      const ctx = canvas.getContext('2d');
      canvas.width = 200; canvas.height = 260;
      ctx.fillStyle = '#ffffff'; ctx.fillRect(0,0,canvas.width,canvas.height);
      ctx.strokeStyle = '#e5e7eb'; ctx.strokeRect(0,0,canvas.width,canvas.height);
      ctx.fillStyle = '#6b7280';
      ctx.font = '14px sans-serif';
      ctx.fillText('Preview unavailable', 20, 130);
      console.error('PDF thumb error:', e);
    }
  }

  // Initialize all thumbnails on DOM ready
  document.addEventListener('DOMContentLoaded', function(){
    const canvases = document.querySelectorAll('canvas.pdf-thumb[data-src]');
    canvases.forEach(cv => {
      const src = cv.getAttribute('data-src');
      if (src) renderThumb(cv, src);
    });
  });
</script>

<?php include(INCLUDE_PATH . 'footer.php'); ?>
