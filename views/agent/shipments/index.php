<?php
$pageTitle    = 'Branch Shipments | SwiftCargo';
$pageSubtitle = 'Your assigned branch shipments';
$badgeMap = ['booked'=>'badge-warning','in_transit'=>'badge-info','out_for_delivery'=>'badge-primary','delivered'=>'badge-success','cancelled'=>'badge-danger'];
?>

<div class="page-header">
  <div><h2>Branch Shipments</h2><p>Total: <?= count($shipments) ?></p></div>
  <a href="/SwiftCargo/public/agent/shipments/create" class="btn btn-primary" id="btn-agent-new">➕ New Shipment</a>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr><th>Tracking No</th><th>Sender</th><th>Receiver</th><th>Route</th><th>Type</th><th>Amount</th><th>Status</th><th>Action</th></tr>
      </thead>
      <tbody>
        <?php if (empty($shipments)): ?>
          <tr><td colspan="8"><div class="empty-state"><div class="icon">📭</div><p>No shipments for your branch</p></div></td></tr>
        <?php else: ?>
          <?php foreach ($shipments as $s): ?>
          <tr>
            <td><span style="font-family:monospace;font-weight:600;color:var(--primary-light);font-size:0.8rem;"><?= htmlspecialchars($s['tracking_number']) ?></span></td>
            <td><div style="font-weight:600;"><?= htmlspecialchars($s['sender_name']) ?></div><div style="font-size:0.75rem;color:var(--text-muted);"><?= htmlspecialchars($s['sender_phone']) ?></div></td>
            <td><div style="font-weight:600;"><?= htmlspecialchars($s['receiver_name']) ?></div><div style="font-size:0.75rem;color:var(--text-muted);"><?= htmlspecialchars($s['receiver_phone']) ?></div></td>
            <td style="font-size:0.82rem;"><?= htmlspecialchars($s['from_city']) ?> → <?= htmlspecialchars($s['to_city']) ?></td>
            <td style="font-size:0.82rem;"><?= ucfirst($s['courier_type']) ?></td>
            <td style="font-weight:600;">Rs. <?= number_format($s['amount'], 0) ?></td>
            <td><span class="badge <?= $badgeMap[$s['status']] ?? 'badge-secondary' ?>"><?= str_replace('_', ' ', $s['status']) ?></span></td>
            <td><a href="/SwiftCargo/public/agent/shipments/edit/<?= $s['id'] ?>" class="btn btn-warning btn-sm">✏ Update</a></td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
