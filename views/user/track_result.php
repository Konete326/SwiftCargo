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

<style>
@media print {
  body { background: white !important; color: black !important; }
  header, .btn, hr, a, button { display: none !important; }
  .track-result { border: none !important; box-shadow: none !important; background: transparent !important; margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }
  .track-route, .track-details { color: black !important; }
  .track-number { background: #eee !important; border: 1px solid #ccc !important; color: black !important; }
  .badge { border: 1px solid #ccc !important; color: black !important; background: transparent !important; }
}
</style>

<div style="max-width:680px;margin:2rem auto;">
  <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.5rem;flex-wrap:wrap;gap:0.75rem;">
    <a href="/SwiftCargo/user/track" class="btn btn-outline btn-sm">&larr; Track Another</a>
    <button onclick="window.print()" class="btn btn-info btn-sm" id="btn-print">Print</button>
  </div>

  <div class="track-result">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:1.5rem;">
      <div class="track-number"><?= htmlspecialchars($shipment['tracking_number']) ?></div>
      <span class="badge <?= $badge ?>" style="font-size:0.85rem;padding:0.4rem 1rem;"><?= $statusLabel ?></span>
    </div>

    <div class="track-route">
      <div class="track-city">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="var(--primary-light)" stroke-width="2" style="margin-bottom:0.4rem;"><circle cx="12" cy="12" r="10"/><polyline points="8 12 12 8 16 12"/><line x1="12" y1="16" x2="12" y2="8"/></svg>
        <strong><?= htmlspecialchars($shipment['from_city']) ?></strong>
        <span>Sender</span>
      </div>
      <div class="track-arrow">&rarr;</div>
      <div class="track-city">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="var(--accent)" stroke-width="2" style="margin-bottom:0.4rem;"><circle cx="12" cy="12" r="10"/><polyline points="8 12 12 16 16 12"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
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
