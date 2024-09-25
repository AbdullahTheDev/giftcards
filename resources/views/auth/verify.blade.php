@extends('layouts.ourapp')

@section('title')
    Verify Your Code
@endsection

@section('content')
<section class="host">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Verification</h1>
                <h3>Enter the verification code sent to your email:</h3>
                <div class="search-wrapper">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h3 class="mb-0 text-dark">{{ $error }}</h3>
                            <span type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></span>
                        </div>
                    @endforeach
                    <form action="{{ route('verification') }}" method="POST">
                        @csrf
                        <input type="text" value="{{ old('code') }}" name="code">
                        <button>Verify</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
