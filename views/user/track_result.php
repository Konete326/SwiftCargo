<?php
$pageTitle = 'Tracking Result | SwiftCargo';

$badgeMap = [
    'booked'           => 'badge-warning',
    'in_transit'       => 'badge-info',
    'out_for_delivery' => 'badge-primary',
    'delivered'        => 'badge-success',
    'cancelled'        => 'badge-danger',
];
$badge = $badgeMap[$shipment['status']] ?? 'badge-secondary';
$statusLabel = ucwords(str_replace('_', ' ', $shipment['status']));
?>

<div style="max-width:680px;margin:2rem auto;">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:0.75rem;">
    <a href="/SwiftCargo/public/user/track" class="btn btn-outline btn-sm">← Track Another</a>
    <button onclick="window.print()" class="btn btn-info btn-sm" id="btn-print">🖨 Print</button>
  </div>

  <div class="track-result">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.5rem;">
      <div class="track-number">📦 <?= htmlspecialchars($shipment['tracking_number']) ?></div>
      <span class="badge <?= $badge ?>" style="font-size:0.85rem;padding:0.4rem 1rem;"><?= $statusLabel ?></span>
    </div>

    <div class="track-route">
      <div class="track-city">
        <span style="font-size:1.5rem;">📤</span>
        <strong><?= htmlspecialchars($shipment['from_city']) ?></strong>
        <span>Sender</span>
      </div>
      <div class="track-arrow">✈ ────</div>
      <div class="track-city">
        <span style="font-size:1.5rem;">📥</span>
        <strong><?= htmlspecialchars($shipment['to_city']) ?></strong>
        <span>Receiver</span>
      </div>
    </div>

    <hr style="border:none;border-top:1px solid var(--border);margin:1.25rem 0;">

    <div class="track-details">
      <div class="detail-item">
        <label>Sender Name</label>
        <span><?= htmlspecialchars($shipment['sender_name']) ?></span>
      </div>
      <div class="detail-item">
        <label>Receiver Name</label>
        <span><?= htmlspecialchars($shipment['receiver_name']) ?></span>
      </div>
      <div class="detail-item">
        <label>Sender Phone</label>
        <span><?= htmlspecialchars($shipment['sender_phone']) ?></span>
      </div>
      <div class="detail-item">
        <label>Receiver Phone</label>
        <span><?= htmlspecialchars($shipment['receiver_phone']) ?></span>
      </div>
      <div class="detail-item">
        <label>Courier Type</label>
        <span><?= ucfirst($shipment['courier_type']) ?></span>
      </div>
      <div class="detail-item">
        <label>Weight</label>
        <span><?= $shipment['weight'] ?> kg</span>
      </div>
      <div class="detail-item">
        <label>Amount</label>
        <span>Rs. <?= number_format($shipment['amount'], 0) ?></span>
      </div>
      <div class="detail-item">
        <label>Expected Delivery</label>
        <span><?= date('M d, Y', strtotime($shipment['delivery_date'])) ?></span>
      </div>
      <div class="detail-item">
        <label>Booked On</label>
        <span><?= date('M d, Y', strtotime($shipment['created_at'])) ?></span>
      </div>
    </div>
  </div>
</div>
