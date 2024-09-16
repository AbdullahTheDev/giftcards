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
                            <div class="progress-bar" id="progressBar" style="width: {{ $completionPercentage }}%;">
                                {{ number_format($completionPercentage, 0) }}% Complete!
                            </div>
                        </div>


                        <form class="form-container" method="POST" action="{{ route('update.user') }}" id="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="general-settings">
                                <h3>General Setting</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="first_name">First Name:</label>
                                            <input type="text" name="first_name" value="{{ $user->first_name }}"
                                                id="first_name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="last_name">Last Name:</label>
                                            <input type="text" name="last_name" value="{{ $user->last_name }}"
                                                id="last_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label for="email">Contact Email:</label>
                                    <input type="email" disabled name="email" value="{{ $user->email }}"
                                        id="email">
                                </div>
                                <div class="input-group">
                                    <label for="phone">Contact Phone:</label>
                                    <input type="tel" name="phone" value="{{ $user->phone }}" id="phone">
                                </div>
                            </div>

                            <div class="event-setup">
                                <h3>Event Setup</h3>
                                <div class="input-group">
                                    <label for="eventName">Event Name:</label>
                                    <input type="text" name="name" value="{{ $event->name ?? '' }}" id="eventName">
                                </div>
                                <div class="input-group">
                                    <label for="eventImage">Event Image:</label>
                                    <input type="file" name="image" id="eventImage" accept="image/*"
                                        onchange="previewImage(event, 'eventImagePreview')">
                                    <!-- Show existing image if available -->
                                    @if ($event->image ?? null)
                                        <img id="eventImagePreview" src="{{ asset($event->image) }}" alt="Event Image"
                                            style="max-width: 200px; display: block; margin-top: 10px;">
                                    @else
                                        <img id="eventImagePreview"
                                            style="max-width: 200px; display: none; margin-top: 10px;">
                                    @endif
                                </div>
                                {{-- 
                                  <div class="input-group">
                                    <label for="eventBannerType">Event Banner Type:</label>
                                    <select id="eventBannerType">
                                      <option value="static">Static Image</option>
                                    </select>
                                  </div> 
                                --}}
                                <div class="input-group">
                                    <label for="eventBanner">Event Banner:</label>
                                    <input type="file" name="banner" id="eventBanner" accept="image/*"
                                        onchange="previewImage(event, 'eventBannerPreview')">


                                    @if ($event->banner ?? null)
                                        <img id="eventBannerPreview" src="{{ asset($event->banner) }}" alt="Event Banner"
                                            style="max-width: 200px; display: block; margin-top: 10px;">
                                    @else
                                        <img id="eventBannerPreview"
                                            style="max-width: 200px; display: none; margin-top: 10px;">
                                    @endif
                                </div>
                                <div class="input-group">
                                    <label for="eventDate">Event Date:</label>
                                    <input type="date" name="event_date"
                                        value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') ?? '' }}"
                                        id="eventDate">
                                </div>
                                <div class="input-group">
                                    <label for="eventDescription">Event Description:</label>
                                    <textarea id="eventDescription" name="description" rows="5">{{ $event->description ?? '' }}</textarea>
                                </div>
                            </div>

                            {{-- <div class="profile-visibility">
                                <h3>Profile Visibility Setup</h3>
                                <div class="input-group">
                                    <label for="visibility">Profile Name Position:</label>
                                    <select name="" id="visibility">
                                        <option value="offBanner">Off Banner</option>
                                        <option value="onBanner">On Banner</option>
                                    </select>
                                </div>
                            </div> --}}

                            <button type="submit">Save</button>
                        </form>
                    </div>

                </div>

                <!-- Location Tab (with Map) -->
                <div id="locationTab">
                    <h3>Location</h3>
                    <div class="location-tabs-container">
                        <form class="form-container" method="POST" action="{{ route('update.user.location') }}">
                            @csrf
                            <h4>Your Location</h4>
                            <input type="text" id="find_address" name="location" class="" value="{{ $event->location }}" placeholder="Enter your location">
                            <button>Save</button>
                        </form>
                    </div>
                </div>

                <!-- Payment Tab -->
                <div id="paymentTab">
                    <h3>Payment Form</h3>
                    <form class="payment-form" method="POST" action="{{ route('update.payament.user') }}">
                        @csrf
                        <label for="accountName">Account Name</label>
                        <input type="text" name="accountName" value="{{ $paymentDetails->accountName }}"
                            id="accountName" placeholder="Enter your card number">

                        <label for="BSBNumber">BSB Number</label>
                        <input type="text" name="BSBNumber" value="{{ $paymentDetails->BSBNumber }}" id="BSBNumber">

                        <label for="accountNumber">Account Number</label>
                        <input type="text" name="accountNumber" value="{{ $paymentDetails->accountNumber }}"
                            id="accountNumber" placeholder="Enter your card number">

                        <label for="bankName">Bank Name</label>
                        <input type="text" name="bankName" value="{{ $paymentDetails->bankName }}" id="bankName"
                            placeholder="Enter name on card">

                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Mapbox GL JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.12.0/mapbox-gl.css' rel='stylesheet' />

    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
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
