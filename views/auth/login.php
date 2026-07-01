<?php $pageTitle = 'Sign In | SwiftCargo'; ?>

<div class="auth-tab-row">
  <a href="/SwiftCargo/login" class="auth-tab-link active">Sign In</a>
  <a href="/SwiftCargo/register" class="auth-tab-link">Sign Up</a>
</div>

<div class="auth-form-header">
  <h2>Welcome Back</h2>
  <p>Sign in to your SwiftCargo account</p>
</div>

<form method="POST" action="/SwiftCargo/login" id="login-form">
  <div class="form-group">
    <label class="form-label" for="role">Login As</label>
    <select name="role" id="role" class="form-control">
      <option value="user">Customer</option>
      <option value="agent">Agent</option>
      <option value="admin">Admin</option>
    </select>
  </div>

  <div class="form-group">
    <label class="form-label" for="email">Email Address</label>
    <input type="email" name="email" id="email" class="form-control" placeholder="you@example.com" required>
  </div>

  <div class="form-group">
    <label class="form-label" for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
  </div>

  <button type="submit" class="btn btn-primary btn-full btn-lg" id="login-btn">
    Sign In
  </button>
</form>

<p class="auth-switch-text">
  Don't have an account?
  <a href="/SwiftCargo/register">Create one here</a>
</p>
