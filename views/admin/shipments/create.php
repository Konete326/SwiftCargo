<?php
$pageTitle    = 'New Shipment | SwiftCargo';
$pageSubtitle = 'Create a new courier booking';
?>

<div class="page-header">
  <div>
    <h2>New Shipment</h2>
    <p>Fill in sender and receiver details</p>
  </div>
  <a href="/SwiftCargo/admin/shipments" class="btn btn-outline">← Back</a>
</div>

<div class="form-card">
  <form method="POST" action="/SwiftCargo/admin/shipments/store" id="create-shipment-form">

    <p style="font-size:0.8rem;font-weight:700;color:var(--primary-light);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:1rem;">Sender Details</p>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="sender_name">Sender Name</label>
        <input type="text" name="sender_name" id="sender_name" class="form-control" placeholder="Full name" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="sender_phone">Sender Phone</label>
        <input type="text" name="sender_phone" id="sender_phone" class="form-control" placeholder="03001234567" required>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="sender_city_id">From City</label>
      <select name="sender_city_id" id="sender_city_id" class="form-control" required>
        <option value="">Select city...</option>
        <?php foreach ($cities as $city): ?>
          <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <hr style="border:none;border-top:1px solid var(--border);margin:1.5rem 0;">
    <p style="font-size:0.8rem;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:1rem;">Receiver Details</p>

    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="receiver_name">Receiver Name</label>
        <input type="text" name="receiver_name" id="receiver_name" class="form-control" placeholder="Full name" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="receiver_phone">Receiver Phone</label>
        <input type="text" name="receiver_phone" id="receiver_phone" class="form-control" placeholder="03001234567" required>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="receiver_city_id">To City</label>
      <select name="receiver_city_id" id="receiver_city_id" class="form-control" required>
        <option value="">Select city...</option>
        <?php foreach ($cities as $city): ?>
          <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <hr style="border:none;border-top:1px solid var(--border);margin:1.5rem 0;">
    <p style="font-size:0.8rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.06em;margin-bottom:1rem;">Shipment Details</p>

    <div class="form-row three">
      <div class="form-group">
        <label class="form-label" for="courier_type">Courier Type</label>
        <select name="courier_type" id="courier_type" class="form-control" required>
          <option value="standard">Standard</option>
          <option value="express">Express</option>
          <option value="overnight">Overnight</option>
          <option value="fragile">Fragile</option>
        </select>
      </div>
      <div class="form-group">
        <label class="form-label" for="weight">Weight (kg)</label>
        <input type="number" name="weight" id="weight" class="form-control" placeholder="0.00" step="0.01" min="0.01" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="amount">Amount (Rs.)</label>
        <input type="number" name="amount" id="amount" class="form-control" placeholder="0.00" step="0.01" min="0" required>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="delivery_date">Expected Delivery Date</label>
      <input type="date" name="delivery_date" id="delivery_date" class="form-control" required min="<?= date('Y-m-d') ?>">
    </div>

    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary btn-lg" id="btn-submit-shipment">Create Shipment</button>
      <a href="/SwiftCargo/admin/shipments" class="btn btn-outline btn-lg">Cancel</a>
    </div>

  </form>
</div>
