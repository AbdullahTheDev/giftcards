@extends('admin.layout.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Dashboard</h6>
                </nav>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container py-3">
            <div class="card">
                <div class="card-header px-3 py-2 d-flex" style="justify-content: space-between; align-items: center;">
                    <h3>Settings</h3>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <form action="{{ route('admin.settings.save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="">Merchant Fees (%)</label>
                                <input type="text" class="form-control border px-4" value="{{ $settings->admin_fees }}" name="admin_fees" id="">
                            </div>
                            <div class="col-6">
                                <label for="">Admin Fees (Fixed $)</label>
                                <input type="text" class="form-control border px-4" value="{{ $settings->merchant_fees }}" name="merchant_fees" id="">
                            </div>
                        </div>
                        <div>
                            <button class="w-full btn btn-primary mt-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    @endsection
