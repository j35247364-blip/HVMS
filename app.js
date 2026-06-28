// Coral Cove HVMS — small interactive helpers

// Confirm before deleting a visitor record
document.addEventListener('click', function (e) {
  const el = e.target.closest('.confirm-delete');
  if (el) {
    const ok = confirm('Remove this visitor record? This cannot be undone.');
    if (!ok) e.preventDefault();
  }
});

// Live filter on the visitors table (client-side, instant feel)
function liveFilterTable() {
  const input = document.getElementById('liveSearch');
  const table = document.getElementById('visitorsTable');
  if (!input || !table) return;

  input.addEventListener('input', function () {
    const term = this.value.trim().toLowerCase();
    table.querySelectorAll('tbody tr').forEach(function (row) {
      const text = row.innerText.toLowerCase();
      row.style.display = text.includes(term) ? '' : 'none';
    });
  });
}
document.addEventListener('DOMContentLoaded', liveFilterTable);

// Auto-fill check-in time field with "now" when registering (visual nicety)
document.addEventListener('DOMContentLoaded', function () {
  const clockEls = document.querySelectorAll('.live-clock');
  if (!clockEls.length) return;
  function tick() {
    const now = new Date();
    const str = now.toLocaleString([], { weekday: 'short', hour: '2-digit', minute: '2-digit' });
    clockEls.forEach(el => el.textContent = str);
  }
  tick();
  setInterval(tick, 30000);
});

// Reveal-on-scroll for the public booking page (plain JS, no library)
document.addEventListener('DOMContentLoaded', function () {
  const targets = document.querySelectorAll('.reveal');
  if (!targets.length) return;

  if (!('IntersectionObserver' in window)) {
    targets.forEach(el => el.classList.add('is-visible'));
    return;
  }

  const observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });

  targets.forEach(el => observer.observe(el));
});

// Booking form: keep check-out date always after check-in date
document.addEventListener('DOMContentLoaded', function () {
  const checkIn = document.getElementById('check_in_date');
  const checkOut = document.getElementById('check_out_date');
  if (!checkIn || !checkOut) return;

  checkIn.addEventListener('change', function () {
    checkOut.min = this.value;
    if (checkOut.value && checkOut.value <= this.value) {
      const nextDay = new Date(this.value);
      nextDay.setDate(nextDay.getDate() + 1);
      checkOut.value = nextDay.toISOString().split('T')[0];
    }
  });
});
