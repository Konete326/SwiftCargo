<?php $pageTitle = 'Track Shipment | SwiftCargo'; ?>

<div style="max-width:520px;margin:3rem auto;">
  <div style="text-align:center;margin-bottom:2rem;">
    <div style="font-size:2.5rem;margin-bottom:0.75rem;">ðŸ“¦</div>
    <h2 style="font-size:1.4rem;font-weight:800;">Track Your Shipment</h2>
    <p style="color:var(--text-muted);margin-top:0.4rem;">Enter your consignment tracking number below</p>
  </div>

  <div class="form-card" style="max-width:100%;">
    <form method="POST" action="/SwiftCargo/user/track" id="track-form">
      <div class="form-group">
        <label class="form-label" for="tracking_number">Tracking Number</label>
        <input type="text" name="tracking_number" id="tracking_number" class="form-control"
               placeholder="e.g. SC001KHI2024" style="font-family:monospace;font-size:1rem;text-transform:uppercase;" required>
      </div>
      <button type="submit" class="btn btn-primary btn-full btn-lg" id="btn-track">ðŸ” Track Shipment</button>
    </form>
  </div>
</div>

