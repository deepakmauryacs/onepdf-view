<?php
require_once '../config.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login');
    exit;
}
// Define the base path for includes
define('INCLUDE_PATH', __DIR__ . '/includes/');

// ---------------------------------------------------------------------
// Basic statistics for the dashboard
// ---------------------------------------------------------------------
$totalFiles = $totalLinks = $totalViews = $totalUsers = 0;

if (isset($mysqli)) {
    // Total uploaded documents
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM documents")) {
        $row = $res->fetch_assoc();
        $totalFiles = (int)$row['cnt'];
    }

    // Total generated links
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM links")) {
        $row = $res->fetch_assoc();
        $totalLinks = (int)$row['cnt'];
    }

    // Total recorded link views
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM link_analytics")) {
        $row = $res->fetch_assoc();
        $totalViews = (int)$row['cnt'];
    }

    // Total registered users
    if ($res = $mysqli->query("SELECT COUNT(*) AS cnt FROM users")) {
        $row = $res->fetch_assoc();
        $totalUsers = (int)$row['cnt'];
    }
}

// Include the header
include(INCLUDE_PATH . 'header.php');

// Include the sidebar
include(INCLUDE_PATH . 'sidebar.php');

// Include the topbar
include(INCLUDE_PATH . 'topbar.php');
?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Total Files Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Files</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalFiles; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-pdf fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Links Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Links</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalLinks; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-link fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Views Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Views</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalViews; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-eye fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Registered Users Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Registered Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $totalUsers; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Documents -->
            <h2 class="h5 mb-4">Your Documents</h2>
            <div class="row">
            <?php
            $docs = [];
            if (isset($mysqli)) {
                $stmt = $mysqli->prepare("SELECT id, filename FROM documents WHERE user_id = ? ORDER BY uploaded_at DESC");
                $stmt->bind_param('i', $_SESSION['user_id']);
                $stmt->execute();
                $res = $stmt->get_result();
                $docs = $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
                $stmt->close();
            }
            if ($docs):
                foreach ($docs as $doc):
            ?>
                <div class="col-md-3 mb-4">
                    <a href="document.php?id=<?php echo $doc['id']; ?>" class="card shadow-sm text-center h-100">
                        <div class="card-body d-flex flex-column justify-content-center">
                            <i class="fas fa-file-pdf fa-2x text-danger mb-2"></i>
                            <div class="small"><?php echo htmlspecialchars($doc['filename']); ?></div>
                        </div>
                    </a>
                </div>
            <?php
                endforeach;
            else:
            ?>
                <div class="col-12">
                    <p class="text-muted">No documents uploaded yet.</p>
                </div>
            <?php endif; ?>
            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                            <div class="dropdown no-arrow">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                    aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Dropdown Header:</div>
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <span class="mr-2">
                                    <i class="fas fa-circle text-primary"></i> Direct
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-success"></i> Social
                                </span>
                                <span class="mr-2">
                                    <i class="fas fa-circle text-info"></i> Referral
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
<?php
// Include the footer
include(INCLUDE_PATH . 'footer.php');
?>
