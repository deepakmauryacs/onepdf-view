<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login');
    exit;
}
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare('SELECT p.name, p.price, p.billing_cycle, up.start_date, up.end_date FROM user_plan up JOIN plans p ON up.plan_id = p.id WHERE up.user_id = ? ORDER BY up.start_date DESC LIMIT 1');
$stmt->bind_param('i', $user_id);
$stmt->execute();
$plan = $stmt->get_result()->fetch_assoc();
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
            <a href="../pricing" class="btn btn-primary mt-3"><i class="bi bi-arrow-up-circle mr-1"></i> Upgrade Plan</a>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
