<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - PDFOneLink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --brand: #2563eb;
            --brand-light: #3b82f6;
            --brand-dark: #1d4ed8;
            --accent: #22d3ee;
            --text: #0f172a;
            --text-light: #334155;
            --muted: #64748b;
            --light: #f8fafc;
            --lighter: #f1f5f9;
            --bg: #0b1220;
            --border: #e2e8f0;
            --success: #10b981;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        body {
            font-family: "DM Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: var(--text);
            line-height: 1.6;
            background-color: var(--light);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            line-height: 1.3;
        }
        
        .navbar {
            padding: 1rem 0;
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
        }
        
        .btn-brand {
            background: var(--brand);
            color: #fff;
            font-weight: 600;
            padding: 0.625rem 1.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-brand:hover {
            background: var(--brand-dark);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .btn-ghost {
            border: 1px solid var(--border);
            color: var(--text);
            font-weight: 600;
            padding: 0.625rem 1.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .btn-ghost:hover {
            background: var(--lighter);
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }
        
        .features-hero {
            background: radial-gradient(1200px 400px at 20% -10%, rgba(34, 211, 238, 0.15), transparent 60%),
                        radial-gradient(1000px 500px at 110% 10%, rgba(37, 99, 235, 0.10), transparent 60%),
                        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            padding: 5rem 0 3rem;
            position: relative;
            overflow: hidden;
        }
        
        .features-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232563eb' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        .section-title {
            font-weight: 800;
            margin-bottom: 1rem;
            position: relative;
        }
        
        .section-title.centered {
            text-align: center;
        }
        
        .section-title.centered::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background: var(--brand);
            margin: 1rem auto;
            border-radius: 2px;
        }
        
        .section-subtitle {
            color: var(--muted);
            font-size: 1.125rem;
            margin-bottom: 3rem;
            text-align: center;
        }
        
        .features-section {
            padding: 5rem 0;
        }
        
        .feature-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 2.5rem;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--brand-light);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .feature-list li {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        
        .feature-list li i {
            margin-right: 0.75rem;
            color: var(--success);
        }
        
        .demo-section {
            background: var(--lighter);
            padding: 5rem 0;
        }
        
        .demo-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
        }
        
        .tab-content {
            padding: 2rem 0;
        }
        
        .nav-pills .nav-link {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            color: var(--text);
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .nav-pills .nav-link.active {
            background: var(--brand);
            color: white;
        }
        
        .nav-pills .nav-link:hover:not(.active) {
            background: var(--lighter);
        }
        
        .use-cases {
            padding: 5rem 0;
        }
        
        .use-case-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
        }
        
        .use-case-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-lg);
        }
        
        .use-case-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
        }
        
        .integration-section {
            background: linear-gradient(135deg, #e0f2fe 0%, #eef2ff 100%);
            padding: 5rem 0;
        }
        
        .integration-logo {
            height: 50px;
            margin: 1rem;
            opacity: 0.7;
            transition: all 0.3s ease;
        }
        
        .integration-logo:hover {
            opacity: 1;
            transform: scale(1.05);
        }
        
        .footer {
            background: var(--bg);
            color: #e2e8f0;
            padding: 4rem 0 2rem;
        }
        
        .footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .footer a:hover {
            color: #fff;
            text-decoration: underline;
        }
        
        .footer-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        .footer-desc {
            color: #94a3b8;
            margin-bottom: 2rem;
            max-width: 300px;
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 3rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: #cbd5e1;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--brand);
            color: white;
            transform: translateY(-3px);
        }
        
        .made-with-love {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #94a3b8;
        }
        
        @media (max-width: 768px) {
            .features-hero {
                padding: 3rem 0 2rem;
                text-align: center;
            }
            
            .features-section, .demo-section, .use-cases, .integration-section {
                padding: 3rem 0;
            }
            
            .footer {
                text-align: center;
            }
            
            .footer-desc {
                margin-left: auto;
                margin-right: auto;
            }
            
            .social-links {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-link-45deg me-2 text-primary"></i>PDFOneLink
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">How it works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-ghost btn-sm" href="#">Log in</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-brand btn-sm" href="#">Start free</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="features-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-5 fw-bold mb-3">Powerful Features for Secure PDF Sharing</h1>
                    <p class="lead text-muted mb-4">Everything you need to share, protect, and track your PDF documents with confidence.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#features" class="btn btn-brand btn-lg">Explore Features</a>
                        <a href="#" class="btn btn-ghost btn-lg">See Live Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Complete PDF Security & Sharing Solution</h2>
                <p class="section-subtitle">All the tools you need to share documents securely and track their performance</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <h3>Easy Upload & Organization</h3>
                        <p>Quickly upload PDFs with drag-and-drop functionality and keep them organized with folders and tags.</p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check2"></i>Drag & drop upload</li>
                            <li><i class="bi bi-check2"></i>Folder organization</li>
                            <li><i class="bi bi-check2"></i>File versioning</li>
                            <li><i class="bi bi-check2"></i>Batch operations</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        <h3>Advanced Security Controls</h3>
                        <p>Protect your documents with granular permission settings and access controls.</p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check2"></i>View-only mode</li>
                            <li><i class="bi bi-check2"></i>Download prevention</li>
                            <li><i class="bi bi-check2"></i>Print restriction</li>
                            <li><i class="bi bi-check2"></i>Password protection</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <h3>Detailed Analytics</h3>
                        <p>Gain insights into how your documents are being viewed and engaged with.</p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check2"></i>View tracking</li>
                            <li><i class="bi bi-check2"></i>Time-on-page analytics</li>
                            <li><i class="bi bi-check2"></i>Geographic data</li>
                            <li><i class="bi bi-check2"></i>Device information</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-link-45deg"></i>
                        </div>
                        <h3>Smart Link Management</h3>
                        <p>Create and manage shareable links with advanced controls and customization.</p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check2"></i>Expiring links</li>
                            <li><i class="bi bi-check2"></i>Access revocation</li>
                            <li><i class="bi bi-check2"></i>Password protection</li>
                            <li><i class="bi bi-check2"></i>Custom domains</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <h3>Seamless Embedding</h3>
                        <p>Easily embed PDF viewers directly into your website or application.</p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check2"></i>Responsive iframes</li>
                            <li><i class="bi bi-check2"></i>Custom styling</li>
                            <li><i class="bi bi-check2"></i>White-label options</li>
                            <li><i class="bi bi-check2"></i>API access</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <h3>Advanced Configuration</h3>
                        <p>Customize the viewing experience with advanced settings and options.</p>
                        <ul class="feature-list">
                            <li><i class="bi bi-check2"></i>Custom watermarks</li>
                            <li><i class="bi bi-check2"></i>Branding options</li>
                            <li><i class="bi bi-check2"></i>Domain restrictions</li>
                            <li><i class="bi bi-check2"></i>IP allowlisting</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Demo Section -->
    <section class="demo-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">See It In Action</h2>
                <p class="section-subtitle">Explore how PDFOneLink works with our interactive demo</p>
            </div>
            
            <div class="demo-card">
                <ul class="nav nav-pills mb-4 justify-content-center" id="demoTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="upload-tab" data-bs-toggle="pill" data-bs-target="#upload" type="button" role="tab">Upload</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">Security</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sharing-tab" data-bs-toggle="pill" data-bs-target="#sharing" type="button" role="tab">Sharing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="analytics-tab" data-bs-toggle="pill" data-bs-target="#analytics" type="button" role="tab">Analytics</button>
                    </li>
                </ul>
                
                <div class="tab-content" id="demoTabsContent">
                    <div class="tab-pane fade show active" id="upload" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h3>Simple Drag & Drop Upload</h3>
                                <p>Upload your PDFs in seconds with our intuitive interface. Organize them into folders and add tags for easy management.</p>
                                <ul class="feature-list">
                                    <li><i class="bi bi-check2"></i>Support for large files</li>
                                    <li><i class="bi bi-check2"></i>Bulk upload capabilities</li>
                                    <li><i class="bi bi-check2"></i>Automatic OCR for scanned documents</li>
                                    <li><i class="bi bi-check2"></i>File preview before publishing</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="border rounded-3 p-5 bg-white">
                                    <i class="bi bi-cloud-arrow-up display-4 text-primary mb-3"></i>
                                    <p class="text-muted">Drag your PDF here or click to browse</p>
                                    <button class="btn btn-sm btn-ghost">Select Files</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="security" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h3>Advanced Security Controls</h3>
                                <p>Protect your documents with granular permission settings. Control exactly what viewers can and cannot do with your PDFs.</p>
                                <ul class="feature-list">
                                    <li><i class="bi bi-check2"></i>Disable downloading and printing</li>
                                    <li><i class="bi bi-check2"></i>Add dynamic watermarks</li>
                                    <li><i class="bi bi-check2"></i>Set expiration dates</li>
                                    <li><i class="bi bi-check2"></i>Restrict access by domain or IP</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="border rounded-3 p-5 bg-white">
                                    <i class="bi bi-shield-check display-4 text-primary mb-3"></i>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="downloadSwitch" checked>
                                        <label class="form-check-label" for="downloadSwitch">Allow downloading</label>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="printSwitch">
                                        <label class="form-check-label" for="printSwitch">Allow printing</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="watermarkSwitch" checked>
                                        <label class="form-check-label" for="watermarkSwitch">Add watermark</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="sharing" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h3>Flexible Sharing Options</h3>
                                <p>Share your documents with specific people or make them publicly accessible. Generate secure links or embed codes.</p>
                                <ul class="feature-list">
                                    <li><i class="bi bi-check2"></i>Generate shareable links</li>
                                    <li><i class="bi bi-check2"></i>Create embeddable viewers</li>
                                    <li><i class="bi bi-check2"></i>Set password protection</li>
                                    <li><i class="bi bi-check2"></i>Track who accessed your documents</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="border rounded-3 p-4 bg-white">
                                    <h5 class="mb-3">Share Document</h5>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="https://pdfonelink.com/doc/abc123" readonly>
                                        <button class="btn btn-outline-secondary" type="button"><i class="bi bi-clipboard"></i></button>
                                    </div>
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" type="checkbox" id="expirySwitch">
                                        <label class="form-check-label" for="expirySwitch">Set expiration</label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="passwordSwitch" checked>
                                        <label class="form-check-label" for="passwordSwitch">Password protect</label>
                                    </div>
                                    <button class="btn btn-brand w-100">Copy Link</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="analytics" role="tabpanel">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <h3>Detailed View Analytics</h3>
                                <p>Track how your documents are performing with comprehensive analytics. See who viewed your PDFs and how they engaged with them.</p>
                                <ul class="feature-list">
                                    <li><i class="bi bi-check2"></i>View count and unique visitors</li>
                                    <li><i class="bi bi-check2"></i>Time spent per page</li>
                                    <li><i class="bi bi-check2"></i>Geographic location data</li>
                                    <li><i class="bi bi-check2"></i>Device and browser information</li>
                                </ul>
                            </div>
                            <div class="col-lg-6 text-center">
                                <div class="border rounded-3 p-4 bg-white">
                                    <h5 class="mb-3">Document Analytics</h5>
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <div class="fw-bold">142</div>
                                            <div class="text-muted small">Total Views</div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">87</div>
                                            <div class="text-muted small">Unique Views</div>
                                        </div>
                                        <div>
                                            <div class="fw-bold">3:42</div>
                                            <div class="text-muted small">Avg. Time</div>
                                        </div>
                                    </div>
                                    <div class="bg-light rounded-3 p-2 mb-3">
                                        <div class="d-flex justify-content-between small">
                                            <span>Page 1</span>
                                            <span>92% viewed</span>
                                        </div>
                                        <div class="progress mb-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 92%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between small">
                                            <span>Page 2</span>
                                            <span>78% viewed</span>
                                        </div>
                                        <div class="progress mb-2" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                        </div>
                                        <div class="d-flex justify-content-between small">
                                            <span>Page 3</span>
                                            <span>64% viewed</span>
                                        </div>
                                        <div class="progress" style="height: 5px;">
                                            <div class="progress-bar" role="progressbar" style="width: 64%"></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-ghost w-100">View Full Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section class="use-cases">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Perfect For Every Use Case</h2>
                <p class="section-subtitle">PDFOneLink helps professionals across industries share documents securely</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="use-case-card">
                        <div class="use-case-icon">
                            <i class="bi bi-briefcase"></i>
                        </div>
                        <h4>Business Proposals</h4>
                        <p>Share sensitive business proposals while preventing unauthorized distribution.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="use-case-card">
                        <div class="use-case-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h4>Educational Materials</h4>
                        <p>Distribute course materials while maintaining control over your intellectual property.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="use-case-card">
                        <div class="use-case-icon">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <h4>Legal Documents</h4>
                        <p>Share legal contracts and documents securely with clients and colleagues.</p>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="use-case-card">
                        <div class="use-case-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <h4>Reports & Whitepapers</h4>
                        <p>Distribute valuable content while tracking engagement and interest.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Integration Section -->
    <section class="integration-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Works With Your Tools</h2>
                <p class="section-subtitle">PDFOneLink integrates seamlessly with the platforms you already use</p>
            </div>
            
            <div class="d-flex flex-wrap justify-content-center align-items-center">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/slack/slack-original.svg" class="integration-logo" alt="Slack">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/google/google-original.svg" class="integration-logo" alt="Google">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/microsoft/microsoft-original.svg" class="integration-logo" alt="Microsoft">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/salesforce/salesforce-original.svg" class="integration-logo" alt="Salesforce">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/wordpress/wordpress-original.svg" class="integration-logo" alt="WordPress">
                <img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/zapier/zapier-original.svg" class="integration-logo" alt="Zapier">
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-brand">View All Integrations</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="features-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Ready to try PDFOneLink?</h2>
                    <p class="text-muted mb-4">Start sharing your PDFs securely today. No credit card required.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="#" class="btn btn-brand btn-lg">Get Started for Free</a>
                        <a href="#" class="btn btn-ghost btn-lg">Schedule a Demo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <a href="#" class="footer-brand">
                        <i class="bi bi-link-45deg me-2"></i>PDFOneLink
                    </a>
                    <p class="footer-desc">
                        Secure PDF upload, sharing, permissions, and analytics — all in one link.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-github"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
                
                <div class="col-6 col-md-3 col-lg-2">
                    <h6>Product</h6>
                    <ul>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Documentation</a></li>
                        <li><a href="#">Status</a></li>
                    </ul>
                </div>
                
                <div class="col-6 col-md-3 col-lg-2">
                    <h6>Company</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Legal</a></li>
                    </ul>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <h6>Stay in the loop</h6>
                    <p class="text-muted">Get product updates, tips, and guides.</p>
                    <form class="newsletter-form">
                        <input type="email" class="newsletter-input" placeholder="you@example.com" required>
                        <button type="submit" class="newsletter-btn">Subscribe</button>
                    </form>
                    <div class="text-muted small">We respect your privacy. Unsubscribe anytime.</div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="text-muted small">© 2025 PDFOneLink. All rights reserved.</div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="made-with-love">
                            <span>Made with</span>
                            <i class="bi bi-heart-fill text-danger"></i>
                            <span>for professionals who care about security and analytics</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
        
        // Demo interactivity
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', function() {
                const card = this.closest('.border');
                if (this.checked) {
                    card.classList.add('border-primary');
                } else {
                    card.classList.remove('border-primary');
                }
            });
        });
    </script>
</body>
</html>