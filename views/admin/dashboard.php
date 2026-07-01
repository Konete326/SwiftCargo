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
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
    </div>
    <div class="stat-info"><h3><?= $total ?></h3><p>Total Shipments</p></div>
  </div>
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

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;">
  <div class="stat-card cyan">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
    </div>
    <div class="stat-info"><h3><?= $totalAgents ?></h3><p>Total Agents</p></div>
  </div>
  <div class="stat-card purple">
    <div class="stat-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
    </div>
    <div class="stat-info"><h3><?= $totalCustomers ?></h3><p>Registered Customers</p></div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3>Recent Shipments</h3>
    <a href="/SwiftCargo/admin/shipments" class="btn btn-outline btn-sm">View All</a>
  </div>
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Tracking No</th>
          <th>Sender</th>
          <th>From &rarr; To</th>
          <th>Type</th>
          <th>Status</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($recentShipments)): ?>
          <tr><td colspan="6"><div class="empty-state"><p>No shipments yet</p></div></td></tr>
        <?php else: ?>
          <?php foreach ($recentShipments as $s): ?>
          <tr>
            <td><span style="font-family:monospace;font-weight:600;color:var(--primary-light);"><?= htmlspecialchars($s['tracking_number']) ?></span></td>
            <td><?= htmlspecialchars($s['sender_name']) ?></td>
            <td><?= htmlspecialchars($s['from_city']) ?> &rarr; <?= htmlspecialchars($s['to_city']) ?></td>
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
