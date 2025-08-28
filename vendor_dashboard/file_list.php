<?php
require_once __DIR__ . '/../config.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">File List</h1>
    <table class="table table-striped" id="filesTable">
        <thead>
            <tr><th>File Name</th><th>Size</th><th>Action</th></tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function loadFiles(){
    $.get('api/list_files.php', function(res){
        var tbody = $('#filesTable tbody');
        tbody.empty();
        res.files.forEach(function(file){
            var sizeMB = (file.size/1024/1024).toFixed(2) + ' MB';
            var row = $('<tr>');
            row.append('<td>'+file.filename+'</td>');
            row.append('<td>'+sizeMB+'</td>');
            row.append('<td><button class="btn btn-danger btn-sm delete" data-id="'+file.id+'">Delete</button></td>');
            tbody.append(row);
        });
    }, 'json');
}
$('#filesTable').on('click', '.delete', function(){
    var id = $(this).data('id');
    $.post('api/delete_file.php', {id:id}, function(){
        loadFiles();
    });
});
$(function(){
    loadFiles();
});
</script>
<?php include 'includes/footer.php'; ?>
