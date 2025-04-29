<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @yield('meta')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/auth_assets/style.css') }}" />
    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"
        media="screen">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.0/dist/jquery.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">

</head>

<body>
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="main-logo">
                        <a href="https://wishify.com.au/">
                            <img src="https://wishify.com.au/wp-content/uploads/2024/08/Wishify-Logo.png"
                                alt="">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav class="header-menu">
                        <ul>
                            <li><a href="https://wishify.com.au/">Home</a></li>
                            <li><a href="https://wishify.com.au/about/">About</a></li>
                            <li><a href="https://wishify.com.au/faqs/">FAQ's</a></li>
                            <li><a href="https://wishify.com.au/contact-us/">Contact Us</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-md-3">
                    <div class="header-btn">
                        @if (!Auth::check())
                            <a href="{{ route('register') }}" class="registerr">Register</a>
                            <a href="{{ route('login') }}" class="loginn">Login</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="registerr">Dashboard</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div>

        @yield('content')

    </div>


    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="main-logo">
                        <a href="">
                            <img src="https://wishify.com.au/wp-content/uploads/2024/08/Wishify-Logo.png"
                                alt="">
                        </a>
                        <p>wishify is the new and improved way of allowing guests to gift money for any event. Allows
                            the host, to receive money gifts in a convenient, secure, and environmentally friendly way
                        </p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-list">
                        <h5>Quick Links</h5>
                        <ul>
                            <li><a href="https://wishify.com.au/">Home</a></li>
                            <li><a href="https://wishify.com.au/about/">About</a></li>
                            <li><a href="https://wishify.com.au/faqs/">FAQ's</a></li>
                            <li><a href="https://wishify.com.au/contact-us/">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="footer-list">
                        <h5>Hosts</h5>
                        <ul>
                            @if (!Auth::check())
                                <li><a href="{{ route('register') }}">Register</a></li>
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @endif
                            
                            <li><a href="https://wishify.com.au/terms-conditions/">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-list">
                       <!-- <h5>Stay in touch</h5>
                        <form action="">
                            <input type="email" class="form-control" placeholder="Enter Your Email...">
                            <input type="submit" value="SUMBIT" id="footer_send">
                        </form> -->
                        <img src="https://wishify.com.au/wp-content/uploads/2024/08/image-21.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <p class="footer-last">Copyright © 2024 | UniquelogoDesign | All Rights Reserved</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>



    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        @if (Session::has('message'))
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (Session::has('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @foreach (session('flash_notification', collect())->toArray() as $message)
            console.log("{{ $message['level'] }}");
            if ("{{ $message['level'] }}" == 'danger') {
                toastr.error("{{ $message['message'] }}");
            }
            toastr["{{ $message['level'] }}"]("{{ $message['message'] }}")
        @endforeach
    </script>
</body>

</html>
