<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'SwiftCargo' ?></title>
  <link rel="stylesheet" href="/SwiftCargo/assets/css/app.css">
</head>
<body class="auth-split-page">

  <div class="auth-split-wrap">

    <div class="auth-split-left">
      <div class="auth-brand">
        <div class="auth-brand-logo">
          <img src="/SwiftCargo/assets/images/logo.png" alt="SwiftCargo Logo">
        </div>
        <h1>SwiftCargo</h1>
        <p>Courier Management System</p>
        <ul class="auth-features">
          <li><span class="feat-icon">📦</span> Track shipments in real-time</li>
          <li><span class="feat-icon">🏙️</span> City-wise branch management</li>
          <li><span class="feat-icon">📊</span> Download shipment reports</li>
          <li><span class="feat-icon">🔒</span> Role-based secure access</li>
        </ul>
      </div>
      <div class="auth-left-glow"></div>
    </div>

    <div class="auth-split-right">
      <div class="auth-form-box">
        <?php require_once dirname(__DIR__) . '/components/flash.php'; ?>
        <?= $content ?? '' ?>
      </div>
    </div>

  </div>

</body>
</html>

