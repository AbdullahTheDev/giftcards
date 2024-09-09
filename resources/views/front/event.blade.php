@extends('layouts.ourapp')
@section('title')
    {{ $user->first_name . ' ' . $user->last_name }} Profile
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
    <section class="">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="user-main">
                        <div class="user-prf">
                            <img src="{{ asset($event?->image) }}" style="width: 200px; border-radius: 50%;" alt="">
                            {{-- <i class="fa fa-user-circle-o" aria-hidden="true"></i> --}}
                        </div>
                        <div class="user-details">
                            <h4>{{ $user->first_name . ' ' . $user->last_name }}</h4>
                            <p><i class="fa fa-calendar-o" aria-hidden="true"></i>Event Date:<b>
                                    {{ \Carbon\Carbon::parse($event?->event_date)->format('d M Y') }}</b></p>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>Event Location:<b>
                                    {{ $event?->location }}</b></p>
                            <p><i class="fa fa-star-o" aria-hidden="true"></i>Description:<b> {{ $event?->description }}</b>
                            </p>
                        </div>
                    </div>

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
                                <input type="number" name="amount" id="amount" placeholder="" class="form-control" pattern="[0-9]*" title="Please enter only numbers.">
                                <h3 class="text-start">Message</h3>
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
                                        <input type="text" name="suburb" class="form-control" id="suburb" required>
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
                                        <span>Credit card surcharge</span>
                                        <span>$18.10</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <span>Total</span>
                                        <span>$1,017.10</span>
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

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        // Initialize Stripe
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
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

                // Get the current value of the input
                var amountValue = $(this).val();

                // Update the hidden input value
                $('#amountValInput').val(amountValue);

                // Update the display element with the new amount
                $('#amountVal').text(amountValue);
            });
        });
    </script>
@endsection
