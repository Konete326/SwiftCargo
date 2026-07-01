<?php
$pageTitle    = 'Agents | SwiftCargo';
$pageSubtitle = 'Manage branch agents';
?>

<div class="page-header">
  <div>
    <h2>Agents</h2>
    <p>Total: <?= count($agents) ?> agents</p>
  </div>
  <a href="/SwiftCargo/public/admin/agents/create" class="btn btn-primary" id="btn-new-agent">➕ Add Agent</a>
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
          <th>City</th>
          <th>Joined</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($agents)): ?>
          <tr><td colspan="7"><div class="empty-state"><div class="icon">👤</div><p>No agents found</p></div></td></tr>
        <?php else: ?>
          <?php foreach ($agents as $i => $a): ?>
          <tr>
            <td style="color:var(--text-dim);"><?= $i + 1 ?></td>
            <td>
              <div style="display:flex;align-items:center;gap:0.6rem;">
                <div style="width:32px;height:32px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:0.85rem;flex-shrink:0;">
                  <?= strtoupper(substr($a['name'], 0, 1)) ?>
                </div>
                <span style="font-weight:600;"><?= htmlspecialchars($a['name']) ?></span>
              </div>
            </td>
            <td style="color:var(--text-muted);font-size:0.85rem;"><?= htmlspecialchars($a['email']) ?></td>
            <td style="font-size:0.85rem;"><?= htmlspecialchars($a['phone']) ?></td>
            <td><span class="badge badge-info"><?= htmlspecialchars($a['city_name']) ?></span></td>
            <td style="color:var(--text-muted);font-size:0.78rem;"><?= date('M d, Y', strtotime($a['created_at'])) ?></td>
            <td>
              <div class="d-flex gap-1">
                <a href="/SwiftCargo/public/admin/agents/edit/<?= $a['id'] ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                <a href="/SwiftCargo/public/admin/agents/delete/<?= $a['id'] ?>" class="btn btn-danger btn-sm" id="del-agent-<?= $a['id'] ?>" onclick="return confirm('Delete this agent?')">🗑</a>
              </div>
            </td>
          </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
