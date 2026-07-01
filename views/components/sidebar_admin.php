<?php
use app\Helpers\Session;
$currentUri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$userName    = Session::get('user_name', 'Admin');
$userInitial = strtoupper(substr($userName, 0, 1));

if (!function_exists('isActive')) {
    function isActive(string $path, string $current): string {
        return str_contains($current, $path) ? 'active' : '';
    }
}
?>
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="logo-wrap">
      <div class="logo-icon"><img src="/SwiftCargo/assets/images/logo.png" alt="Logo" style="width:100%;height:100%;object-fit:contain;border-radius:inherit;"></div>
      <div>
        <h2>SwiftCargo</h2>
        <span>Management System</span>
      </div>
    </div>
  </div>

  <div class="sidebar-role-badge">Admin Panel</div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Overview</div>
    <a href="/SwiftCargo/admin/dashboard" class="nav-item <?= isActive('dashboard', $currentUri) ?>">
      <span class="nav-icon">ðŸ“Š</span> Dashboard
    </a>

    <div class="nav-section-label">Shipments</div>
    <a href="/SwiftCargo/admin/shipments" class="nav-item <?= isActive('shipments', $currentUri) ?>">
      <span class="nav-icon">ðŸ“¦</span> All Shipments
    </a>
    <a href="/SwiftCargo/admin/shipments/create" class="nav-item">
      <span class="nav-icon">âž•</span> New Shipment
    </a>

    <div class="nav-section-label">Management</div>
    <a href="/SwiftCargo/admin/agents" class="nav-item <?= isActive('agents', $currentUri) ?>">
      <span class="nav-icon">ðŸ‘¤</span> Agents
    </a>
    <a href="/SwiftCargo/admin/customers" class="nav-item <?= isActive('customers', $currentUri) ?>">
      <span class="nav-icon">ðŸ‘¥</span> Customers
    </a>
    <a href="/SwiftCargo/admin/reports" class="nav-item <?= isActive('reports', $currentUri) ?>">
      <span class="nav-icon">ðŸ“ˆ</span> Reports
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-card">
      <div class="user-avatar"><?= $userInitial ?></div>
      <div class="user-info">
        <strong><?= htmlspecialchars($userName) ?></strong>
        <span>Administrator</span>
      </div>
    </div>
  </div>
</aside>

