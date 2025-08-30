<?php
require_once 'config.php';

/* --------- AJAX POST: save + return field-level errors --------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    // Read & trim
    $firstName = trim($_POST['firstName'] ?? '');
    $lastName  = trim($_POST['lastName']  ?? '');
    $email     = trim($_POST['email']     ?? '');
    $company   = trim($_POST['company']   ?? '');
    $subject   = trim($_POST['subject']   ?? '');
    $message   = trim($_POST['message']   ?? '');

    // Field-level validation
    $errors = [];
    if ($firstName === '') { $errors['firstName'] = 'First name is required.'; }
    if ($lastName  === '') { $errors['lastName']  = 'Last name is required.'; }
    if ($email === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email.';
    }
    if ($subject === '') { $errors['subject'] = 'Subject is required.'; }
    if ($message === '') { $errors['message'] = 'Message is required.'; }

    if (!empty($errors)) {
        http_response_code(422);
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }

    // Save
    $stmt = $mysqli->prepare(
        "INSERT INTO contact_messages (first_name, last_name, email, company, subject, message)
         VALUES (?,?,?,?,?,?)"
    );
    if ($stmt) {
        $stmt->bind_param('ssssss', $firstName, $lastName, $email, $company, $subject, $message);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            http_response_code(500);
            echo json_encode(['success' => false, 'errors' => ['_form' => 'Failed to save message. Please try again.']] );
        }
        $stmt->close();
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'errors' => ['_form' => 'Database error.']] );
    }
    exit;
}

/* --------- Page meta + header --------- */
$page_title = 'Contact Us - PDFOneLink';
$page_css   = 'assets/webapp/css/contact.css';
$page_js    = ''; // we’ll inline JS below for simplicity
include 'include/header.php';
?>

<style>
/* Small helper styles for inline errors */
.error-message { color:#dc2626; font-size:.875rem; margin-top:.25rem; min-height:1em; }
.is-invalid { border-color:#dc2626 !important; }
.form-success { color:#16a34a; }
.form-error-global { color:#dc2626; margin-bottom:10px; display:none; }
</style>

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

          <!-- global form error (e.g., DB error) -->
          <div id="form_global_error" class="form-error-global"></div>

          <form id="contactForm" novalidate>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="firstName" class="form-label">First Name</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" >
                  <div id="firstName_error" class="error-message"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="lastName" class="form-label">Last Name</label>
                  <input type="text" class="form-control" id="lastName" name="lastName" >
                  <div id="lastName_error" class="error-message"></div>
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" >
              <div id="email_error" class="error-message"></div>
            </div>

            <div class="mb-3">
              <label for="company" class="form-label">Company (Optional)</label>
              <input type="text" class="form-control" id="company" name="company">
              <div id="company_error" class="error-message"></div>
            </div>

            <div class="mb-3">
              <label for="subject" class="form-label">Subject</label>
              <select class="form-select" id="subject" name="subject" >
                <option value="" selected disabled>Select a subject</option>
                <option value="sales">Sales Inquiry</option>
                <option value="support">Technical Support</option>
                <option value="billing">Billing Question</option>
                <option value="partnership">Partnership Opportunity</option>
                <option value="other">Other</option>
              </select>
              <div id="subject_error" class="error-message"></div>
            </div>

            <div class="mb-4">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" name="message" rows="5" ></textarea>
              <div id="message_error" class="error-message"></div>
            </div>

            <button type="submit" class="btn btn-brand btn-lg w-100">Send Message</button>
            <div id="form_success" class="mt-3 form-success" style="display:none;">Thank you for your message! We will get back to you soon.</div>
          </form>
        </div>
      </div>

      <div class="col-lg-5">
        <div class="contact-card">
          <h3 class="section-title mb-4">Contact Information</h3>

          <div class="contact-info-item">
            <div class="contact-icon"><i class="bi bi-envelope"></i></div>
            <div>
              <h5>Email Us</h5>
              <p class="text-muted mb-0">support@pdfonelink.com</p>
              <p class="text-muted">sales@pdfonelink.com</p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon"><i class="bi bi-telephone"></i></div>
            <div>
              <h5>Call Us</h5>
              <p class="text-muted mb-0">+1 (555) 123-4567 (Sales)</p>
              <p class="text-muted">+1 (555) 987-6543 (Support)</p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
            <div>
              <h5>Visit Us</h5>
              <p class="text-muted mb-0">123 Tech Boulevard</p>
              <p class="text-muted">San Francisco, CA 94107</p>
            </div>
          </div>

          <div class="contact-info-item">
            <div class="contact-icon"><i class="bi bi-clock"></i></div>
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
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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

<script>
// Enhanced form validation & submission with per-field errors
(function(){
  const form = document.getElementById('contactForm');
  const globalError = document.getElementById('form_global_error');
  const successMsg  = document.getElementById('form_success');

  const fields = ['firstName','lastName','email','company','subject','message'];

  function clearErrors(){
    globalError.style.display = 'none';
    globalError.textContent = '';
    successMsg.style.display = 'none';

    fields.forEach(id => {
      const input = document.getElementById(id);
      if (input) input.classList.remove('is-invalid');
      const err = document.getElementById(id + '_error');
      if (err) err.textContent = '';
    });
  }

  function setFieldError(id, msg){
    const input = document.getElementById(id);
    const err   = document.getElementById(id + '_error');
    if (input) input.classList.add('is-invalid');
    if (err)   err.textContent = msg || '';
  }

  form.addEventListener('submit', async function(e){
    e.preventDefault();
    clearErrors();

    // client-side validation
    let ok = true;
    const data = new FormData(form);

    if (!data.get('firstName')) { setFieldError('firstName','First name is required.'); ok = false; }
    if (!data.get('lastName'))  { setFieldError('lastName','Last name is required.'); ok = false; }
    const email = data.get('email');
    if (!email) {
      setFieldError('email','Email is required.'); ok = false;
    } else if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
      setFieldError('email','Please enter a valid email.'); ok = false;
    }
    if (!data.get('subject'))   { setFieldError('subject','Subject is required.'); ok = false; }
    if (!data.get('message'))   { setFieldError('message','Message is required.'); ok = false; }

    if (!ok) return;

    // submit to same page
    try{
      const res = await fetch('contact.php', { method:'POST', body:data });
      const json = await res.json();

      if (json.success) {
        form.reset();
        successMsg.style.display = 'block';
        return;
      }

      // Server-side field errors
      if (json.errors) {
        Object.keys(json.errors).forEach(k => {
          if (k === '_form') {
            globalError.textContent = json.errors[k];
            globalError.style.display = 'block';
          } else {
            setFieldError(k, json.errors[k]);
          }
        });
      } else {
        globalError.textContent = json.error || 'There was a problem sending your message.';
        globalError.style.display = 'block';
      }
    } catch(err){
      globalError.textContent = 'There was a problem sending your message.';
      globalError.style.display = 'block';
    }
  });
})();
</script>
