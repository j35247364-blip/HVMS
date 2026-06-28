<?php
require_once __DIR__ . '/includes/config.php';
// Public page — no login required, by design, since guests must be able to book without an account.
$page_title = 'Book a Room · Coral Cove';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book a Room · Coral Cove Hotel, Negombo</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="booking-page">

<nav class="booking-nav">
  <div class="brand">
    <span class="brand-wave" style="color:var(--coral);">~</span>
    <div class="brand-text">
      <strong>Coral Cove</strong>
      <small>Ocean View Hotel · Negombo</small>
    </div>
  </div>
  <div class="booking-nav-links">
    <a href="index.php">Home</a>
    <a href="#rooms">Rooms</a>
    <a href="#amenities">Amenities</a>
    <a href="#book">Book Now</a>
    <a href="#contact">Contact</a>
  </div>
  <a href="login.php" class="btn btn-primary">Staff Login</a>
</nav>

<header class="booking-hero">
  <span class="drift d1"></span>
  <span class="drift d2"></span>
  <span class="drift d3"></span>
  <h1>Wake up to the ocean, every morning</h1>
  <p>Coral Cove sits right on Negombo's golden coastline — book your stay online and our front desk will take it from there.</p>
  <a href="#book" class="btn btn-primary">Check Availability</a>

  <div class="wave-divider">
    <svg viewBox="0 0 1440 90" preserveAspectRatio="none">
      <path d="M0,40 C240,90 480,10 720,45 C960,80 1200,10 1440,40 L1440,90 L0,90 Z" fill="#F6EFE3"/>
    </svg>
  </div>
</header>

<section class="booking-section" id="rooms">
  <span class="eyebrow" style="display:block; text-align:center;">Accommodation</span>
  <h2>Room Categories</h2>
  <p class="lead">Six room styles, from cosy garden-facing rooms to a private-pool villa — each designed for comfort by the coast.</p>

  <div class="room-grid">

    <div class="room-card reveal">
      <div class="room-art" style="background:linear-gradient(135deg,#15707A,#0B2B3C);">
        <svg viewBox="0 0 200 120"><circle cx="170" cy="25" r="14" fill="#F6EFE3" opacity="0.85"/><rect x="20" y="70" width="100" height="30" rx="4" fill="#F6EFE3"/><rect x="20" y="60" width="100" height="12" rx="3" fill="#FF6B52"/><rect x="135" y="55" width="45" height="45" rx="3" fill="#DCEFEA" opacity="0.5"/><path d="M0,110 Q50,95 100,110 T200,110 V120 H0 Z" fill="#0B2B3C" opacity="0.4"/></svg>
      </div>
      <div class="room-body">
        <h3>Seaview Deluxe King Room</h3>
        <div class="price">From LKR 22,000 / night</div>
        <p class="desc">A king bed and private balcony framing uninterrupted views of the Indian Ocean.</p>
      </div>
    </div>

    <div class="room-card reveal">
      <div class="room-art" style="background:linear-gradient(135deg,#2E9E6B,#0B2B3C);">
        <svg viewBox="0 0 200 120"><circle cx="170" cy="25" r="14" fill="#F6EFE3" opacity="0.85"/><rect x="20" y="70" width="100" height="30" rx="4" fill="#F6EFE3"/><rect x="20" y="60" width="100" height="12" rx="3" fill="#FF6B52"/><path d="M135,100 V60 q10,-15 22,0 V100 Z" fill="#DCEFEA" opacity="0.6"/><circle cx="157" cy="55" r="14" fill="#9FD8B5" opacity="0.7"/></svg>
      </div>
      <div class="room-body">
        <h3>Garden View Deluxe King Room</h3>
        <div class="price">From LKR 19,500 / night</div>
        <p class="desc">A quieter king room overlooking Coral Cove's tropical gardens — calm and shaded.</p>
      </div>
    </div>

    <div class="room-card reveal">
      <div class="room-art" style="background:linear-gradient(135deg,#1B6E9E,#0B2B3C);">
        <svg viewBox="0 0 200 120"><circle cx="170" cy="25" r="14" fill="#F6EFE3" opacity="0.85"/><rect x="20" y="70" width="100" height="30" rx="4" fill="#F6EFE3"/><rect x="20" y="60" width="100" height="12" rx="3" fill="#FF6B52"/><rect x="135" y="80" width="45" height="20" rx="10" fill="#9FD3E8"/><circle cx="145" cy="60" r="6" fill="#cfeaf5"/><circle cx="160" cy="55" r="8" fill="#cfeaf5"/><circle cx="172" cy="62" r="5" fill="#cfeaf5"/></svg>
      </div>
      <div class="room-body">
        <h3>Pool View Deluxe King Room</h3>
        <div class="price">From LKR 24,000 / night</div>
        <p class="desc">King room with a sunlit balcony directly above Coral Cove's main swimming pool.</p>
      </div>
    </div>

    <div class="room-card reveal">
      <div class="room-art" style="background:linear-gradient(135deg,#FF6B52,#0B2B3C);">
        <svg viewBox="0 0 200 120"><rect x="15" y="65" width="75" height="35" rx="4" fill="#F6EFE3"/><rect x="15" y="55" width="75" height="12" rx="3" fill="#15707A"/><rect x="100" y="75" width="85" height="25" rx="4" fill="#F6EFE3" opacity="0.85"/><circle cx="150" cy="55" r="16" fill="#F6EFE3" opacity="0.5"/></svg>
      </div>
      <div class="room-body">
        <h3>King Suite, One Bedroom</h3>
        <div class="price">From LKR 35,000 / night</div>
        <p class="desc">A separate living area plus bedroom — extra space for longer stays or families.</p>
      </div>
    </div>

    <div class="room-card reveal">
      <div class="room-art" style="background:linear-gradient(135deg,#0B2B3C,#15707A);">
        <svg viewBox="0 0 200 120"><rect x="15" y="60" width="60" height="40" rx="4" fill="#F6EFE3"/><rect x="15" y="50" width="60" height="12" rx="3" fill="#FF6B52"/><rect x="85" y="85" width="100" height="15" rx="7" fill="#9FD3E8"/><circle cx="100" cy="70" r="5" fill="#cfeaf5"/><circle cx="115" cy="65" r="7" fill="#cfeaf5"/><circle cx="130" cy="72" r="4" fill="#cfeaf5"/></svg>
      </div>
      <div class="room-body">
        <h3>One Bedroom Villa with Private Pool</h3>
        <div class="price">From LKR 58,000 / night</div>
        <p class="desc">A standalone villa with your own plunge pool, terrace, and complete privacy.</p>
      </div>
    </div>

    <div class="room-card reveal" style="display:flex; align-items:center; justify-content:center; background:var(--teal-light);">
      <div style="text-align:center; padding:30px;">
        <p style="font-family:var(--font-display); font-size:18px; color:var(--navy); margin:0 0 8px;">Not sure which room?</p>
        <p style="font-size:13px; color:var(--muted); margin:0 0 16px;">Our front desk is happy to help you choose the right fit.</p>
        <a href="#contact" class="btn btn-secondary">Contact Us</a>
      </div>
    </div>

  </div>
</section>

<section class="booking-section" id="amenities" style="background:var(--white);">
  <span class="eyebrow" style="display:block; text-align:center;">On-site</span>
  <h2>Amenities</h2>
  <p class="lead">Everything you need for a relaxed stay, all within the property.</p>

  <div class="amenities-grid">
    <div class="amenity-card reveal"><div class="a-ico">🍽</div><div class="a-label">Restaurant</div></div>
    <div class="amenity-card reveal"><div class="a-ico">🍹</div><div class="a-label">Bar</div></div>
    <div class="amenity-card reveal"><div class="a-ico">🏄</div><div class="a-label">Water Sports</div></div>
    <div class="amenity-card reveal"><div class="a-ico">❄</div><div class="a-label">Air Conditioning</div></div>
    <div class="amenity-card reveal"><div class="a-ico">🚗</div><div class="a-label">Parking</div></div>
    <div class="amenity-card reveal"><div class="a-ico">💆</div><div class="a-label">Spa</div></div>
    <div class="amenity-card reveal"><div class="a-ico">📶</div><div class="a-label">Free Wi-Fi</div></div>
    <div class="amenity-card reveal"><div class="a-ico">🏋</div><div class="a-label">Fitness Center</div></div>
    <div class="amenity-card reveal"><div class="a-ico">🚐</div><div class="a-label">Airport Shuttle</div></div>
    <div class="amenity-card reveal"><div class="a-ico">🛎</div><div class="a-label">Room Service</div></div>
    <div class="amenity-card reveal"><div class="a-ico">📺</div><div class="a-label">Flat Screen TV</div></div>
  </div>
</section>

<section class="booking-section" id="book">
  <span class="eyebrow" style="display:block; text-align:center;">Reserve</span>
  <h2>Book Your Stay</h2>
  <p class="lead">Submit a request below — our front desk will confirm your reservation shortly.</p>

  <div class="booking-form-wrap">

    <div class="hotel-info-card reveal" id="contact">
      <h3>Coral Cove Hotel</h3>
      <div class="info-row"><span class="info-ico">📍</span><span>No. 142, Lewis Place, Negombo 11500, Sri Lanka</span></div>
      <div class="info-row"><span class="info-ico">📞</span><span>+94 31 222 4567</span></div>
      <div class="info-row"><span class="info-ico">✉</span><span>reservations@coralcovehotel.lk</span></div>
      <div class="info-row"><span class="info-ico">🕐</span><span>Front desk &amp; check-in available 24 hours</span></div>
      <hr>
      <p style="font-size:12.5px; color:#9FB8C2; line-height:1.6; margin:0;">
        Once submitted, your booking request is reviewed by our front desk team and confirmed by phone or email.
        Bookings are not guaranteed until confirmed.
      </p>
    </div>

    <div class="booking-form-card reveal">
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">Thank you! Your booking request has been received — our front desk will confirm shortly.</div>
      <?php endif; ?>
      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-error">Please fill in all required fields correctly and try again.</div>
      <?php endif; ?>

      <form method="POST" action="process_booking.php">
        <div class="form-grid">
          <div class="form-group">
            <label>Full Name *</label>
            <input type="text" name="guest_name" required placeholder="e.g. Amara Silva">
          </div>
          <div class="form-group">
            <label>Phone Number *</label>
            <input type="text" name="phone" required placeholder="+94 7X XXX XXXX">
          </div>
          <div class="form-group">
            <label>Email Address *</label>
            <input type="email" name="email" required placeholder="you@example.com">
          </div>
          <div class="form-group">
            <label>Number of Guests *</label>
            <input type="number" name="guests" min="1" max="10" value="2" required>
          </div>
          <div class="form-group">
            <label>Check-in Date *</label>
            <input type="date" id="check_in_date" name="check_in_date" required min="<?= date('Y-m-d') ?>">
          </div>
          <div class="form-group">
            <label>Check-out Date *</label>
            <input type="date" id="check_out_date" name="check_out_date" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
          </div>
        </div>

        <div class="form-group">
          <label>Room Type *</label>
          <select name="room_type" required>
            <option value="">Select a room type</option>
            <option>Seaview Deluxe King Room</option>
            <option>Garden View Deluxe King Room</option>
            <option>Pool View Deluxe King Room</option>
            <option>King Suite, One Bedroom</option>
            <option>One Bedroom Villa with Private Pool</option>
          </select>
        </div>

        <div class="form-group">
          <label>Special Requests</label>
          <textarea name="special_requests" rows="3" placeholder="Late check-in, dietary needs, occasion, etc."></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width:100%;">Submit Booking Request</button>
      </form>
    </div>

  </div>
</section>

<footer style="background:var(--navy); color:#9FB8C2; text-align:center; padding:24px; font-size:12.5px;">
  © <?= date('Y') ?> Coral Cove Hotel · Negombo, Sri Lanka · Built for CS2001 Visitor Management System project
</footer>

<script src="assets/js/app.js"></script>
</body>
</html>
