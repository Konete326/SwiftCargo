<?php
$pageTitle    = 'Edit Shipment | SwiftCargo';
$pageSubtitle = 'Update shipment status';
?>

<div class="page-header">
  <div>
    <h2>Edit Shipment</h2>
    <p style="font-family:monospace;color:var(--primary-light);"><?= htmlspecialchars($shipment['tracking_number']) ?></p>
  </div>
  <a href="/SwiftCargo/admin/shipments" class="btn btn-outline">â† Back</a>
</div>

<div class="form-card">
  <form method="POST" action="/SwiftCargo/admin/shipments/update/<?= $shipment['id'] ?>" id="edit-shipment-form">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;padding:1.25rem;background:var(--bg-surface);border-radius:var(--radius-sm);border:1px solid var(--border);">
      <div>
        <p style="font-size:0.72rem;color:var(--text-dim);text-transform:uppercase;letter-spacing:0.05em;">Sender</p>
        <p style="font-weight:600;margin-top:0.2rem;"><?= htmlspecialchars($shipment['sender_name']) ?></p>
        <p style="font-size:0.82rem;color:var(--text-muted);"><?= htmlspecialchars($shipment['sender_phone']) ?></p>
      </div>
      <div>
        <p style="font-size:0.72rem;color:var(--text-dim);text-transform:uppercase;letter-spacing:0.05em;">Receiver</p>
        <p style="font-weight:600;margin-top:0.2rem;"><?= htmlspecialchars($shipment['receiver_name']) ?></p>
        <p style="font-size:0.82rem;color:var(--text-muted);"><?= htmlspecialchars($shipment['receiver_phone']) ?></p>
      </div>
    </div>

    <div class="form-group">
      <label class="form-label" for="status">Update Status</label>
      <select name="status" id="status" class="form-control" required>
        <option value="booked"            <?= $shipment['status'] === 'booked'            ? 'selected' : '' ?>>Booked</option>
        <option value="in_transit"        <?= $shipment['status'] === 'in_transit'        ? 'selected' : '' ?>>In Transit</option>
        <option value="out_for_delivery"  <?= $shipment['status'] === 'out_for_delivery'  ? 'selected' : '' ?>>Out for Delivery</option>
        <option value="delivered"         <?= $shipment['status'] === 'delivered'         ? 'selected' : '' ?>>Delivered</option>
        <option value="cancelled"         <?= $shipment['status'] === 'cancelled'         ? 'selected' : '' ?>>Cancelled</option>
      </select>
    </div>

    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary btn-lg" id="btn-update-shipment">ðŸ’¾ Update Status</button>
      <a href="/SwiftCargo/admin/shipments" class="btn btn-outline btn-lg">Cancel</a>
    </div>

  </form>
</div>

