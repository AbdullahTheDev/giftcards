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
                    <h3>Request Withdraws</h3>
                    <p style="font-size: 20px; font-weight: 600;">Select Gifts for withdraw</p>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <form action="{{ route('withdraw.request') }}" method="post">
                        @csrf
                        <table class="table" id="gift-table">
                            <thead>
                                <tr>
                                    <th class="text-center" style="padding: 10px;">
                                        <!-- Add "Select All" checkbox -->
                                        <input type="checkbox" id="select-all" style="width: 20px; height: 20px;">
                                    </th>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Gift ID</th>
                                    <th class="text-center">Sender</th>
                                    <th class="text-center">Message</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Admin Fees</th>
                                    {{-- <th class="text-center">Merchant Fees</th> --}}
                                    <th class="text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gifts as $gift)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" style="width: 20px; height: 20px;" name="gift_ids[]"
                                                value="{{ $gift->id }}">
                                        </td>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $gift?->gift_id }}</td>
                                        <td class="text-center">
                                            {{ $gift?->senderInfo->first_name . ' ' . $gift?->senderInfo->last_name }}
                                        </td>
                                        <td class="text-center">{{ $gift?->message }}</td>
                                        <td class="text-center">${{ number_format($gift?->amount, 2) }}</td>
                                        <td class="text-center">${{ number_format($gift?->merchant_fee, 2) }}</td>
                                        {{-- <td class="text-center">${{ number_format($gift?->admin_fee, 2) }}</td> --}}
                                        <td class="text-center">{{ \Carbon\Carbon::parse($gift?->date)->format('Y M d') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {
                // Initialize DataTables
                // $('#gift-table').DataTable();

                $('#gift-table').DataTable({
                    "columnDefs": [{
                            "orderable": false,
                            "targets": 0
                        } // Disable sorting on the first column (the checkboxes column)
                    ]
                });

                // Handle Select All functionality
                $('#select-all').click(function() {
                    // If select-all is checked, check all checkboxes; otherwise, uncheck all
                    $('input[name="gift_ids[]"]').prop('checked', this.checked);
                });

                // Ensure "Select All" checkbox is updated if individual checkboxes are clicked
                $('input[name="gift_ids[]"]').click(function() {
                    if ($('input[name="gift_ids[]"]').length === $('input[name="gift_ids[]"]:checked').length) {
                        $('#select-all').prop('checked', true);
                    } else {
                        $('#select-all').prop('checked', false);
                    }
                });
            });
        </script>
    @endsection
