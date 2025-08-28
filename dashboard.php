<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nice Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="logo" data-toggle="sidebar" aria-label="Toggle sidebar">
                    <i class="bi bi-box"></i>
                    <span>NICE ADMIN</span>
                </a>
                <button class="toggle-sidebar-btn" type="button" data-toggle="sidebar" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <ul class="sidebar-menu">
                    <li class="menu-header">PERSONAL</li>

                    <li>
                        <a href="#" class="menu-link active">
                            <i class="bi bi-grid-1x2"></i>
                            <span>Dashboard</span>
                            <span class="badge bg-primary rounded-pill">3</span>
                        </a>
                        <ul class="submenu active">
                            <li><a href="#" class="active"><i class="bi bi-circle"></i> Classic</a></li>
                            <li><a href="#"><i class="bi bi-circle"></i> Analytical</a></li>
                            <li><a href="#"><i class="bi bi-circle"></i> Modern</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="menu-link">
                            <i class="bi bi-layout-sidebar"></i>
                            <span>Sidebar Type</span>
                            <i class="bi bi-chevron-right arrow"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="bi bi-circle"></i> Collapsed</a></li>
                            <li><a href="#"><i class="bi bi-circle"></i> Expanded</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="menu-link">
                            <i class="bi bi-layout-three-columns"></i>
                            <span>Page Layouts</span>
                            <i class="bi bi-chevron-right arrow"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="#"><i class="bi bi-circle"></i> Full Width</a></li>
                            <li><a href="#"><i class="bi bi-circle"></i> Boxed</a></li>
                        </ul>
                    </li>

                    <li class="menu-header">APPS</li>
                    <li>
                        <a href="#" class="menu-link">
                            <i class="bi bi-inbox"></i>
                            <span>Inbox</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-link">
                            <i class="bi bi-ticket-perforated"></i>
                            <span>Ticket</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-link">
                            <i class="bi bi-three-dots"></i>
                            <span>Extra</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Mobile backdrop (click to close) -->
        <div class="sidebar-backdrop" data-toggle="sidebar" aria-hidden="true"></div>

        <!-- Main -->
        <main id="main" class="main-content">
            <header id="header" class="header fixed-top d-flex align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <!-- Toggle button for all sizes -->
                    <button
                        class="btn p-0 border-0 d-inline-flex align-items-center justify-content-center"
                        style="width:40px;height:40px"
                        type="button"
                        data-toggle="sidebar"
                        aria-label="Toggle sidebar"
                    >
                        <i class="bi bi-list fs-3"></i>
                    </button>

                    <a href="#" class="logo d-flex align-items-center text-decoration-none">
                        <i class="bi bi-box"></i>
                        <span class="d-none d-lg-block ms-2">NICE ADMIN</span>
                    </a>

                    <div class="search-bar ms-3 d-none d-md-flex">
                        <i class="bi bi-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                </div>

                <nav class="header-nav ms-auto">
                    <ul class="d-flex align-items-center">
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link nav-icon search-bar-toggle" href="#">
                                <i class="bi bi-search"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-envelope"></i>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="badge bg-primary badge-number">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                                <li class="dropdown-header">
                                    You have 3 new notifications
                                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="notification-item">
                                    <i class="bi bi-exclamation-circle text-warning"></i>
                                    <div>
                                        <h4>New Client Registration</h4>
                                        <p>A new user has signed up for your service.</p>
                                        <p>30 min. ago</p>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="notification-item">
                                    <i class="bi bi-check-circle text-success"></i>
                                    <div>
                                        <h4>New Project Assigned</h4>
                                        <p>Project #123 has been assigned to you.</p>
                                        <p>1 hr. ago</p>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="notification-item">
                                    <i class="bi bi-info-circle text-primary"></i>
                                    <div>
                                        <h4>System Update Available</h4>
                                        <p>A new system update is ready to install.</p>
                                        <p>2 hrs. ago</p>
                                    </div>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="dropdown-footer text-center">
                                    <a href="#">Show all notifications</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown pe-3">
                            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                                <img src="https://i.ibb.co/L5hY5Xn/profile.jpg" alt="Profile" class="rounded-circle profile-pic">
                                <span class="d-none d-md-block dropdown-toggle ps-2">Jonathan Doe</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                <li class="dropdown-header user-info-header">
                                    <img src="https://i.ibb.co/L5hY5Xn/profile.jpg" alt="Avatar" class="profile-avatar">
                                    <h6>Jonathan Doe</h6>
                                    <span>jon@gmail.com</span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-person"></i>
                                        <span>My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-wallet2"></i>
                                        <span>My Balance</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-envelope"></i>
                                        <span>Inbox</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-gear"></i>
                                        <span>Account Setting</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="text-center">
                                    <button class="btn btn-success btn-sm">View Profile</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </header>

            <div class="pagetitle">
                <h1>Dashboard</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </nav>
            </div>

            <!-- CONTENT -->
            <section class="dashboard-section">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">New Clients</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-light text-primary">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>23</h6>
                                    </div>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">New Projects</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-light text-success">
                                        <i class="bi bi-folder"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>169</h6>
                                    </div>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 60%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card expenses-card">
                            <div class="card-body">
                                <h5 class="card-title">New Invoices</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info-light text-info">
                                        <i class="bi bi-currency-euro"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>157</h6>
                                    </div>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="card info-card users-card">
                            <div class="card-body">
                                <h5 class="card-title">New Sales</h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger-light text-danger">
                                        <i class="bi bi-graph-up"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>236</h6>
                                    </div>
                                </div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 90%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-xxl-4 col-md-6">
                                <div class="card">
                                    <div class="card-body pb-0">
                                        <h5 class="card-title">Campaign</h5>
                                        <div class="echart" style="min-height:280px;">
                                            <div class="chart-placeholder">
                                                <i class="bi bi-pie-chart display-4 text-muted"></i>
                                                <p class="text-muted">Doughnut Chart Placeholder</p>
                                                <div class="d-flex justify-content-around mt-3 w-100">
                                                    <div class="text-center">60% <br><small>Open</small></div>
                                                    <div class="text-center">26% <br><small>Click</small></div>
                                                    <div class="text-center">18% <br><small>Bounce</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-8 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Sales Ratio <span class="small fw-light">August 2018</span></h5>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <span class="fw-bold fs-5 text-primary">This Week</span><br>
                                                <span class="fs-4 fw-bold text-success">$23.5K</span>
                                                <span class="text-success small">+18.6</span>
                                            </div>
                                            <div>
                                                <span class="fw-bold fs-5 text-muted">Last Week</span><br>
                                                <span class="fs-4 fw-bold text-danger">$945</span>
                                                <span class="text-danger small">-46.3</span>
                                            </div>
                                        </div>
                                        <div class="echart" style="min-height:250px;">
                                            <div class="chart-placeholder">
                                                <i class="bi bi-graph-up display-4 text-muted"></i>
                                                <p class="text-muted">Line Chart Placeholder</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Referral Earnings</h5>
                                        <p class="h4">$769.08</p>
                                        <div class="chart-placeholder small">
                                            <p class="text-muted">Referral details or mini chart</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card weather-card">
                            <div class="card-body">
                                <h5 class="card-title">Thursday <span class="small fw-light">12th April, 2018</span></h5>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="weather-icon">
                                        <i class="bi bi-cloud-drizzle display-1 text-muted"></i>
                                    </div>
                                    <div class="weather-temp display-3 fw-bold">35°</div>
                                </div>
                                <div class="echart mt-3" style="min-height:80px;">
                                    <div class="chart-placeholder small">
                                        <p class="text-muted">Mini Weather Chart</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card users-card">
                            <div class="card-body">
                                <h5 class="card-title">Users</h5>
                                <p class="h4">35,658 <span class="text-success small fw-bold">+23%</span></p>
                                <div class="chart-placeholder small">
                                    <p class="text-muted">User growth chart</p>
                                </div>
                            </div>
                        </div>

                        <div class="settings-icon">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const mqDesktop = matchMedia('(min-width: 992px)');
      const sidebar   = document.getElementById('sidebar');
      const main      = document.getElementById('main');
      const header    = document.getElementById('header');

      function toggleSidebar() {
        if (mqDesktop.matches) {
          sidebar.classList.toggle('collapsed');
          main.classList.toggle('collapsed');
          header.classList.toggle('collapsed');
        } else {
          sidebar.classList.toggle('active');
        }
      }

      mqDesktop.addEventListener('change', (e) => {
        if (e.matches) {
          sidebar.classList.remove('active');
        } else {
          sidebar.classList.remove('collapsed');
          main.classList.remove('collapsed');
          header.classList.remove('collapsed');
        }
      });

      // Any element with data-toggle="sidebar" toggles it
      document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-toggle="sidebar"]');
        if (!btn) return;
        e.preventDefault();

        // clicking the backdrop only closes on mobile
        if (btn.classList.contains('sidebar-backdrop')) {
          if (sidebar.classList.contains('active')) sidebar.classList.remove('active');
          return;
        }
        toggleSidebar();
      });

      // Submenus
      document.querySelectorAll('.sidebar-menu .menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
          const sub = this.nextElementSibling;
          if (sub && sub.classList.contains('submenu')) {
            e.preventDefault();
            sub.classList.toggle('active');
            const arr = this.querySelector('.arrow');
            if (arr) {
              arr.classList.toggle('bi-chevron-right');
              arr.classList.toggle('bi-chevron-down');
            }
          }
        });
      });

      // Initialize any pre-open submenu arrows
      document.querySelectorAll('.sidebar-menu .submenu.active').forEach(ul => {
        const arr = ul.previousElementSibling?.querySelector('.arrow');
        if (arr) { arr.classList.remove('bi-chevron-right'); arr.classList.add('bi-chevron-down'); }
      });
    });
    </script>
</body>
</html>
