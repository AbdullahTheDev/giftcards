{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
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
                            <h3>Login</h3>
                            <p>Welcome To My Wishing Well.</p>
                        </div>
                        {{-- <a href="{{ route('login.google') }}" class="btn btn-primary">
                            Login with Google
                        </a>
                         --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin: 0 !important; list-style: none;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <form action="{{ route('login') }}" method="POST" class="main-form form-group">
                            @csrf
                            <label for="email">Email address *</label>
                            <input type="email" name="email" placeholder="" class="form-control">
                            
                            <label for="password">Password *</label>
                            <input type="password" name="password" placeholder="" class="form-control">
                            
                            <input type="submit" value="Login" id="submit-btn" class="form-control">
                            <div class="d-block mt-2">
                                <label for="remember">Remember Me</label>
                                <input type="checkbox" name="remember" placeholder="" class="form-control check">
                            </div>
                            {{-- <p><a href="">Lost your password?</a></p> --}}
                            <span>Don't have an account yet?<a href="{{ route('register') }}">Register now.</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
