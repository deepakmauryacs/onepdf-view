<?php
$page_title = 'Contact Us - PDFOneLink';
$page_css = 'assets/webapp/css/contact.css';
$page_js = 'assets/webapp/js/contact.js';
include 'include/header.php';
?>


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

    <?php include 'include/footer.php'; ?>
