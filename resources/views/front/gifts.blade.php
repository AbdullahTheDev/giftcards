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

            <div class="card mt-5">
                <div class="card-body">
                    <table class="table" id="gift-table">
                        <thead>
                            <tr>
                                <th class="text-center">Gift ID</th>
                                <th class="text-center">Sender</th>
                                <th class="text-center">Message</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Admin Fee</th>
                                <th class="text-center">Date</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gifts as $gift)
                                <tr>
                                    <td class="text-center">{{ $gift?->gift_id }}</td>
                                    <td class="text-center">{{ $gift?->senderInfo->first_name . ' ' . $gift?->senderInfo->last_name }}</td>
                                    <td class="text-center">{{ $gift?->message }}</td>
                                    <td class="text-center">{{ $gift?->amount }}</td>
                                    <td class="text-center">{{ $gift?->admin_fee }}%</td>
                                    <td class="text-center">{{ \CArbon\Carbon::parse($gift?->date)->format('Y M d') }}</td>
                                    {{-- <td>{{ $gift?->date }}</td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
    <script>
         $(document).ready(function() {
            $('#gift-table').DataTable();
        });
    </script>
    @endsection
