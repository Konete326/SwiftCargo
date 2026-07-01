<?php $pageTitle = 'Sign Up | SwiftCargo'; ?>

<div class="auth-tab-row">
  <a href="/SwiftCargo/login" class="auth-tab-link">Sign In</a>
  <a href="/SwiftCargo/register" class="auth-tab-link active">Sign Up</a>
</div>

<div class="auth-form-header">
  <h2>Create Account</h2>
  <p>Register to start tracking your shipments</p>
</div>

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
    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Repeat your password" required>
  </div>

  <button type="submit" class="btn btn-primary btn-full btn-lg" id="register-btn">
    Create Account
  </button>
</form>

<p class="auth-switch-text">
  Already have an account?
  <a href="/SwiftCargo/login">Sign in here</a>
</p>
