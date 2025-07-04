@extends('layouts.ourapp')
@section('title')
    {{ $user->first_name . ' ' . $user->last_name }} Profile
@endsection
@section('meta')
    <!-- Primary Meta Tags -->
    <title>{{ $event->showname ?? 'Default Title' }}</title>
    <meta name="title" content="{{ $event->showname ?? 'Default Title' }}">
    <meta name="description" content="{{ $event->description ?? 'Default Description' }}">

    <!-- Open Graph / Facebook / Instagram / WhatsApp / Messenger -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $event->showname ?? 'Default Title' }}">
    <meta property="og:description" content="{{ $event->description ?? 'Default Description' }}">
    <meta property="og:image" content="{{ asset($event->meta_image ?? 'default-image.jpg') }}">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $event->showname ?? 'Default Title' }}">
    <meta name="twitter:description" content="{{ $event->description ?? 'Default Description' }}">
    <meta name="twitter:image" content="{{ asset($event->meta_image ?? 'default-image.jpg') }}">
@endsection
@section('content')
    <style>
        /* Basic form styling */
        #payment-form {
            max-width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Stripe Element container */
        #card-element {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }

        /* Error message styling */
        #card-errors {
            color: red;
            margin-top: 10px;
        }

        /* Button styling */
        button {
            background-color: #5469d4;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #4353b8;
        }
    </style>
    <section class="even-banner">
        <div style="width: 100%; position: relative;">
            @if ($event->banner != null)
                @if ($event->show_banner == 1)
                    <div>
                        <img src="{{ asset('/') }}{{ $event?->banner }}" class="event-banner"
                            style="width: 100%;height: 50vh;object-fit: cover;filter: brightness(0.6);">
                        <p class="eventName" style="color: #fff; font-size: 42px; font-weight: bold;">
                            -{{ $event->showname }}-</p>
                    </div>
        </div>
        @endif
    @else
        <img src="{{ asset('uploads/banners/banner.jpg') }}"
            style="width: 100%; height: 50vh; object-fit: cover; filter: brightness(0.6)" alt="">
        @if ($event->image != null)
            <!---  <div style="height: 35px;"></div>-->
        @endif
        @endif
        <div class="inner-event"
            style="position: relative; height: 100%; padding: 10px 10%; background-color: #000; display: flex; flex-direction: row; gap: 18px;">
            @if ($event->image != null)
                @if ($event->show_profile == 1)
                    <div class="user-prf">
                        <img src="{{ asset($event?->image) }}"
                            style="width: 100%; height: 100%; border-radius: 50%; margin-top: -60px" alt="">
                        {{-- <i class="fa fa-user-circle-o" aria-hidden="true"></i> --}}
                    </div>
                @endif
            @endif
            <div class="user-details">
                <h4>{{ $event?->showname }}</h4>
                <p><i class="fa fa-calendar-o" aria-hidden="true"></i>Event Date:<b>
                        {{ \Carbon\Carbon::parse($event?->event_date)->format('d M Y') }}</b></p>
                @if ($event->location != null)
                    <p>
                        <i class="fa fa-map-marker" aria-hidden="true"></i>Event Location:<b>
                            {{ $event?->location }}</b>
                    </p>
                @endif
                @if ($event->description != null)
                    <p>
                        <i class="fa fa-star-o" aria-hidden="true"></i>Description:<b> {{ $event?->description }} </b>
                    </p>
                @endif
            </div>
        </div>
        </div>

        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin: 0 !important; list-style: none;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('process.payment') }}" method="POST" id="payment-form" class="p-3">
                        <input type="hidden" name="user_id" value="{{ $user->id }}" id="">
                        <div class="gift-amount-main">

                            <div id="send-gift-frm">

                                <h3>Your Gift</h3>
                                <label for="amount"><b>Enter your gift amount ($)</b></label>
                                <input type="number" name="amount" id="amount" placeholder="" class="form-control"
                                    pattern="[0-9]*" title="Please enter only numbers.">
                                <h3 class="text-center mt-4">Message</h3>
                                <label for=""><i>Your special message for the host</i></label>
                                <textarea name="message" id="" rows="3" class="form-control"></textarea>
                                <input type="submit" value="Send Gift" id="send-gift" class="form-control">

                            </div>
                            {{-- </form> --}}

                            <div class="container form-container">
                                <h4 class="form-title">Your Details</h4>
                                {{-- <form> --}}
                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First name *</label>
                                        <input type="text" name="first_name" class="form-control" id="firstName"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last name *</label>
                                        <input type="text" name="last_name" class="form-control" id="lastName" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="country" class="form-label">Country/Region *</label>
                                    <select id="country" name="country" class="form-select" required>
                                        <option selected>Australia</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="streetAddress" class="form-label">Street address *</label>
                                    <input type="text" name="address" class="form-control" id="streetAddress"
                                        placeholder="House number and street name" required>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-md-6">
                                        <label for="suburb" class="form-label">Suburb *</label>
                                        <input type="text" name="suburb" class="form-control" id="suburb"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state" class="form-label">State *</label>
                                        <select id="state" name="state" class="form-select" required>
                                            <option selected>New South Wales</option>
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="postcode" class="form-label">Postcode *</label>
                                    <input type="text" name="postcode" class="form-control" id="postcode" required>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone *</label>
                                    <input type="tel" name="phone" class="form-control" id="phone" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address *</label>
                                    <input type="email" name="email" class="form-control" id="email" required>
                                </div>

                                <div class="total-container">
                                    <h4>Your Gift</h4>
                                    <div class="d-flex justify-content-between">
                                        <span>Gift amount</span>
                                        <span>$<span id="amountVal">0.00</span> </span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Merchant fee</span>
                                        <span id="showFees">$0</span>
                                        <span style="display: none;"
                                            id="merchant_fees">{{ $settings->merchant_fees }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <span>Total</span>
                                        <span>$<span id="amountValTotal">0</span>
                                        </span>
                                    </div>
                                </div>

                                <h4 class="form-title mt-4">Payment</h4>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="paymentMethod"
                                            id="creditCard" checked>
                                        <label class="form-check-label" for="creditCard">
                                            Credit/Debit Cards
                                        </label>
                                    </div>
                                </div>

                                {{-- </form> --}}


                                @csrf
                                <div class="input">
                                    <div id="card-element" class="form-control">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <small id="card-errors" class="text-danger"></small>
                                </div>

                                <button class="btn btn-primary btn-block free-button w-100 mb-2">Pay</button>

                                <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is
                                    secured with SSL certificate</span>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/country-state-city@3.0.1/lib/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const countrySelect = document.getElementById('country');
        const stateSelect = document.getElementById('state');
    
        // Load all countries
        axios.get('https://countriesnow.space/api/v0.1/countries/positions')
            .then(res => {
                res.data.data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.name;
                    option.textContent = country.name;
                    countrySelect.appendChild(option);
                });
            });
    
        // Load states on country change
        countrySelect.addEventListener('change', () => {
            stateSelect.innerHTML = '<option value="">Loading...</option>';
            axios.post('https://countriesnow.space/api/v0.1/countries/states', {
                country: countrySelect.value
            })
            .then(res => {
                stateSelect.innerHTML = '<option value="">Select State</option>';
                res.data.data.states.forEach(state => {
                    const option = document.createElement('option');
                    option.value = state.name;
                    option.textContent = state.name;
                    stateSelect.appendChild(option);
                });
            });
        });
    </script>
    
    
    <script>
        // Initialize Stripe
        var stripe = Stripe(
            'pk_test_51MdztzFgNsE3EcUKLIVsuDYrVMoV1FkaROiYxGzKMN6BgPpW8Z6tletimlr4o6ziiu3P0JnYhG8RyejLIh1ZezGx00Utc7hvC4'
            );
        var elements = stripe.elements();

        // Create an instance of the card Element
        var card = elements.create('card');

        // Add an instance of the card Element into the `card-element` div
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server
                    var form = document.getElementById('payment-form');
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);

                    // Submit the form
                    form.submit();
                }
            });
        });
    </script>


    <script>
        // Format card number as 1234-5678-9012-3456
        function formatCardNumber(element) {
            const value = element.value.replace(/\D/g, ''); // Remove all non-digit characters
            const formattedValue = value.match(/.{1,4}/g)?.join('-'); // Group digits in sets of 4
            element.value = formattedValue || '';
        }

        // Automatically add a slash (/) in the expiration date field as MM/YY
        function formatExpirationDate(element) {
            const value = element.value.replace(/\D/g, ''); // Remove all non-digit characters
            if (value.length > 2) {
                element.value = value.slice(0, 2) + '/' + value.slice(2, 4); // Add the slash after MM
            } else {
                element.value = value;
            }
        }

        // Restrict input length dynamically (used for CVV)
        function limitInputLength(element) {
            const maxLength = element.getAttribute('maxlength');
            if (element.value.length > maxLength) {
                element.value = element.value.slice(0, maxLength);
            }
        }

        document.getElementById('payment-form').addEventListener('submit', function(event) {
            let valid = true;

            // Clear previous error messages
            document.getElementById('card_number_error').textContent = '';
            document.getElementById('expiration_date_error').textContent = '';
            document.getElementById('cvv_error').textContent = '';

            // Card number validation
            const cardNumber = document.getElementById('card_number').value.replace(/-/g, '');
            const cardNumberPattern = /^[0-9]{16}$/; // Simple validation for 16 digits without hyphens
            if (!cardNumberPattern.test(cardNumber)) {
                document.getElementById('card_number_error').textContent =
                    'Please enter a valid 16-digit card number.';
                valid = false;
            }

            // Expiration date validation
            const expirationDate = document.getElementById('expiration_date').value;
            const expirationDatePattern = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/; // MM/YY format
            if (!expirationDatePattern.test(expirationDate)) {
                document.getElementById('expiration_date_error').textContent =
                    'Please enter a valid expiration date (MM/YY).';
                valid = false;
            }

            // CVV validation
            const cvv = document.getElementById('cvv').value;
            const cvvPattern = /^[0-9]{3}$/; // Simple validation for 3 digits
            if (!cvvPattern.test(cvv)) {
                document.getElementById('cvv_error').textContent = 'Please enter a valid 3-digit CVV.';
                valid = false;
            }

            // Prevent form submission if validation fails
            if (!valid) {
                event.preventDefault();
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Listen for input changes on the amount field
            $('#amount').on('input', function() {

                // Get the current value of the input and convert to a number
                var amountValue = parseFloat($(this).val()) || 0;
                var merchantFeesPercent = parseFloat($('#merchant_fees').text()) || 0;

                // Calculate the admin fee as a percentage of the amount
                var merchantFees = (amountValue * merchantFeesPercent) / 100;

                // Update the hidden input value
                $('#amountValInput').val(amountValue);

                // Update the display element with the new amount
                $('#amountVal').text(amountValue.toFixed(2));

                // Calculate the total with admin fees and update the display
                var totalAmount = amountValue + merchantFees;

                $('#amountValTotal').text(totalAmount.toFixed(2));

                $('#showFees').text('$' + merchantFees.toFixed(2));
                // $('#showMerchantFees').text('$' + merchantFees.toFixed(2));
            });
        });
    </script>
@endsection
