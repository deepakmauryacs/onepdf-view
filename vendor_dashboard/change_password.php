<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}

define('INCLUDE_PATH', __DIR__ . '/includes/');
include(INCLUDE_PATH . 'header.php');
include(INCLUDE_PATH . 'sidebar.php');
include(INCLUDE_PATH . 'topbar.php');
?>
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><i class="bi bi-key mr-2"></i> Change Password</h1>
  <div class="row">
    <div class="col-lg-6">
      <div class="card shadow-sm mb-4">
        <div class="card-header d-flex align-items-center">
          <i class="bi bi-shield-lock mr-2"></i>
          <span class="font-weight-bold">Update Password</span>
        </div>
        <div class="card-body">
          <form id="passwordForm" novalidate>
            <div class="form-group">
              <label for="currentPassword" class="form-label"><i class="bi bi-lock mr-1"></i> Current Password</label>
              <input type="password" name="current_password" id="currentPassword" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="newPassword" class="form-label"><i class="bi bi-shield-lock mr-1"></i> New Password</label>
              <input type="password" name="new_password" id="newPassword" class="form-control" required minlength="6">
            </div>
            <div class="form-group">
              <label for="confirmPassword" class="form-label"><i class="bi bi-shield-check mr-1"></i> Confirm Password</label>
              <input type="password" name="confirm_password" id="confirmPassword" class="form-control" required minlength="6">
            </div>
            <button type="submit" id="btnChange" class="btn btn-primary">
              <i class="bi bi-save mr-1"></i> Save
            </button>
            <button type="reset" class="btn btn-outline-secondary ml-2">
              <i class="bi bi-arrow-counterclockwise mr-1"></i> Reset
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
(function(){
  const form = document.getElementById('passwordForm');
  const btn  = document.getElementById('btnChange');

  form.addEventListener('submit', async function(e){
    e.preventDefault();
    if (!form.checkValidity()) {
      alert('Please fill all required fields.');
      return;
    }
    btn.disabled = true;
    const original = btn.innerHTML;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Saving...';
    try {
      const formData = new FormData(form);
      const res = await fetch('api/_change_password.php', { method:'POST', body: formData });
      const result = await res.json();
      if (result.success) {
        alert('Password updated successfully');
        form.reset();
      } else {
        alert(result.error || 'Update failed');
      }
    } catch(err) {
      alert('Network error. Please try again.');
    } finally {
      btn.disabled = false;
      btn.innerHTML = original;
    }
  });
})();
</script>
<?php include(INCLUDE_PATH . 'footer.php'); ?>
