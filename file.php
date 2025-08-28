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
<html>
<head>
<meta charset="utf-8">
<title>PDF Viewer</title>
<style>
  body,html{margin:0;height:100%;}
  #viewer{border:none;width:100%;height:100%;}
  .toolbar{display:flex;gap:10px;padding:8px;background:#fff;align-items:center;box-shadow:0 2px 4px rgba(0,0,0,0.1);}
  .toolbar input[type="text"]{flex:1;padding:6px 8px;border:1px solid #ccc;border-radius:4px;}
  .toolbar button{background:#f0f0f0;border:none;padding:6px 10px;border-radius:4px;cursor:pointer;}
  .toolbar button:hover{background:#e0e0e0;}
  .toolbar a{margin-left:auto;background:#4a90e2;color:#fff;padding:6px 12px;border-radius:4px;text-decoration:none;}
  .toolbar a:hover{background:#357ab8;}
  body.dark{background:#121212;color:#eee;}
  body.dark .toolbar{background:#333;box-shadow:none;}
  body.dark .toolbar input{background:#555;color:#fff;border:1px solid #666;}
  body.dark .toolbar button{background:#444;color:#eee;}
  body.dark .toolbar a{background:#1e88e5;}
</style>
</head>
<body>
<div class="toolbar">
<?php if($allowSearch){ ?>
  <input type="text" id="searchBox" placeholder="Search...">
<?php } ?>
  <button id="zoomOut" title="Zoom Out">−</button>
  <button id="zoomIn" title="Zoom In">+</button>
  <button id="printBtn" title="Print">🖨</button>
  <button id="themeToggle" title="Toggle theme">🌙</button>
<?php if($allowDownload){ ?>
  <a href="<?php echo htmlspecialchars($pdfUrl); ?>" download>Download</a>
<?php } ?>
</div>
<iframe id="viewer" src="<?php echo htmlspecialchars($pdfUrl); ?>#toolbar=0"></iframe>
<script>
const viewer=document.getElementById('viewer');
const pdfSrc="<?php echo htmlspecialchars($pdfUrl); ?>";
let currentZoom=100;

function updateViewer(){
  viewer.src=pdfSrc+"#toolbar=0&zoom="+currentZoom;
}

document.getElementById('zoomIn').addEventListener('click',()=>{
  currentZoom+=10;
  updateViewer();
});
document.getElementById('zoomOut').addEventListener('click',()=>{
  currentZoom=Math.max(50,currentZoom-10);
  updateViewer();
});
document.getElementById('printBtn').addEventListener('click',()=>{
  viewer.contentWindow && viewer.contentWindow.print();
});
document.getElementById('themeToggle').addEventListener('click',()=>{
  document.body.classList.toggle('dark');
});

const searchBox=document.getElementById('searchBox');
if(searchBox){
  searchBox.addEventListener('keyup',function(e){
    if(e.key==='Enter'){
      const text=this.value;
      viewer.contentWindow.find && viewer.contentWindow.find(text);
    }
  });
}
</script>
</body>
</html>
