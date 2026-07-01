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
      <span class="nav-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
      </span> Dashboard
    </a>

    <div class="nav-section-label">Shipments</div>
    <a href="/SwiftCargo/agent/shipments" class="nav-item <?= isActiveAgent('shipments', $currentUri) ?>">
      <span class="nav-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
      </span> Branch Shipments
    </a>
    <a href="/SwiftCargo/agent/shipments/create" class="nav-item">
      <span class="nav-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
      </span> New Shipment
    </a>

    <div class="nav-section-label">Reports</div>
    <a href="/SwiftCargo/agent/reports" class="nav-item <?= isActiveAgent('reports', $currentUri) ?>">
      <span class="nav-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
      </span> Branch Reports
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
