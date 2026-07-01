<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'SwiftCargo' ?></title>
  <meta name="description" content="SwiftCargo - Professional Courier Management System">
  <link rel="stylesheet" href="/SwiftCargo/public/assets/css/app.css">
</head>
<body class="panel-layout">

  <?php require_once dirname(__DIR__) . '/components/sidebar_admin.php'; ?>

  <div class="main-content">
    <header class="topbar">
      <div class="topbar-title">
        <h2><?= $pageTitle ?? 'Dashboard' ?></h2>
        <p><?= $pageSubtitle ?? 'Welcome back, ' . htmlspecialchars(\app\Helpers\Session::get('user_name', 'Admin')) ?></p>
      </div>
      <div class="topbar-actions">
        <a href="/SwiftCargo/public/logout" class="topbar-logout">⏏ Logout</a>
      </div>
    </header>

    <main class="page-body">
      <?php require_once dirname(__DIR__) . '/components/flash.php'; ?>
      <?= $content ?? '' ?>
    </main>
  </div>

  <script src="/SwiftCargo/public/assets/js/app.js"></script>
</body>
</html>
