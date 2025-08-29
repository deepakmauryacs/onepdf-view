<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing - PDFOneLink</title>
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
        
        .pricing-hero {
            background: radial-gradient(1200px 400px at 20% -10%, rgba(34, 211, 238, 0.15), transparent 60%),
                        radial-gradient(1000px 500px at 110% 10%, rgba(37, 99, 235, 0.10), transparent 60%),
                        linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            padding: 5rem 0 3rem;
            position: relative;
            overflow: hidden;
        }
        
        .pricing-hero::before {
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
        
        .pricing-section {
            padding: 5rem 0;
        }
        
        .plan {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2.5rem 2rem;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .plan:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        
        .plan.featured {
            border-color: var(--brand);
            box-shadow: var(--shadow-xl);
        }
        
        .plan.featured::before {
            content: 'Most Popular';
            position: absolute;
            top: -12px;
            right: 2rem;
            background: var(--brand);
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.25rem 1rem;
            border-radius: 50px;
        }
        
        .plan-title {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .plan-price {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--text);
        }
        
        .plan-features {
            list-style: none;
            padding: 0;
            margin: 0 0 2rem 0;
        }
        
        .plan-features li {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
        }
        
        .plan-features li i {
            margin-right: 0.75rem;
        }
        
        .check {
            color: var(--success);
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
        
        .comparison-section {
            padding: 5rem 0;
        }
        
        .comparison-table {
            background: #fff;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .comparison-table th {
            background: var(--lighter);
            padding: 1.25rem;
            font-weight: 600;
        }
        
        .comparison-table td {
            padding: 1.25rem;
            border-bottom: 1px solid var(--border);
        }
        
        .comparison-table tr:last-child td {
            border-bottom: none;
        }
        
        .testimonial-section {
            background: linear-gradient(135deg, #e0f2fe 0%, #eef2ff 100%);
            padding: 5rem 0;
        }
        
        .testimonial-card {
            background: #fff;
            border-radius: var(--radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            height: 100%;
        }
        
        .testimonial-text {
            position: relative;
            padding: 0 0 1.5rem 0;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        
        .testimonial-text::before {
            content: """;
            font-size: 4rem;
            color: var(--brand-light);
            opacity: 0.2;
            position: absolute;
            top: -1.5rem;
            left: -0.5rem;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .testimonial-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--brand-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            margin-right: 1rem;
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
            .pricing-hero {
                padding: 3rem 0 2rem;
                text-align: center;
            }
            
            .pricing-section, .faq-section, .comparison-section, .testimonial-section {
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
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">How it works</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">FAQ</a></li>
                    <li class="nav-item ms-lg-3"><a class="btn btn-ghost btn-sm" href="#">Log in</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-brand btn-sm" href="#">Start free</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pricing-hero">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-5 fw-bold mb-3">Simple, Transparent Pricing</h1>
                    <p class="lead text-muted mb-4">Choose the plan that works best for you. All plans include our core features with no hidden fees.</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="#pricing" class="btn btn-brand btn-lg">View Plans</a>
                        <a href="#faq" class="btn btn-ghost btn-lg">See FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Plans for Every Need</h2>
                <p class="section-subtitle">Start free. Upgrade when you're ready.</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="plan">
                        <h5 class="plan-title">Free</h5>
                        <div class="plan-price">$0<span class="fs-6 text-muted">/mo</span></div>
                        <p class="text-muted">Perfect for individuals getting started</p>
                        <ul class="plan-features">
                            <li><i class="bi bi-check2 check"></i>500 MB storage</li>
                            <li><i class="bi bi-check2 check"></i>Basic analytics</li>
                            <li><i class="bi bi-check2 check"></i>Embed viewer</li>
                            <li><i class="bi bi-check2 check"></i>Up to 10 documents</li>
                            <li><i class="bi bi-check2 check"></i>Standard support</li>
                            <li><i class="bi bi-x text-muted"></i>Permission controls</li>
                            <li><i class="bi bi-x text-muted"></i>Custom branding</li>
                            <li><i class="bi bi-x text-muted"></i>Advanced analytics</li>
                        </ul>
                        <a href="/register" class="btn btn-ghost w-100">Start free</a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="plan featured">
                        <h5 class="plan-title">Pro</h5>
                        <div class="plan-price">$12<span class="fs-6 text-muted">/mo</span></div>
                        <p class="text-muted">Ideal for professionals and small teams</p>
                        <ul class="plan-features">
                            <li><i class="bi bi-check2 check"></i>10 GB storage</li>
                            <li><i class="bi bi-check2 check"></i>Advanced analytics</li>
                            <li><i class="bi bi-check2 check"></i>Disable download/print</li>
                            <li><i class="bi bi-check2 check"></i>Custom watermark</li>
                            <li><i class="bi bi-check2 check"></i>Link expiry & revocation</li>
                            <li><i class="bi bi-check2 check"></i>Unlimited documents</li>
                            <li><i class="bi bi-check2 check"></i>Priority support</li>
                            <li><i class="bi bi-x text-muted"></i>Team collaboration</li>
                        </ul>
                        <a href="/register" class="btn btn-brand w-100">Choose Pro</a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="plan">
                        <h5 class="plan-title">Business</h5>
                        <div class="plan-price">$29<span class="fs-6 text-muted">/mo</span></div>
                        <p class="text-muted">For organizations with advanced needs</p>
                        <ul class="plan-features">
                            <li><i class="bi bi-check2 check"></i>Unlimited storage</li>
                            <li><i class="bi bi-check2 check"></i>SSO, API & webhooks</li>
                            <li><i class="bi bi-check2 check"></i>OCR & full-text search</li>
                            <li><i class="bi bi-check2 check"></i>Domain/IP allowlists</li>
                            <li><i class="bi bi-check2 check"></i>Team collaboration</li>
                            <li><i class="bi bi-check2 check"></i>Custom branding</li>
                            <li><i class="bi bi-check2 check"></i>Advanced permissions</li>
                            <li><i class="bi bi-check2 check"></i>Dedicated support</li>
                        </ul>
                        <a href="/contact" class="btn btn-ghost w-100">Talk to sales</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <p class="text-muted">Need a custom plan? <a href="/contact">Contact us</a> for enterprise solutions.</p>
            </div>
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="comparison-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Plan Comparison</h2>
                <p class="section-subtitle">See how our plans stack up against each other</p>
            </div>
            
            <div class="comparison-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Feature</th>
                            <th scope="col" class="text-center">Free</th>
                            <th scope="col" class="text-center">Pro</th>
                            <th scope="col" class="text-center">Business</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Storage</td>
                            <td class="text-center">500 MB</td>
                            <td class="text-center">10 GB</td>
                            <td class="text-center">Unlimited</td>
                        </tr>
                        <tr>
                            <td>Documents</td>
                            <td class="text-center">Up to 10</td>
                            <td class="text-center">Unlimited</td>
                            <td class="text-center">Unlimited</td>
                        </tr>
                        <tr>
                            <td>Download prevention</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>Print prevention</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>Custom watermarks</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>Link expiration</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>Advanced analytics</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>API access</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>Team collaboration</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                        <tr>
                            <td>Priority support</td>
                            <td class="text-center"><i class="bi bi-x text-muted"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                            <td class="text-center"><i class="bi bi-check2 check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonial-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Loved by Professionals</h2>
                <p class="section-subtitle">See what our customers are saying about PDFOneLink</p>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            <p>PDFOneLink has transformed how we share sensitive documents with clients. The analytics help us understand engagement, and the security features give us peace of mind.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">SA</div>
                            <div>
                                <h6 class="mb-0">Sarah Anderson</h6>
                                <p class="text-muted small mb-0">Legal Consultant</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            <p>The ability to control who can view, download, or print our documents has been a game-changer for our business. The pricing is fair and the platform is incredibly reliable.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">MJ</div>
                            <div>
                                <h6 class="mb-0">Michael Johnson</h6>
                                <p class="text-muted small mb-0">Marketing Director</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card">
                        <div class="testimonial-text">
                            <p>We switched to PDFOneLink from another service and couldn't be happier. The embed features work seamlessly on our website, and our clients find the viewer intuitive to use.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">ER</div>
                            <div>
                                <h6 class="mb-0">Emily Rodriguez</h6>
                                <p class="text-muted small mb-0">CTO, Tech Startup</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title centered">Frequently Asked Questions</h2>
                <p class="section-subtitle">Everything you need to know about our pricing</p>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-credit-card"></i>What payment methods do you accept?</h6>
                        <p class="text-muted mb-0">We accept all major credit cards, PayPal, and bank transfers for annual plans. All payments are processed securely through our payment partners.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-arrow-left-right"></i>Can I change my plan later?</h6>
                        <p class="text-muted mb-0">Yes, you can upgrade or downgrade your plan at any time. When upgrading, the new rate will be prorated. When downgrading, changes take effect at the next billing cycle.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-x-circle"></i>Is there a cancellation fee?</h6>
                        <p class="text-muted mb-0">No, there are no cancellation fees. You can cancel your subscription at any time, and you'll continue to have access until the end of your billing period.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-receipt"></i>Do you offer refunds?</h6>
                        <p class="text-muted mb-0">We offer a 14-day money-back guarantee for all annual plans. If you're not satisfied, contact our support team for a full refund.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-building"></i>Do you offer discounts for nonprofits?</h6>
                        <p class="text-muted mb-0">Yes, we offer a 20% discount for registered nonprofit organizations. Contact our sales team with proof of your nonprofit status to get started.</p>
                    </div>
                    
                    <div class="faq-item">
                        <h6 class="faq-question"><i class="bi bi-people"></i>Do you have team pricing?</h6>
                        <p class="text-muted mb-0">Yes, our Business plan includes team features. For larger organizations, we offer enterprise pricing with custom terms. Contact us for more information.</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <p class="text-muted">Still have questions? <a href="/contact">Contact our team</a> for more information.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="pricing-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mb-4">Ready to get started?</h2>
                    <p class="text-muted mb-4">Join thousands of professionals who trust PDFOneLink with their document sharing needs.</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="/register" class="btn btn-brand btn-lg">Start free trial</a>
                        <a href="/contact" class="btn btn-ghost btn-lg">Contact sales</a>
                    </div>
                    <p class="text-muted small mt-3">No credit card required. Try all features free for 14 days.</p>
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
</body>
</html>