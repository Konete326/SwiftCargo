<?php
$pageTitle    = 'Reports | SwiftCargo';
$pageSubtitle = 'Download shipment reports';
?>

<div class="page-header">
  <div><h2>Reports</h2><p>Download CSV reports by date or city</p></div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;">

  <div class="form-card">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem;color:var(--primary-light);">ðŸ“… Date-Wise Report</h3>
    <form method="POST" action="/SwiftCargo/admin/reports/download" id="report-date-form">
      <input type="hidden" name="type" value="date">
      <div class="form-group">
        <label class="form-label" for="from">From Date</label>
        <input type="date" name="from" id="from" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="to">To Date</label>
        <input type="date" name="to" id="to" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary btn-full" id="btn-download-date">â¬‡ Download CSV</button>
    </form>
  </div>

  <div class="form-card">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem;color:var(--accent);">ðŸ™ City-Wise Report</h3>
    <form method="POST" action="/SwiftCargo/admin/reports/download" id="report-city-form">
      <input type="hidden" name="type" value="city">
      <div class="form-group">
        <label class="form-label" for="city_id">Select City</label>
        <select name="city_id" id="city_id" class="form-control" required>
          <option value="">Choose city...</option>
          <?php foreach ($cities as $city): ?>
            <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div style="margin-top:1.3rem;">
        <button type="submit" class="btn btn-success btn-full" id="btn-download-city">â¬‡ Download CSV</button>
      </div>
    </form>
  </div>

</div>

