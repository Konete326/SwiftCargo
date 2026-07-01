<?php
$pageTitle    = 'All Shipments | SwiftCargo';
$pageSubtitle = 'Manage all courier shipments';

$badgeMap = [
    'booked'           => 'badge-warning',
    'in_transit'       => 'badge-info',
    'out_for_delivery' => 'badge-primary',
    'delivered'        => 'badge-success',
    'cancelled'        => 'badge-danger',
];
?>

<div class="page-header">
  <div>
    <h2>All Shipments</h2>
    <p>Total: <?= count($shipments) ?> records</p>
  </div>
  <a href="/SwiftCargo/admin/shipments/create" class="btn btn-primary" id="btn-new-shipment">+ New Shipment</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Tracking No</th>
          <th>Sender</th>
          <th>Receiver</th>
          <th>Route</th>
          <th>Type</th>
          <th>Amount</th>
          <th>Status</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($shipments)): ?>
          <tr><td colspan="9"><div class="empty-state"><p>No shipments found</p></div></td></tr>
        <?php else: ?>
          <?php foreach ($shipments as $s): ?>
          <tr>
            <td><span style="font-family:monospace;font-size:0.8rem;font-weight:700;color:var(--primary-light);"><?= htmlspecialchars($s['tracking_number']) ?></span></td>
            <td>
              <div style="font-weight:600;"><?= htmlspecialchars($s['sender_name']) ?></div>
              <div style="font-size:0.75rem;color:var(--text-muted);"><?= htmlspecialchars($s['sender_phone']) ?></div>
            </td>
            <td>
              <div style="font-weight:600;"><?= htmlspecialchars($s['receiver_name']) ?></div>
              <div style="font-size:0.75rem;color:var(--text-muted);"><?= htmlspecialchars($s['receiver_phone']) ?></div>
            </td>
            <td style="font-size:0.82rem;"><?= htmlspecialchars($s['from_city']) ?> → <?= htmlspecialchars($s['to_city']) ?></td>
            <td><span style="font-size:0.8rem;"><?= htmlspecialchars(ucfirst($s['courier_type'])) ?></span></td>
            <td style="font-weight:600;">Rs. <?= number_format($s['amount'], 0) ?></td>
            <td><span class="badge <?= $badgeMap[$s['status']] ?? 'badge-secondary' ?>"><?= str_replace('_', ' ', $s['status']) ?></span></td>
            <td style="color:var(--text-muted);font-size:0.78rem;"><?= date('M d, Y', strtotime($s['created_at'])) ?></td>
            <td>
              <div class="d-flex gap-1">
                <a href="/SwiftCargo/admin/shipments/edit/<?= $s['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/SwiftCargo/admin/shipments/delete/<?= $s['id'] ?>" class="btn btn-danger btn-sm" id="delete-<?= $s['id'] ?>" data-confirm="Delete this shipment? This cannot be undone.">Delete</a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

