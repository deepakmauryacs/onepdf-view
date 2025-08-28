<?php
require_once __DIR__ . '/config.php';

$slug = $_GET['code'] ?? '';
if (!$slug) {
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    if (preg_match('~/file/([a-zA-Z0-9]+)~', $uri, $m)) {
        $slug = $m[1];
    }
}
if (!$slug) {
    echo 'Missing link code';
    exit;
}

$stmt = $mysqli->prepare("SELECT l.id, l.permissions, d.filepath FROM links l JOIN documents d ON l.document_id=d.id WHERE l.slug=?");
$stmt->bind_param('s', $slug);
$stmt->execute();
$stmt->bind_result($linkId, $permJson, $filepath);
if (!$stmt->fetch()) {
    echo 'Invalid link';
    exit;
}
$stmt->close();

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
<html>
<head>
<meta charset="utf-8">
<title>PDF Viewer</title>
<style>
  body,html{margin:0;height:100%;}
  #viewer{border:none;width:100%;height:100%;}
  .toolbar{display:flex;gap:10px;padding:8px;background:#f5f5f5;align-items:center;}
  .toolbar input[type="text"]{flex:1;padding:4px 8px;}
  .toolbar a{margin-left:auto;}
</style>
</head>
<body>
<div class="toolbar">
<?php if($allowSearch){ ?>
  <input type="text" id="searchBox" placeholder="Search...">
<?php } ?>
<?php if($allowDownload){ ?>
  <a href="<?php echo htmlspecialchars($filepath); ?>" download>Download</a>
<?php } ?>
</div>
<iframe id="viewer" src="<?php echo htmlspecialchars($filepath); ?>#toolbar=0"></iframe>
<script>
const searchBox=document.getElementById('searchBox');
if(searchBox){
  searchBox.addEventListener('keyup',function(e){
    if(e.key==='Enter'){
      const text=this.value;
      const frame=document.getElementById('viewer');
      frame.contentWindow.find && frame.contentWindow.find(text);
    }
  });
}
</script>
</body>
</html>
