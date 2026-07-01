<?php
$pageTitle    = 'Add Agent | SwiftCargo';
$pageSubtitle = 'Create a new branch agent';
?>

<div class="page-header">
  <div><h2>Add Agent</h2><p>Create a city-wise branch agent login</p></div>
  <a href="/SwiftCargo/public/admin/agents" class="btn btn-outline">← Back</a>
</div>

<div class="form-card">
  <form method="POST" action="/SwiftCargo/public/admin/agents/store" id="create-agent-form">

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Agent name" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="03001234567" required>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" placeholder="agent@example.com" required>
    </div>

    <div class="form-group">
      <label class="form-label" for="city_id">Assigned City</label>
      <select name="city_id" id="city_id" class="form-control" required>
        <option value="">Select city...</option>
        <?php foreach ($cities as $city): ?>
          <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Min 6 characters" required>
      </div>
      <div class="form-group">
        <label class="form-label">&nbsp;</label>
        <p style="font-size:0.8rem;color:var(--text-muted);padding:0.7rem 0;">Agent will use this password to login</p>
      </div>
    </div>

    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary btn-lg" id="btn-save-agent">👤 Create Agent</button>
      <a href="/SwiftCargo/public/admin/agents" class="btn btn-outline btn-lg">Cancel</a>
    </div>

  </form>
</div>
