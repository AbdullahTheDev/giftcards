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
                <div class="card-header px-3 py-2">
                    <h3>Transactions</h3>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <table class="table" id="gift-table">
                        <thead>
                            <tr>
                                <th class="text-center">Gift ID</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Sender Name</th>
                                <th class="text-center">Sender Email</th>
                                <th class="text-center">Sender Phone</th>
                                <th class="text-center">Sender Address</th>
                                <th class="text-center">Receiver Email</th>
                                <th class="text-center">Date</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="text-center">{{ $transaction->gift_id }}</td>
                                    <td class="text-center">${{ number_format($transaction->amount, 2) }}</td>
                                    <td class="text-center">
                                        {{ $transaction?->senderInfo->first_name . ' ' . $transaction?->senderInfo->last_name }}
                                    </td>
                                    <td class="text-center">{{ $transaction?->senderInfo->email }}</td>
                                    <td class="text-center">{{ $transaction?->senderInfo->phone }}</td>
                                    <td class="text-center">{{ $transaction?->senderInfo->address }}</td>
                                    <td class="text-center">{{ $transaction?->user->email }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($transaction?->date)->format('Y M d') }}</td>
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
                $('#gift-table').DataTable({
                    dom: 'Bfrtip',
                    // buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
                    buttons: [{
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
