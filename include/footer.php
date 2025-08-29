<footer class="footer site-footer">
    <div class="container py-5">
        <div class="row gy-4">
            <div class="col-md-4">
                <h5 class="footer-brand">PDFOneLink</h5>
                <p class="footer-desc">Secure PDF upload, sharing, permissions, and analytics — all in one link.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                    <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <h6 class="mb-4">Quick Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="features.php">Features</a></li>
                    <li class="mb-2"><a href="how-it-works.php">How It Works</a></li>
                    <li class="mb-2"><a href="pricing.php">Pricing</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-lg-3 ms-auto">
                <h6 class="mb-4">Contact Us</h6>
                <ul class="list-unstyled footer-contact">
                    <li class="mb-3">
                        <i class="bi bi-telephone me-3"></i>
                        <div>
                            <div>Call Us 24/7</div>
                            <a href="tel:+12455245626" class="small">(+1) 245-524-5626</a>
                        </div>
                    </li>
                    <li class="mb-3">
                        <i class="bi bi-envelope me-3"></i>
                        <div>
                            <div>Work with us</div>
                            <a href="mailto:info@pdfonelink.com" class="small">info@pdfonelink.com</a>
                        </div>
                    </li>
                    <li>
                        <i class="bi bi-geo-alt me-3"></i>
                        <div>
                            <div>Our Location</div>
                            <span class="small">X17 Hilton Street, 125 Town, USA</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="small">PDFOneLink - &copy; <?= date('Y') ?>. All rights reserved.</div>
            <div class="small">
                <a href="#">Privacy Policy</a>
                <span class="mx-2">|</span>
                <a href="#">Terms &amp; Condition</a>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/webapp/js/main.js"></script>
<?php if (!empty($page_js)): ?>
<script src="<?= $page_js ?>"></script>
<?php endif; ?>
</body>
</html>
