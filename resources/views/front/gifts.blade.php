@extends('front.layout.app')

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
                <div class="card-header px-3 py-2">
                    <h3>Gifts</h3>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Gift ID</th>
                                <th>Sender</th>
                                <th>Message</th>
                                <th>Amount</th>
                                <th>Admin Fee</th>
                                <th>Date</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gifts as $gift)
                                <tr>
                                    <td>{{ $gift?->gift_id }}</td>
                                    <td>{{ $gift?->sender }}</td>
                                    <td>{{ $gift?->message }}</td>
                                    <td>{{ $gift?->amount }}</td>
                                    <td>%{{ $gift?->admin_fee }}</td>
                                    <td>{{ \CArbon\Carbon::parse($gift?->date)->format('Y M d') }}</td>
                                    {{-- <td>{{ $gift?->date }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
