<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare('SELECT first_name, last_name, company, country, email FROM users WHERE id = ?');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

define('INCLUDE_PATH', __DIR__ . '/includes/');

include(INCLUDE_PATH . 'header.php');
include(INCLUDE_PATH . 'sidebar.php');
include(INCLUDE_PATH . 'topbar.php');
?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
            <h1 class="h3 mb-4 text-gray-800">Profile</h1>
            <form id="profileForm" class="col-lg-6">
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($user['first_name'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="<?php echo htmlspecialchars($user['last_name'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Company</label>
                    <input type="text" name="company" class="form-control" value="<?php echo htmlspecialchars($user['company'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" value="<?php echo htmlspecialchars($user['country'] ?? ''); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <script>
    document.getElementById('profileForm').addEventListener('submit', async function(e){
        e.preventDefault();
        const formData = new FormData(this);
        const res = await fetch('../api/_update_user.php', {method:'POST', body: formData});
        const result = await res.json();
        if(result.success){
            alert('Profile updated successfully');
        } else {
            alert(result.error || 'Update failed');
        }
    });
    </script>
<?php
include(INCLUDE_PATH . 'footer.php');
?>
