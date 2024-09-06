@extends('front.layout.app')

@section('content')

<div class="tab-heading">
  <h2>Profile Settings</h2>
  <div class="tab-container">

    <!-- Sidebar Tabs -->
    <div class="tabs">
      <button class="tab-link active" onclick="openTab(event, 'eventTab')">⭐ Event</button>
      <button class="tab-link tab-link-custom" onclick="openTab(event, 'locationTab')">📍 Location</button>
      <button class="tab-link" onclick="openTab(event, 'paymentTab')">💵 Payment</button>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">
      <!-- Event Form -->
      <div id="eventTab" class="active">
        <div class="setting-tabs-container">
          <!-- Progress bar -->
          <div class="progress-bar-container">
            <div class="progress-bar" id="progressBar">0% Complete!</div>
          </div>

          <form class="form-container" id="form">
            <div class="general-settings">
              <h3>General Setting</h3>
              <div class="input-group">
                <label for="email">Contact Email:</label>
                <input type="email" id="email">
              </div>
              <div class="input-group">
                <label for="phone">Contact Phone:</label>
                <input type="tel" id="phone">
              </div>
            </div>

            <div class="event-setup">
              <h3>Event Setup</h3>
              <div class="input-group">
                <label for="eventName">Event Name:</label>
                <input type="text" id="eventName">
              </div>
              <div class="input-group">
                <label for="eventImage">Event Image:</label>
                <input type="file" id="eventImage">
              </div>
              <div class="input-group">
                <label for="eventBannerType">Event Banner Type:</label>
                <select id="eventBannerType">
                  <option value="static">Static Image</option>
                </select>
              </div>
              <div class="input-group">
                <label for="eventBanner">Event Banner:</label>
                <input type="file" id="eventBanner">
              </div>
              <div class="input-group">
                <label for="eventDate">Event Date:</label>
                <input type="date" id="eventDate">
              </div>
              <div class="input-group">
                <label for="eventDescription">Event Description:</label>
                <textarea id="eventDescription" rows="5"></textarea>
              </div>
            </div>

            <div class="profile-visibility">
              <h3>Profile Visibility Setup</h3>
              <div class="input-group">
                <label for="visibility">Profile Name Position:</label>
                <select id="visibility">
                  <option value="onBanner">On Banner</option>
                </select>
              </div>
            </div>

            <button type="submit">Save</button>
          </form>
        </div>

      </div>

      <!-- Location Tab (with Map) -->
      <div id="locationTab">
        <h3>Location Map</h3>
        <div class="map-search">
          <h4>Find Location</h4>
          <input type="text" id="find_address" name="geolocation[find_address]"
            class="wcfm-text wcfm_ele pac-target-input" value="" placeholder="Type an address to find"
            autocomplete="off" data-has-listeners="true">
        </div>
        <div class="map-container" id="map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3705913.5088881315!2d62.46719218750003!3d24.896065899999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33f30a80523ff%3A0xf18a3ecfe7cffbdd!2sNational%20Stadium%20Karachi!5e0!3m2!1sen!2sru!4v1725657099729!5m2!1sen!2sru"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>

      <!-- Payment Tab -->
      <div id="paymentTab">
        <h3>Payment Form</h3>
        <form class="payment-form">
          <label for="cardNumber">Card Number</label>
          <input type="text" id="cardNumber" placeholder="Enter your card number">

          <label for="expiryDate">Expiry Date</label>
          <input type="text" id="expiryDate" placeholder="MM/YY">

          <label for="cvv">CVV</label>
          <input type="text" id="cvv" placeholder="CVV">

          <label for="nameOnCard">Name on Card</label>
          <input type="text" id="nameOnCard" placeholder="Enter name on card">

          <button type="submit">Pay Now</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Mapbox GL JS -->
<script src='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css' rel='stylesheet' />

<script>
  // Tab navigation script
  function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.querySelectorAll(".tab-content > div");
    tabcontent.forEach(tab => tab.classList.remove("active"));

    tablinks = document.querySelectorAll(".tabs button");
    tablinks.forEach(link => link.classList.remove("active"));

    document.getElementById(tabName).classList.add("active");
    evt.currentTarget.classList.add("active");
  }

  // Mapbox Setup (Example)
  mapboxgl.accessToken = 'your_mapbox_access_token'; // Add your Mapbox token here
  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [-74.5, 40],
    zoom: 9
  });
</script>

@endsection