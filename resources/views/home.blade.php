@extends('layouts.ourapp')
@section('title')
    Home Page - Gift Cards
@endsection
@section('content')

    <body>
        <section class="host">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Find Your Host</h1>
                        <h3>Find host by ID or name</h3>
                        <div class="search-wrapper">
                            <form action="{{ route("user.search") }}" method="POST">
                                @csrf
                                <input type="text" name="search" placeholder="Enter 6-Digit ID or host name">
                                <button>Search</button>
                            </form>
                        </div>
                        <hr>
                        @if (!Auth::check())
                            <p>Login or create an account with My Wishing Well.</p>
                            <div class="login-register button">
                                <a href="{{ route('login') }}" class="btn Login">Login</a>
                                <a href="{{ route('register') }}" class="btn Register">Register as Host</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endsection
