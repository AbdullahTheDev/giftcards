{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required
                autofocus autocomplete="username" />
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
            <x-primary-button>
                {{ __('Reset Password') }}
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
                        <form action="{{ route('password.store') }}" method="POST" class="main-form form-group"
                            id="register-form">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">


                            <label for="email">Email *</label>
                            <input type="email" value="{{ old('email') }}" name="email" placeholder="Enter your email"
                                class="form-control" id="email-input">

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

                            <input type="submit" value="Reset Password" id="ResetPassword" class="btn btn-primary">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
