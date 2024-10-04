{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layouts.ourapp')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <h5 class="my-3">Forgot your password? No problem. Just let us know your email address and we will
                        email you a
                        password reset
                        link that will allow you to choose a new one.</h5>
                    <!-- Email Address -->

                    @if (session('status'))
                        <div class="mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="alert alert-primary">
                        <p style="margin: 0; color: #000;">We have emailed your password reset link.</p>
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
                    <div>
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required
                            value="{{ old('email') }}">
                    </div>

                    <div class="mt-4">
                        <button class="btn btn-primary">
                            Email Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
