<?php
$pageTitle = 'Login | SwiftCargo';
?>
<div class="auth-tabs">
  <button class="auth-tab active" id="tab-btn">Login</button>
</div>

<form method="POST" action="/SwiftCargo/public/login" id="login-form">
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
    <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
  </div>

  <button type="submit" class="btn btn-primary btn-full btn-lg" id="login-btn">
    🔐 Sign In
  </button>
</form>

<p style="text-align:center; margin-top:1.25rem; font-size:0.85rem; color:var(--text-muted);">
  Don't have an account?
  <a href="/SwiftCargo/public/register" style="color:var(--primary-light); font-weight:600;">Register here</a>
</p>
