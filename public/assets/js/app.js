(function () {
  function createModal(message, onConfirm) {
    var overlay = document.createElement('div');
    overlay.id = 'sc-modal-overlay';
    overlay.style.cssText = [
      'position:fixed','inset:0','background:rgba(0,0,0,0.65)',
      'display:flex','align-items:center','justify-content:center',
      'z-index:9999','backdrop-filter:blur(4px)'
    ].join(';');

    var box = document.createElement('div');
    box.style.cssText = [
      'background:#1a1a35','border:1px solid rgba(255,255,255,0.1)',
      'border-radius:16px','padding:2rem','max-width:400px','width:90%',
      'box-shadow:0 25px 60px rgba(0,0,0,0.6)','text-align:center',
      'font-family:Inter,sans-serif','animation:scFadeIn 0.18s ease'
    ].join(';');

    var style = document.createElement('style');
    style.textContent = '@keyframes scFadeIn{from{opacity:0;transform:scale(0.9)}to{opacity:1;transform:scale(1)}}';
    document.head.appendChild(style);

    var icon = document.createElement('div');
    icon.textContent = '⚠️';
    icon.style.cssText = 'font-size:2.2rem;margin-bottom:0.75rem;';

    var title = document.createElement('h3');
    title.textContent = 'Confirm Action';
    title.style.cssText = 'color:#e2e8f0;font-size:1.1rem;margin-bottom:0.5rem;';

    var msg = document.createElement('p');
    msg.textContent = message;
    msg.style.cssText = 'color:#94a3b8;font-size:0.875rem;margin-bottom:1.5rem;';

    var btnWrap = document.createElement('div');
    btnWrap.style.cssText = 'display:flex;gap:0.75rem;justify-content:center;';

    var btnCancel = document.createElement('button');
    btnCancel.textContent = 'Cancel';
    btnCancel.style.cssText = [
      'padding:0.6rem 1.25rem','border:1px solid rgba(255,255,255,0.1)',
      'border-radius:8px','background:transparent','color:#94a3b8',
      'font-size:0.875rem','font-weight:600','cursor:pointer',
      'font-family:Inter,sans-serif','transition:all 0.2s'
    ].join(';');

    var btnConfirm = document.createElement('button');
    btnConfirm.textContent = 'Yes, Delete';
    btnConfirm.style.cssText = [
      'padding:0.6rem 1.25rem','border:none',
      'border-radius:8px','background:#ef4444','color:#fff',
      'font-size:0.875rem','font-weight:600','cursor:pointer',
      'font-family:Inter,sans-serif','transition:all 0.2s'
    ].join(';');

    btnCancel.onmouseenter = function () { this.style.background = 'rgba(255,255,255,0.05)'; };
    btnCancel.onmouseleave = function () { this.style.background = 'transparent'; };
    btnConfirm.onmouseenter = function () { this.style.background = '#dc2626'; };
    btnConfirm.onmouseleave = function () { this.style.background = '#ef4444'; };

    btnCancel.onclick = function () { document.body.removeChild(overlay); };
    btnConfirm.onclick = function () { document.body.removeChild(overlay); onConfirm(); };

    btnWrap.appendChild(btnCancel);
    btnWrap.appendChild(btnConfirm);
    box.appendChild(icon);
    box.appendChild(title);
    box.appendChild(msg);
    box.appendChild(btnWrap);
    overlay.appendChild(box);

    overlay.onclick = function (e) { if (e.target === overlay) document.body.removeChild(overlay); };
    document.body.appendChild(overlay);
  }

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[data-confirm]').forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        var href = this.href;
        var msg  = this.getAttribute('data-confirm') || 'Are you sure?';
        createModal(msg, function () { window.location.href = href; });
      });
    });

    var trackInput = document.getElementById('tracking_number');
    if (trackInput) {
      trackInput.addEventListener('input', function () {
        this.value = this.value.toUpperCase();
      });
    }
  });
})();
