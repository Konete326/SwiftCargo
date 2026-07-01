<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'SwiftCargo' ?></title>
  <link rel="stylesheet" href="/SwiftCargo/public/assets/css/app.css">
</head>
<body>
  <header style="background:var(--bg-surface);border-bottom:1px solid var(--border);padding:0 1.75rem;height:var(--header-h);display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;">
    <div style="display:flex;align-items:center;gap:0.65rem;">
      <div style="width:36px;height:36px;background:linear-gradient(135deg,var(--primary),var(--accent));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;padding:3px;"><img src="/SwiftCargo/public/assets/images/logo.png" alt="Logo" style="width:100%;height:100%;object-fit:contain;border-radius:inherit;"></div>
      <span style="font-weight:700;font-size:1rem;color:var(--text-base);">SwiftCargo</span>
    </div>
    <div style="display:flex;align-items:center;gap:0.75rem;">
      <span style="font-size:0.85rem;color:var(--text-muted);">Hello, <?= htmlspecialchars(\app\Helpers\Session::get('user_name', 'User')) ?></span>
      <a href="/SwiftCargo/public/logout" class="topbar-logout">⏏ Logout</a>
    </div>
  </header>

  <main style="max-width:960px;margin:2rem auto;padding:0 1.5rem;">
    <?php require_once dirname(__DIR__) . '/components/flash.php'; ?>
    <?= $content ?? '' ?>
  </main>
  <script src="/SwiftCargo/public/assets/js/app.js"></script>
</body>
</html>
