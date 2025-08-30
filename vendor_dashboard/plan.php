<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login');
    exit;
}

$user_id = $_SESSION['user_id'];

// Get current active plan for the user
$stmt = $mysqli->prepare('SELECT p.id as plan_id, p.name, p.price, p.billing_cycle, up.start_date, up.end_date FROM user_plan up JOIN plans p ON up.plan_id = p.id WHERE up.user_id = ? AND up.status = 1 ORDER BY up.start_date DESC LIMIT 1');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$plan = $stmt->get_result()->fetch_assoc();

// Fetch available plans (exclude current plan if exists)
$plans_res = $mysqli->query('SELECT id, name, price, billing_cycle FROM plans ORDER BY price');
$available_plans = [];
while ($row = $plans_res->fetch_assoc()) {
    if (!$plan || $row['id'] != $plan['plan_id']) {
        $available_plans[] = $row;
    }
}
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="bi bi-gem mr-2"></i>Plan</h1>
    </div>
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if ($plan): ?>
                <p>Your current plan: <strong><?php echo htmlspecialchars($plan['name']); ?></strong></p>
                <p>Price: $<?php echo htmlspecialchars($plan['price']); ?> / <?php echo htmlspecialchars($plan['billing_cycle']); ?></p>
                <?php if (!empty($plan['end_date'])): ?>
                    <p>Expires on: <?php echo htmlspecialchars($plan['end_date']); ?></p>
                <?php endif; ?>
            <?php else: ?>
                <p>You are currently on the <strong>Free</strong> plan.</p>
            <?php endif; ?>
            <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#upgradeModal"><i class="bi bi-arrow-up-circle mr-1"></i> Upgrade Plan</button>
        </div>
    </div>
</div>

<!-- Upgrade Plan Modal -->
<div class="modal fade" id="upgradeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="planForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="planSelect">Available Plans</label>
                        <select class="form-control" id="planSelect" name="plan_id" required>
                            <option value="">Select a plan</option>
                            <?php foreach ($available_plans as $p): ?>
                                <option value="<?php echo htmlspecialchars($p['id']); ?>">
                                    <?php echo htmlspecialchars($p['name'] . ' - $' . $p['price'] . ' / ' . $p['billing_cycle']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="btnPlanSave" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function(){
    $('#planForm').on('submit', function(e){
        e.preventDefault();
        var btn = $('#btnPlanSave');
        btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Saving...');
        $.ajax({
            url: 'api/_update_plan.php',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json'
        }).done(function(res){
            if (res.success) {
                location.reload();
            } else {
                alert(res.error || 'Update failed');
            }
        }).fail(function(){
            alert('Network error. Please try again.');
        }).always(function(){
            btn.prop('disabled', false).html('Save');
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>
