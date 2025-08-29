<footer class="footer">
    <div class="container">
      <div class="row g-5">
        <div class="col-md-6 col-lg-4">
          <h5 class="mb-4"><i class="bi bi-link-45deg me-2"></i>PDFOneLink</h5>
          <p class="mb-4 text-muted">Secure PDF upload, sharing, permissions, and analytics — all in one link.</p>
          <div class="small text-secondary">© <span id="y"></span> PDFOneLink. All rights reserved.</div>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-4">Product</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="#features">Features</a></li>
            <li class="mb-2"><a href="#pricing">Pricing</a></li>
            <li class="mb-2"><a href="/docs">Docs</a></li>
            <li><a href="/status">Status</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-2">
          <h6 class="mb-4">Company</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="/about">About</a></li>
            <li class="mb-2"><a href="/careers">Careers</a></li>
            <li class="mb-2"><a href="/contact">Contact</a></li>
            <li><a href="/legal">Legal</a></li>
          </ul>
        </div>
        <div class="col-lg-4">
          <h6 class="mb-4">Stay in the loop</h6>
          <form class="d-flex gap-2 mb-2" action="/subscribe" method="post">
            <input type="email" class="form-control" name="email" placeholder="you@example.com" required>
            <button class="btn btn-brand" type="submit"><i class="bi bi-send me-1"></i>Subscribe</button>
          </form>
          <div class="small text-secondary">Get product updates, tips, and guides.</div>
        </div>
      </div>
      <div class="footer-bottom text-center">
        <div class="row">
          <div class="col-md-12">
            <p class="mb-0">Made with <i class="bi bi-heart-fill text-danger"></i> for professionals who care about security and analytics</p>
          </div>
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
