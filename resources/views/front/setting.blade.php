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

                                <div class="input-group">
                                    <label for="password">Password:</label>
                                    <input type="password" name="password" value="" id="password">
                                </div>
                            </div>

                            <div class="event-setup">
                                <h3>Event Setup</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="showname">Event Name:</label>
                                            <input type="text" name="showname" value="{{ $event->showname ?? '' }}"
                                                id="showname" id="showname">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="eventName">Event URL:</label>
                                            <input type="text" name="name" value="{{ $event->name ?? '' }}"
                                                id="eventName" id="eventName">
                                        </div>
                                    </div>
                                </div>



                                <div class="input-group">
                                    <label for="eventImage">Event Image:</label>
                                    <input type="file" name="image" id="eventImage" accept="image/*"
                                        onchange="previewImage(event, 'eventImagePreview', 'clearImageInput')">

                                    <input type="hidden" name="clear_image" value="0" id="clearImageInput">

                                    <div style="position: relative; display: inline-block;">
                                        @if ($event->image ?? null)
                                            <img id="eventImagePreview" src="{{ asset($event->image) }}" alt="Event Image"
                                                style="max-width: 200px; display: block; margin-top: 10px;">
                                            <button type="button"
                                                onclick="clearImage('eventImage', 'eventImagePreview', 'clearImageInput')"
                                                style="display: block; position: absolute; top: 4px; right: 4px; background: #cd8603; color: white; border: none; cursor: pointer; padding: 1px 8px; width: max-content;"
                                                id="clearEventImageBtn">
                                                X
                                            </button>
                                        @else
                                            <img id="eventImagePreview"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                            <button type="button"
                                                onclick="clearImage('eventImage', 'eventImagePreview', 'clearImageInput')"
                                                style="display: block; position: absolute; top: 4px; right: 4px; background: #cd8603; color: white; border: none; cursor: pointer; padding: 1px 8px; width: max-content;"
                                                id="clearEventImageBtn2">
                                                X
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label for="eventBanner">Event Banner:</label>
                                    <input type="file" name="banner" id="eventBanner" accept="image/*"
                                        onchange="previewImage(event, 'eventBannerPreview', 'clearBannerInput')">

                                    <input type="hidden" name="clear_banner" value="0" id="clearBannerInput">

                                    <div style="position: relative; display: inline-block;">
                                        @if ($event->banner ?? null)
                                            <img id="eventBannerPreview" src="{{ asset($event->banner) }}"
                                                alt="Event Banner"
                                                style="max-width: 200px; display: block; margin-top: 10px;">
                                            <button type="button"
                                                onclick="clearImage('eventBanner', 'eventBannerPreview', 'clearBannerInput')"
                                                style="display: block; position: absolute; top: 4px; right: 4px; background: #cd8603; color: white; border: none; cursor: pointer; padding: 1px 8px; width: max-content;"
                                                id="clearEventBannerBtn">
                                                X
                                            </button>
                                        @else
                                            <img id="eventBannerPreview"
                                                style="max-width: 200px; display: none; margin-top: 10px;">
                                            <button id="eventBannerPreviewBtn" type="button"
                                                onclick="clearImage('eventBanner', 'eventBannerPreview', 'clearBannerInput')"
                                                style="display: block; position: absolute; top: 4px; right: 4px; background: #cd8603; color: white; border: none; cursor: pointer; padding: 1px 8px; width: max-content;">
                                                X
                                            </button>
                                        @endif
                                    </div>
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
                            <input type="text" id="find_address" name="location" class=""
                                value="{{ $event->location }}" placeholder="Enter your location">
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
                            id="accountName" placeholder="Enter your account name">

                        <label for="BSBNumber">BSB Number</label>
                        <input type="text" name="BSBNumber" placeholder="Enter your BSB number"
                            value="{{ $paymentDetails->BSBNumber }}" id="BSBNumber">

                        <label for="accountNumber">Account Number</label>
                        <input type="text" name="accountNumber" value="{{ $paymentDetails->accountNumber }}"
                            id="accountNumber" placeholder="Enter your account number">

                        <label for="bankName">Bank Name</label>
                        <input type="text" name="bankName" value="{{ $paymentDetails->bankName }}" id="bankName"
                            placeholder="Enter your bank name">

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
        $('#eventName').on('input', function() {
            // Get the current value
            var eventName = $(this).val();

            // Replace spaces with hyphens
            var formattedEventName = eventName.replace(/\s+/g, '-');

            // Set the updated value back to the input field
            $(this).val(formattedEventName);
        });

        function previewImage(event, previewId, clearInputId) {
            const output = document.getElementById(previewId);
            const clearInput = document.getElementById(clearInputId);

            // Display the selected image
            if (event.target.files && event.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                    output.style.display = 'block'; // Show the image preview

                    // Reset the hidden input to indicate a new upload
                    clearInput.value = '0'; // Set to 0 since a new image is being uploaded

                    // Show the clear button
                    const clearBtn = document.getElementById(previewId + 'Btn');
                    clearBtn.style.display = 'block';
                };
                reader.readAsDataURL(event.target.files[0]);
            }
        }


        function clearImage(inputId, previewId, clearInputId) {
            // Clear the file input
            document.getElementById(inputId).value = '';

            // Hide the image preview
            var output = document.getElementById(previewId);
            output.style.display = 'none';
            output.src = '';

            // Hide the "X" button
            var clearBtnId = previewId === 'eventImagePreview' ? 'clearEventImageBtn' : 'clearEventBannerBtn';
            document.getElementById(clearBtnId).style.display = 'none';

            // Set the hidden input value to indicate the user wants to clear the image
            document.getElementById(clearInputId).value = '1';
        }

        function clearImage2(inputId, previewId, clearInputId) {
            // Clear the file input
            document.getElementById(inputId).value = '';

            // Hide the image preview
            var output = document.getElementById(previewId);
            output.style.display = 'none';
            output.src = '';

            // Hide the "X" button
            var clearBtnId = previewId === 'eventImagePreview' ? 'clearEventImageBtn' : 'clearEventBannerBtn';
            document.getElementById(clearBtnId).style.display = 'none';
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
