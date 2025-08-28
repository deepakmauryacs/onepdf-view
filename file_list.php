<?php
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="d-flex">
    <nav class="bg-light border-right" id="sidebar" style="min-width:250px;">
        <div class="sidebar-heading p-3">Menu</div>
        <ul class="list-unstyled components">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li>
                <a href="#fileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">File Management</a>
                <ul class="collapse list-unstyled" id="fileSubmenu">
                    <li><a href="upload.php">Upload File</a></li>
                    <li><a href="file_list.php">File List</a></li>
                </ul>
            </li>
            <li>
                <a href="#settingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Setting</a>
                <ul class="collapse list-unstyled" id="settingSubmenu">
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="change_password.php">Change Password</a></li>
                </ul>
            </li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container-fluid p-4">
        <h1 class="mb-4">File List</h1>
        <table class="table table-striped" id="filesTable">
            <thead>
                <tr><th>File Name</th><th>Size</th><th>Action</th></tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
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
</body>
</html>
