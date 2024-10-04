{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.ourapp')

@section('content')
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-form">
                        <a href="" class="top-img">
                            <img src="img/google.png" alt="">
                        </a> <br>
                        <img src="img/Capture.PNG" alt="">
                        <div class="detailss">
                            <h3>Register Now</h3>
                            <p>Please fill the form below to register as a host.</p>
                            {{-- <a href="{{ route('login.google') }}" class="btn btn-primary">
                                Login with Google
                            </a> --}}
                        </div>
                        <form action="{{ route('register') }}" method="POST" class="main-form form-group"
                            id="register-form">
                            @csrf
                            <label for="email">Email *</label>
                            <input type="email" name="email" placeholder="Enter your email" class="form-control"
                                id="email-input">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            {{-- <div class="code">
                                <button type="button" class="btn btn-secondary" id="send-code-btn">Send Code</button>
                            </div> --}}

                            <label for="first_name">First Name *</label>
                            <input type="text" name="first_name" placeholder="Enter your first name"
                                class="form-control">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="last_name">Last Name *</label>
                            <input type="text" name="last_name" placeholder="Enter your last name" class="form-control">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="password">Password *</label>
                            <input type="password" name="password" placeholder="Enter your password" class="form-control">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <label for="password_confirmation">Confirm Password *</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm your password"
                                class="form-control">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="d-block mt-2">
                                <input type="checkbox" name="terms" id="terms" class="form-check-input mx-3" style="border-radius: 0;">
                                <label for="terms"> <span>*</span> I agree to the <a href="https://wishify.com.au/terms-conditions/">Terms & Conditions</a></label>
                            </div>

                            <input type="submit" value="Register Now" id="submit-btn" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Include jQuery for AJAX requests -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle the send code button click event
            $('#send-code-btn').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the email value from the input field
                var email = $('#email-input').val();

                // Send the AJAX request to send the verification code
                $.ajax({
                    url: '{{ route('send.verification.code') }}', // Your route to send code
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                        email: email
                    },
                    success: function(response) {
                        alert(response.success); // Show success message
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            alert(errors.email[0]); // Display error message if validation fails
                        } else {
                            alert(
                            'An error occurred. Please try again.'); // General error message
                        }
                    }
                });
            });
        });
    </script>
@endsection
