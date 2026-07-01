<?php
$pageTitle    = 'Edit Agent | SwiftCargo';
$pageSubtitle = 'Update agent details';
?>

<div class="page-header">
  <div><h2>Edit Agent</h2><p><?= htmlspecialchars($agent['name']) ?></p></div>
  <a href="/SwiftCargo/public/admin/agents" class="btn btn-outline">← Back</a>
</div>

<div class="form-card">
  <form method="POST" action="/SwiftCargo/public/admin/agents/update/<?= $agent['id'] ?>" id="edit-agent-form">

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="name">Full Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($agent['name']) ?>" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($agent['phone']) ?>" required>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="email">Email</label>
      <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($agent['email']) ?>" required>
    </div>

    <div class="form-group">
      <label class="form-label" for="city_id">Assigned City</label>
      <select name="city_id" id="city_id" class="form-control" required>
        <?php foreach ($cities as $city): ?>
          <option value="<?= $city['id'] ?>" <?= $agent['city_id'] == $city['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($city['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary btn-lg" id="btn-update-agent">💾 Update Agent</button>
      <a href="/SwiftCargo/public/admin/agents" class="btn btn-outline btn-lg">Cancel</a>
    </div>

  </form>
</div>
