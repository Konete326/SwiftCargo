<?php $pageTitle = 'Update Status | SwiftCargo'; ?>

<div class="page-header">
  <div><h2>Update Shipment</h2><p style="font-family:monospace;color:var(--primary-light);"><?= htmlspecialchars($shipment['tracking_number']) ?></p></div>
  <a href="/SwiftCargo/public/agent/shipments" class="btn btn-outline">← Back</a>
</div>

<div class="form-card">
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;padding:1.1rem;background:var(--bg-surface);border-radius:var(--radius-sm);border:1px solid var(--border);margin-bottom:1.5rem;">
    <div><p style="font-size:0.72rem;color:var(--text-dim);text-transform:uppercase;">Sender</p><p style="font-weight:600;"><?= htmlspecialchars($shipment['sender_name']) ?></p><p style="font-size:0.8rem;color:var(--text-muted);"><?= htmlspecialchars($shipment['sender_phone']) ?></p></div>
    <div><p style="font-size:0.72rem;color:var(--text-dim);text-transform:uppercase;">Receiver</p><p style="font-weight:600;"><?= htmlspecialchars($shipment['receiver_name']) ?></p><p style="font-size:0.8rem;color:var(--text-muted);"><?= htmlspecialchars($shipment['receiver_phone']) ?></p></div>
  </div>

  <form method="POST" action="/SwiftCargo/public/agent/shipments/update/<?= $shipment['id'] ?>" id="agent-update-form">
    <div class="form-group">
      <label class="form-label" for="status">Shipment Status</label>
      <select name="status" id="status" class="form-control" required>
        <option value="booked"           <?= $shipment['status']==='booked'           ? 'selected':'' ?>>Booked</option>
        <option value="in_transit"       <?= $shipment['status']==='in_transit'       ? 'selected':'' ?>>In Transit</option>
        <option value="out_for_delivery" <?= $shipment['status']==='out_for_delivery' ? 'selected':'' ?>>Out for Delivery</option>
        <option value="delivered"        <?= $shipment['status']==='delivered'        ? 'selected':'' ?>>Delivered</option>
        <option value="cancelled"        <?= $shipment['status']==='cancelled'        ? 'selected':'' ?>>Cancelled</option>
      </select>
    </div>
    <div style="display:flex;gap:1rem;margin-top:0.5rem;">
      <button type="submit" class="btn btn-primary btn-lg" id="btn-agent-update">💾 Update Status</button>
      <a href="/SwiftCargo/public/agent/shipments" class="btn btn-outline btn-lg">Cancel</a>
    </div>
  </form>
</div>
