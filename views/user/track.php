<?php $pageTitle = 'Track Shipment | SwiftCargo'; ?>

<div style="max-width:520px;margin:3rem auto;">
  <div style="text-align:center;margin-bottom:2rem;">
    <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;background:rgba(139,92,246,0.15);border-radius:16px;margin-bottom:1rem;">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="var(--primary-light)" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
    </div>
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
      <button type="submit" class="btn btn-primary btn-full btn-lg" id="btn-track">Search Shipment</button>
    </form>
  </div>
</div>
