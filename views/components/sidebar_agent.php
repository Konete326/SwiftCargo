<?php
use app\Helpers\Session;
$currentUri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$userName    = Session::get('user_name', 'Agent');
$userInitial = strtoupper(substr($userName, 0, 1));

if (!function_exists('isActiveAgent')) {
    function isActiveAgent(string $path, string $current): string {
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

  <div class="sidebar-role-badge">Agent Panel</div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Overview</div>
    <a href="/SwiftCargo/agent/dashboard" class="nav-item <?= isActiveAgent('dashboard', $currentUri) ?>">
      <span class="nav-icon">ðŸ“Š</span> Dashboard
    </a>

    <div class="nav-section-label">Shipments</div>
    <a href="/SwiftCargo/agent/shipments" class="nav-item <?= isActiveAgent('shipments', $currentUri) ?>">
      <span class="nav-icon">ðŸ“¦</span> Branch Shipments
    </a>
    <a href="/SwiftCargo/agent/shipments/create" class="nav-item">
      <span class="nav-icon">âž•</span> New Shipment
    </a>

    <div class="nav-section-label">Reports</div>
    <a href="/SwiftCargo/agent/reports" class="nav-item <?= isActiveAgent('reports', $currentUri) ?>">
      <span class="nav-icon">ðŸ“ˆ</span> Branch Reports
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="user-card">
      <div class="user-avatar"><?= $userInitial ?></div>
      <div class="user-info">
        <strong><?= htmlspecialchars($userName) ?></strong>
        <span>Branch Agent</span>
      </div>
    </div>
  </div>
</aside>

