<?php
$pageTitle    = 'Agent Dashboard | SwiftCargo';
$pageSubtitle = 'Branch shipment overview';

$booked    = $counts['booked']            ?? 0;
$transit   = $counts['in_transit']        ?? 0;
$outDel    = $counts['out_for_delivery']  ?? 0;
$delivered = $counts['delivered']         ?? 0;
$cancelled = $counts['cancelled']         ?? 0;
?>

<div class="stats-grid">
  <div class="stat-card amber">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
    </div>
    <div class="stat-info"><h3><?= $booked ?></h3><p>Booked</p></div>
  </div>
  <div class="stat-card cyan">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
    </div>
    <div class="stat-info"><h3><?= $transit ?></h3><p>In Transit</p></div>
  </div>
  <div class="stat-card blue">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="8 12 12 16 16 12"/><line x1="12" y1="8" x2="12" y2="16"/></svg>
    </div>
    <div class="stat-info"><h3><?= $outDel ?></h3><p>Out for Delivery</p></div>
  </div>
  <div class="stat-card green">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    </div>
    <div class="stat-info"><h3><?= $delivered ?></h3><p>Delivered</p></div>
  </div>
  <div class="stat-card red">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </div>
    <div class="stat-info"><h3><?= $cancelled ?></h3><p>Cancelled</p></div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3>Recent Branch Shipments</h3>
    <a href="/SwiftCargo/agent/shipments" class="btn btn-outline btn-sm">View All</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Tracking No</th><th>Sender</th><th>Receiver</th><th>Route</th><th>Status</th></tr>
      </thead>
      <tbody>
        <?php if (empty($recentShipments)): ?>
          <tr><td colspan="5"><div class="empty-state"><p>No shipments yet</p></div></td></tr>
        <?php else: ?>
          <?php
          $badgeMap = ['booked'=>'badge-warning','in_transit'=>'badge-info','out_for_delivery'=>'badge-primary','delivered'=>'badge-success','cancelled'=>'badge-danger'];
          foreach ($recentShipments as $s): ?>
          <tr>
            <td><span style="font-family:monospace;font-weight:600;color:var(--primary-light);font-size:0.8rem;"><?= htmlspecialchars($s['tracking_number']) ?></span></td>
            <td><?= htmlspecialchars($s['sender_name']) ?></td>
            <td><?= htmlspecialchars($s['receiver_name']) ?></td>
            <td style="font-size:0.82rem;"><?= htmlspecialchars($s['from_city']) ?> &rarr; <?= htmlspecialchars($s['to_city']) ?></td>
            <td><span class="badge <?= $badgeMap[$s['status']] ?? 'badge-secondary' ?>"><?= str_replace('_', ' ', $s['status']) ?></span></td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
