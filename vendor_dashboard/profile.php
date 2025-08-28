<?php
require_once __DIR__ . '/../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare('SELECT first_name, last_name, company, country, email FROM users WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($first_name, $last_name, $company, $country, $email);
$stmt->fetch();
$stmt->close();
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Profile</h1>
    <form id="profileForm">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="company">Company</label>
                <input type="text" class="form-control" id="company" name="company" value="<?php echo htmlspecialchars($company); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" name="country" value="<?php echo htmlspecialchars($country); ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <div id="alert" class="mt-3"></div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#profileForm').on('submit', function(e){
    e.preventDefault();
    $.post('api/_update_user.php', $(this).serialize(), function(res){
        if(res.success){
            $('#alert').html('<div class="alert alert-success">Profile updated</div>');
        } else if(res.error){
            $('#alert').html('<div class="alert alert-danger">'+res.error+'</div>');
        }
    }, 'json');
});
</script>
<?php include 'includes/footer.php'; ?>
