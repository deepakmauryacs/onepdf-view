<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - PDFOneLink</title>
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
        
        .contact-hero {
            background: radial-gradient(1200px 400px at 20% -10%, rgba(34, 211, 238, 0.15), transparent 60%),
                        radial-gradient(1000px 500px at 110% 10%, rgba(37, 99, 235, 0.10), transparent 60%),
                        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            padding: 5rem 0 3rem;
            position: relative;
            overflow: hidden;
        }
        
        .contact-hero::before {
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
        
        .contact-section {
            padding: 5rem 0;
        }
        
        .contact-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 2.5rem;
            box-shadow: var(--shadow);
            height: 100%;
        }
        
        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
        }
        
        .contact-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-right: 1.25rem;
            flex-shrink: 0;
        }
        
        .form-control {
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .form-control:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }
        
        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
        }
        
        .faq-section {
            background: var(--lighter);
            padding: 5rem 0;
        }
        
        .faq-item {
            background: #fff;
            border-radius: var(--radius);
            padding: 1.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--border);
            transition: all 0.2s ease;
        }
        
        .faq-item:hover {
            border-color: var(--brand-light);
        }
        
        .faq-question {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .faq-question i {
            margin-right: 0.75rem;
            color: var(--brand);
        }
        
        .map-container {
            border-radius: var(--radius);
            overflow: hidden;
            height: 300px;
            box-shadow: var(--shadow);
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
            .contact-hero {
                padding: 3rem 0 2rem;
                text-align: center;
            }
            
            .contact-section, .faq-section {
                padding: 3rem 0;
            }
            
            .contact-info-item {
                flex-direction: column;
                text-align: center;
            }
            
            .contact-icon {
                margin-right: 0;
                margin-bottom: 1rem;
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
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">How it works</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Contact</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-ghost btn-sm" href="#">Log in</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-brand btn-sm" href="#">Start free</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-5 fw-bold mb-3">Get in Touch</h1>
                    <p class="lead text-muted mb-4">We'd love to hear from you. Our team is always ready to help with any questions about PDFOneLink.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="contact-card">
                        <h3 class="section-title mb-4">Send us a message</h3>
                        <form id="contactForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="firstName" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="company" class="form-label">Company (Optional)</label>
                                <input type="text" class="form-control" id="company">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-select" id="subject" required>
                                    <option value="" selected disabled>Select a subject</option>
                                    <option value="sales">Sales Inquiry</option>
                                    <option value="support">Technical Support</option>
                                    <option value="billing">Billing Question</option>
                                    <option value="partnership">Partnership Opportunity</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-brand btn-lg w-100">Send Message</button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-5">
                    <div class="contact-card">
                        <h3 class="section-title mb-4">Contact Information</h3>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div>
                                <h5>Email Us</h5>
                                <p class="text-muted mb-0">support@pdfonelink.com</p>
                                <p class="text-muted">sales@pdfonelink.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div>
                                <h5>Call Us</h5>
                                <p class="text-muted mb-0">+1 (555) 123-4567 (Sales)</p>
                                <p class="text-muted">+1 (555) 987-6543 (Support)</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div>
                                <h5>Visit Us</h5>
                                <p class="text-muted mb-0">123 Tech Boulevard</p>
                                <p class="text-muted">San Francisco, CA 94107</p>
                            </div>
                        </div>
                        
                        <div class="contact-info-item">
                            <div class="contact-icon">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div>
                                <h5>Office Hours</h5>
                                <p class="text-muted mb-0">Monday - Friday: 9AM - 6PM PST</p>
                                <p class="text-muted">Weekend: Emergency support only</p>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5 class="mb-3">Follow Us</h5>
                            <div class="social-links">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="py-0">
        <div class="container">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d100940.14245968236!2d-122.43760000000003!3d37.75769999999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan%20Francisco%2C%20CA!5e0!3m2!1sen!2sus!4v1643304382697!5m2!1sen!2sus" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Common Questions</h2>
                <p class="section-subtitle">Quick answers to frequently asked questions</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-question-circle"></i>What's your average response time?</h6>
                        <p class="text-muted mb-0">We typically respond to all inquiries within 24 hours on business days. For urgent matters, please call our support line.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-question-circle"></i>Do you offer custom enterprise solutions?</h6>
                        <p class="text-muted mb-0">Yes, we offer customized enterprise plans with advanced features, dedicated support, and SLA guarantees. Contact our sales team for more information.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-question-circle"></i>How can I request a feature?</h6>
                        <p class="text-muted mb-0">We welcome feature requests! Please email us at feedback@pdfonelink.com with your suggestions. Our product team reviews all requests regularly.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-question-circle"></i>Do you have an affiliate program?</h6>
                        <p class="text-muted mb-0">Yes, we have an affiliate program that offers commissions for referrals. Contact partnerships@pdfonelink.com for more details.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <p class="text-muted">Can't find what you're looking for? <a href="#contactForm">Send us a message</a> and we'll help you out.</p>
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
        // Form submission handling
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Simple form validation
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            if (!firstName || !lastName || !email || !subject || !message) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // Email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return;
            }
            
            // In a real application, you would send the form data to a server here
            // For this example, we'll just show a success message
            alert('Thank you for your message! We will get back to you soon.');
            this.reset();
        });
    </script>
</body>
</html>