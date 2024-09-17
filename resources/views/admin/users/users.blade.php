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
                    <h3>Users</h3>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-body">
                    <table class="table" id="gift-table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">First Name</th>
                                <th class="text-center">Last Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Last Login</th>
                                <th class="text-center">Register At</th>
                                {{-- <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td class="text-center">{{ $key + 1}}</td>
                                    <td class="text-center">{{ $user->first_name }}</td>
                                    <td class="text-center">{{ $user->last_name }}</td>
                                    <th class="text-center">{{ $user->email }}</th>
                                    <th class="text-center">{{ $user->phone }}</th>
                                    <th class="text-center">{{ \Carbon\Carbon::parse($user?->last_login)->format('Y M d, h:i') }}</th>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($user?->created_at)->format('Y M d, h:i') }}</td>
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
