<?php
require_once __DIR__ . '/../config.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

$url = $_GET['url'] ?? '';
?>

<style>
  pre{background:#f4f4f4;padding:10px;border-radius:6px;overflow:auto;}
  iframe{width:100%;height:500px;border:1px solid #ddd;border-radius:6px;}
</style>

<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Embed PDF Viewer</h1>
  </div>

  <div class="card shadow-sm">
    <div class="card-body">
      <?php if ($url): ?>
        <p class="mb-3">Copy the code snippet below:</p>
        <pre><code>&lt;iframe src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" width="100%" height="500" style="border:none;"&gt;&lt;/iframe&gt;</code></pre>
        <iframe src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" style="border:none;"></iframe>
      <?php else: ?>
        <p>No URL provided.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
