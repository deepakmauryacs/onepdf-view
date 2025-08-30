<footer class="footer">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-6 col-lg-4">
          <h5 class="mb-4"><i class="bi bi-file-earmark-pdf me-2"></i>PDFOneLink</h5>
          <p class="mb-4">Secure PDF upload, sharing, permissions, and analytics — all in one link.</p>

          <div class="social-links">
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-github"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
          </div>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-4">Product</h6>
          <ul>
            <li><a href="/#features">Features</a></li>
            <li><a href="/#pricing">Pricing</a></li>
            <li><a href="/docs">Documentation</a></li>
            <li><a href="/status">Status</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-4">Company</h6>
          <ul>
            <li><a href="/about">About us</a></li>
            <li><a href="/careers">Careers</a></li>
            <li><a href="/blog">Blog</a></li>
            <li><a href="/contact">Contact</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-4">Resources</h6>
          <ul>
            <li><a href="/help">Help center</a></li>
            <li><a href="/tutorials">Tutorials</a></li>
            <li><a href="/webinars">Webinars</a></li>
            <li><a href="/community">Community</a></li>
          </ul>
        </div>
        <div class="col-lg-3">
          <h6 class="mb-4">Newsletter</h6>
          <p class="small mb-3">Get the latest updates, tips, and guides.</p>
          <form class="d-flex gap-2 mb-2" action="/subscribe" method="post">
            <input type="email" class="form-control form-control-sm" name="email" placeholder="Email address" required>
            <button class="btn btn-brand btn-sm" type="submit"><i class="bi bi-arrow-right"></i></button>
          </form>
          <div class="small text-secondary">No spam. Unsubscribe anytime.</div>
        </div>
      </div>
      <div class="footer-bottom">
        <p class="copyright">© <span id="y"></span> PDFOneLink. All rights reserved.</p>
        <div class="legal-links">
          <a href="/privacy">Privacy Policy</a>
          <span class="divider">•</span>
          <a href="/terms">Terms of Service</a>
          <span class="divider">•</span>
          <a href="/cookies">Cookie Policy</a>
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

