<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?? 'SwiftCargo' ?></title>
  <link rel="stylesheet" href="/SwiftCargo/public/assets/css/app.css">
</head>
<body class="auth-page">
  <div class="auth-card">
    <div class="auth-logo">
      <div class="logo-icon">🚀</div>
      <h1>SwiftCargo</h1>
      <p>Courier Management System</p>
    </div>
    <?php require_once dirname(__DIR__) . '/components/flash.php'; ?>
    <?= $content ?? '' ?>
  </div>
</body>
</html>
