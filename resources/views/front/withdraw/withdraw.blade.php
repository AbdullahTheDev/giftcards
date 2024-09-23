@extends('front.layout.app')

@section('content')
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
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
                <div>
                    <h3>Withdraw History</h3>
                    <h6>Withdraw amount: ${{ number_format($total, 2) }}</h6>
                    <h6>Remaining amount: ${{ number_format($giftsAmount, 2) }}</h6>
                </div>
                <a class="btn btn-warning m-0" href="{{ route('withdraw.request.page') }}">Request Withdraw</a>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <table class="table" id="gift-table">
                    <thead>
                        <tr>
                            <th class="text-center">Invoice ID</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Payment</th>
                            <th class="text-center">Admin Fees</th>
                            {{-- <th class="text-center">Merchant Fees</th> --}}
                            <th class="text-center">Mode</th>
                            {{-- <th class="text-center">Note</th> --}}
                            <th class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($withdrawls as $withdrawl)
                            <tr>
                                <td class="text-center">{{ $withdrawl?->invoice_id }}</td>
                                <td class="text-center">${{ number_format($withdrawl?->amount, 2) }}</td>
                                <th class="text-center">
                                    @if($withdrawl->payment_status == 'pending')
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($withdrawl->payment_status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            {{ ucfirst($withdrawl->payment_status) }}
                                        </span>
                                    @endif
                                </th>
                                {{-- <td class="text-center">${{ number_format($withdrawl?->merchant_fees, 2) }}</td> --}}
                                <td class="text-center">${{ number_format($withdrawl?->admin_fees, 2) }}</td>
                                <th class="text-center">{{ $withdrawl->mode }}</th>
                                {{-- <th class="text-center">{{ $withdrawl->note }}</th> --}}
                                <td class="text-center">{{ \Carbon\Carbon::parse($withdrawl?->date)->format('Y M d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Include DataTables and Buttons extension JS and CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#gift-table').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Withdraw History',
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Withdraw History',
                        className: 'btn btn-info'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Withdraw History',
                        className: 'btn btn-danger',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        title: 'Withdraw History',
                        className: 'btn btn-primary'
                    }
                ]
            });
        });
    </script>
@endsection
