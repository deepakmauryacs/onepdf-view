<?php
$url = $_GET['url'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Embed PDF Viewer</title>
  <style>
    body{font-family:Arial,sans-serif;margin:20px;}
    pre{background:#f4f4f4;padding:10px;border-radius:6px;overflow:auto;}
    iframe{width:100%;height:500px;border:1px solid #ddd;border-radius:6px;}
  </style>
</head>
<body>
  <h1>Manual integration</h1>
  <p>Copy the code snippet below</p>
<?php if ($url): ?>
  <pre><code>&lt;iframe src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" width="100%" height="500" style="border:none;"&gt;&lt;/iframe&gt;</code></pre>
  <iframe src="<?php echo htmlspecialchars($url, ENT_QUOTES); ?>" style="border:none;"></iframe>
<?php else: ?>
  <p>No URL provided.</p>
<?php endif; ?>
</body>
</html>
