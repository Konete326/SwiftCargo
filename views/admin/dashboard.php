<?php
$pageTitle    = 'Dashboard | SwiftCargo';
$pageSubtitle = 'System overview & quick stats';

$booked    = $counts['booked']            ?? 0;
$transit   = $counts['in_transit']        ?? 0;
$outDel    = $counts['out_for_delivery']  ?? 0;
$delivered = $counts['delivered']         ?? 0;
$cancelled = $counts['cancelled']         ?? 0;
$total     = $booked + $transit + $outDel + $delivered + $cancelled;
?>

<div class="stats-grid">
  <div class="stat-card purple">
    <div class="stat-icon">ðŸ“¦</div>
    <div class="stat-info"><h3><?= $total ?></h3><p>Total Shipments</p></div>
  </div>
  <div class="stat-card amber">
    <div class="stat-icon">ðŸ•</div>
    <div class="stat-info"><h3><?= $booked ?></h3><p>Booked</p></div>
  </div>
  <div class="stat-card cyan">
    <div class="stat-icon">ðŸšš</div>
    <div class="stat-info"><h3><?= $transit ?></h3><p>In Transit</p></div>
  </div>
  <div class="stat-card blue">
    <div class="stat-icon">ðŸ›µ</div>
    <div class="stat-info"><h3><?= $outDel ?></h3><p>Out for Delivery</p></div>
  </div>
  <div class="stat-card green">
    <div class="stat-icon">âœ…</div>
    <div class="stat-info"><h3><?= $delivered ?></h3><p>Delivered</p></div>
  </div>
  <div class="stat-card red">
    <div class="stat-icon">âŒ</div>
    <div class="stat-info"><h3><?= $cancelled ?></h3><p>Cancelled</p></div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;">
  <div class="stat-card cyan">
    <div class="stat-icon">ðŸ‘¤</div>
    <div class="stat-info"><h3><?= $totalAgents ?></h3><p>Total Agents</p></div>
  </div>
  <div class="stat-card purple">
    <div class="stat-icon">ðŸ‘¥</div>
    <div class="stat-info"><h3><?= $totalCustomers ?></h3><p>Registered Customers</p></div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3>ðŸ“‹ Recent Shipments</h3>
    <a href="/SwiftCargo/admin/shipments" class="btn btn-outline btn-sm">View All</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Tracking No</th>
          <th>Sender</th>
          <th>From â†’ To</th>
          <th>Type</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recentShipments)): ?>
          <tr><td colspan="6"><div class="empty-state"><div class="icon">ðŸ“­</div><p>No shipments yet</p></div></td></tr>
        <?php else: ?>
          <?php foreach ($recentShipments as $s): ?>
          <tr>
            <td><span style="font-family:monospace;font-weight:600;color:var(--primary-light);"><?= htmlspecialchars($s['tracking_number']) ?></span></td>
            <td><?= htmlspecialchars($s['sender_name']) ?></td>
            <td><?= htmlspecialchars($s['from_city']) ?> â†’ <?= htmlspecialchars($s['to_city']) ?></td>
            <td><?= htmlspecialchars(ucfirst($s['courier_type'])) ?></td>
            <td><?php
              $badgeMap = ['booked'=>'badge-warning','in_transit'=>'badge-info','out_for_delivery'=>'badge-primary','delivered'=>'badge-success','cancelled'=>'badge-danger'];
              $badge = $badgeMap[$s['status']] ?? 'badge-secondary';
            ?>
              <span class="badge <?= $badge ?>"><?= htmlspecialchars(str_replace('_', ' ', $s['status'])) ?></span>
            </td>
            <td style="color:var(--text-muted);font-size:0.8rem;"><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

