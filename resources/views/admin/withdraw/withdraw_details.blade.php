@extends('admin.layout.app')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
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
                        <h3>Withdraw Requested</h3>
                        {{-- <h6>Withdraw amount: ${{ number_format($total, 2) }}</h6> --}}
                    </div>
                    {{-- <a class="btn btn-warning m-0" href="{{ route('withdraw.request.page') }}">Request Withdraw</a> --}}
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div style="border: 2px solid #303035; border-radius: 10px; padding: 10px; height: 100%;">
                                <h4 class="text-center my-2">User Details</h4>
                                <div class="d-flex flex-row my-2 gap-3">
                                    <h6>Name</h6>
                                    <p>{{ $withdraw->user->first_name . ' ' . $withdraw->user->last_name }}</p>
                                </div>
                                <div class="d-flex flex-row my-2 gap-3">
                                    <h6>Email</h6>
                                    <p>{{ $withdraw->user->email }}</p>
                                </div>
                                <div class="d-flex flex-row gap-3">
                                    <h6>Phone</h6>
                                    <p>{{ $withdraw->user->phone }}</p>
                                </div>
                            </div>  
                        </div>
                        <div class="col-12 col-md-6">
                            <div style="border: 2px solid #303035; border-radius: 10px; padding: 10px; height: 100%;">
                                <h4 class="text-center my-2">User Payment Details</h4>
                                <div class="d-flex flex-row my-2 gap-3">
                                    <h6>Account Name</h6>
                                    <p>{{ $paymentDetails->accountName }}</p>
                                </div>
                                <div class="d-flex flex-row my-2 gap-3">
                                    <h6>BSB Number</h6>
                                    <p>{{ $paymentDetails->BSBNumber }}</p>
                                </div>
                                <div class="d-flex flex-row my-2 gap-3">
                                    <h6>Account Number</h6>
                                    <p>{{ $paymentDetails->accountNumber }}</p>
                                </div>
                                <div class="d-flex flex-row gap-3">
                                    <h6>Bank Name</h6>
                                    <p>{{ $paymentDetails->bankName }}</p>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <hr class="bg-secondary">
                    <div class="d-flex flex-row my-2 gap-3">
                        <h5>Total Amount</h5>
                        <p style="font-weight: bold;">${{ number_format($withdraw->amount) }}</p>
                    </div>
                    <div class="d-flex flex-row my-2 gap-3" style="justify-content: space-between; align-items: center;">
                        <h5 style="align-items: center; display: flex; gap: 13px;">
                            Payment Status 
                            @if($withdraw->payment_status == 'pending')
                                <span class="ml-3 badge bg-secondary">{{ $withdraw->payment_status }}</span>
                            @else
                                <span class="ml-3 badge bg-success">{{ $withdraw->payment_status }}</span>
                            @endif
                        </h5>
                        @if($withdraw->payment_status == 'paid')
                            <a href="" class="btn btn-success">Make Payment Paid</a>
                        @else
                            <a href="" class="btn btn-success">Make Payment Pending</a>
                        @endif
                    </div>

                    <hr class="bg-secondary mb-4">
                    <div>
                        <h2 class="my-2">Withdrawl Gifts</h2>
                        <table class="table" id="gift-table">
                            <thead>
                                <tr>
                                    <th class="text-center">Gift ID</th>
                                    <th class="text-center">User Email</th>
                                    <th class="text-center">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawlGifts as $withdrawlGift)
                                    <tr>
                                        <td class="text-center">{{ $withdrawlGift->gifts->gift_id }}</td>
                                        <td class="text-center">{{ $withdrawlGift->withdrawFunc->user->email }}</td>
                                        <td class="text-center">${{ number_format($withdrawlGift->amount, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                $('#gift-table').DataTable();
                // $('#gift-table').DataTable({
                    // dom: 'Bfrtip',
                    // buttons: [{
                    //         extend: 'excelHtml5',
                    //         title: 'Withdraw History',
                    //         className: 'btn btn-success'
                    //     },
                    //     {
                    //         extend: 'csvHtml5',
                    //         title: 'Withdraw History',
                    //         className: 'btn btn-info'
                    //     },
                    //     {
                    //         extend: 'pdfHtml5',
                    //         title: 'Withdraw History',
                    //         className: 'btn btn-danger',
                    //         orientation: 'landscape',
                    //         pageSize: 'A4'
                    //     },
                    //     {
                    //         extend: 'print',
                    //         title: 'Withdraw History',
                    //         className: 'btn btn-primary'
                    //     }
                    // ]
                // });
            });
        </script>
    @endsection
