<?php
$pageTitle    = 'Customers | SwiftCargo';
$pageSubtitle = 'Registered customer accounts';
?>

<div class="page-header">
  <div>
    <h2>Customers</h2>
    <p>Total: <?= count($customers) ?> registered</p>
  </div>
</div>

<div class="card" style="margin-bottom:1.25rem;">
  <div class="card-body">
    <form method="GET" action="/SwiftCargo/admin/customers" id="search-form" style="display:flex;gap:0.75rem;">
      <input type="text" name="q" class="form-control" placeholder="Search by name, email or phone..." value="<?= htmlspecialchars($query) ?>" style="flex:1;">
      <button type="submit" class="btn btn-primary" id="btn-search">ðŸ” Search</button>
      <?php if ($query): ?>
        <a href="/SwiftCargo/admin/customers" class="btn btn-outline">âœ• Clear</a>
      <?php endif; ?>
    </form>
  </div>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Joined</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($customers)): ?>
          <tr><td colspan="5"><div class="empty-state"><div class="icon">ðŸ‘¥</div><p><?= $query ? 'No results for "' . htmlspecialchars($query) . '"' : 'No customers yet' ?></p></div></td></tr>
        <?php else: ?>
          <?php foreach ($customers as $i => $c): ?>
          <tr>
            <td style="color:var(--text-dim);"><?= $i + 1 ?></td>
            <td>
              <div style="display:flex;align-items:center;gap:0.6rem;">
                <div style="width:32px;height:32px;background:linear-gradient(135deg,var(--success),var(--accent));border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;flex-shrink:0;">
                  <?= strtoupper(substr($c['name'], 0, 1)) ?>
                </div>
                <span style="font-weight:600;"><?= htmlspecialchars($c['name']) ?></span>
              </div>
            </td>
            <td style="color:var(--text-muted);font-size:0.85rem;"><?= htmlspecialchars($c['email']) ?></td>
            <td style="font-size:0.85rem;"><?= htmlspecialchars($c['phone']) ?></td>
            <td style="color:var(--text-muted);font-size:0.78rem;"><?= date('M d, Y', strtotime($c['created_at'])) ?></td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

