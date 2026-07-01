<?php $pageTitle = 'Register | SwiftCargo'; ?>

<form method="POST" action="/SwiftCargo/register" id="register-form">
  <div class="form-group">
    <label class="form-label" for="name">Full Name</label>
    <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
  </div>

  <div class="form-group">
    <label class="form-label" for="email">Email Address</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required>
  </div>

  <div class="form-group">
    <label class="form-label" for="phone">Phone Number</label>
    <input type="text" name="phone" id="phone" class="form-control" placeholder="03001234567" required>
  </div>

  <div class="form-group">
    <label class="form-label" for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Min 6 characters" required>
  </div>

  <div class="form-group">
    <label class="form-label" for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢" required>
  </div>

  <button type="submit" class="btn btn-primary btn-full btn-lg" id="register-btn">
    âœ… Create Account
  </button>
</form>

<p style="text-align:center; margin-top:1.25rem; font-size:0.85rem; color:var(--text-muted);">
  Already have an account?
  <a href="/SwiftCargo/login" style="color:var(--primary-light); font-weight:600;">Sign in</a>
</p>

