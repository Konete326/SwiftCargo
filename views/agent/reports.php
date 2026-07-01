<?php
$pageTitle    = 'Branch Reports | SwiftCargo';
$pageSubtitle = 'Download branch shipment reports';
?>

<div class="page-header">
  <div><h2>Branch Reports</h2><p>Download date-wise CSV reports for your branch</p></div>
</div>

<div style="max-width:520px;margin:0 auto;">
  <div class="form-card">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem;color:var(--primary-light);">ðŸ“… Date-Wise Branch Report</h3>
    <form method="POST" action="/SwiftCargo/agent/reports/download" id="branch-report-form">
      <div class="form-group">
        <label class="form-label" for="from">From Date</label>
        <input type="date" name="from" id="from" class="form-control" required>
      </div>
      <div class="form-group">
        <label class="form-label" for="to">To Date</label>
        <input type="date" name="to" id="to" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary btn-full" id="btn-download-branch">â¬‡ Download Branch CSV</button>
    </form>
  </div>
</div>

