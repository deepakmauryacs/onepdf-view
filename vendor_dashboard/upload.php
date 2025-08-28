<?php
require_once __DIR__ . '/../config.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Upload PDF</h1>
    <form id="uploadForm" enctype="multipart/form-data">
        <div class="form-group">
            <input type="file" name="pdf" accept="application/pdf" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <div id="alert" class="mt-3"></div>
    <table class="table table-striped mt-4" id="filesTable">
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
$('#uploadForm').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: 'api/upload_file.php',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(){
            $('#alert').html('<div class="alert alert-success">Uploaded</div>');
            loadFiles();
        },
        error: function(xhr){
            var msg = xhr.responseJSON ? xhr.responseJSON.error : 'Upload failed';
            $('#alert').html('<div class="alert alert-danger">'+msg+'</div>');
        }
    });
});
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
