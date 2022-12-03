<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0">

    <title>@yield('title', '')</title>

    {{-- <link rel="icon" href="{!! asset('images/wks_icon.JPG') !!}"/> --}}
    @php
        $SchoolInfoExist = App\Models\SchoolInfo::first();
    @endphp
    <link rel="icon" href="{{ asset('images/' . $SchoolInfoExist->logo_of_school) }}" />

    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- Styles --}}
    {{-- <link href="{{ mix('css/app.css') }}" rel="stylesheet">  --}}

    {{-- Custom fonts for this template --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="{{ asset('fontawesome/css/fontawesome-main.css') }}" rel="stylesheet">

    {{-- Custom styles for this template --}}
    <link href="{{ asset('frontend/vendor/css/sb-admin-2.min.css') }}" rel="stylesheet">
    {{-- Bootstrap core CSS --}}
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    {{-- Material Design Bootstrap --}}
    <link href="{{ asset('frontend/css/mdb.min.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('frontend/css/myStyle.css') }}" rel="stylesheet">

    {{-- Google Fonts Ubuntu --}}
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    {{-- AOS Library --}}
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}
    <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet">
    <style>
        .login-register-btn {
            font-size: 30px;
            color: #fff;
            line-height: 1.2;
            text-transform: uppercase;
            display: -webkit-box;
            display: -webkit-flex;
            display: -moz-box;
            display: -ms-flexbox;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 20px;
            width: 100%;
            height: 60px;
            border-radius: 40px !important;
            overflow: hidden;
            background: #0275d8;
            opacity: .8;
            border: 0;
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
            position: relative;
            z-index: 1;
        }

        .login-register-btn::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -1;
            width: 100%;
            height: 100%;
            opacity: 0;
            background: #2575fc;
            background: -webkit-linear-gradient(left, #6a11cb, #2575fc);
            background: -o-linear-gradient(left, #6a11cb, #2575fc);
            background: -moz-linear-gradient(left, #6a11cb, #2575fc);
            background: linear-gradient(left, #6a11cb, #2575fc);
            -webkit-transition: all 0.4s;
            -o-transition: all 0.4s;
            -moz-transition: all 0.4s;
            transition: all 0.4s;
        }

        .login-register-btn:hover {
            background-color: transparent;
        }

        .login-register-btn:hover:before {
            opacity: 1;
        }

        .login-register-btn:focus {
            outline: none;
        }

        .login-main {
            top: 50%;
            left: 50%;
            position: fixed;
            -webkit-transform: translate(-50%);
            transform: translate(-50%);
        }
    </style>
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=61cb81eacd90e100193cce65&product=inline-share-buttons'
        async='async'></script>
    <script type="text/javascript" language="javascript">
        var idleMax = 5; // Logout after 30 minutes of IDLE
        var idleTime = 0;

        var idleInterval = setInterval("timerIncrement()", 60000); // 1 minute interval    
        $("body").mousemove(function(event) {
            idleTime = 0; // reset to zero
        });

        // count minutes
        function timerIncrement() {
            idleTime = idleTime + 1;
            if (idleTime > idleMax) {
                window.location.href = "{{ url('idleLogout') }}"
            }
        }
    </script>
</head>

<body style="background: #3bb9ff; opacity: 1; font-sans">

    <div id="app">

        @yield('content')
    </div>

    {{--  Bootstrap core JavaScript --}}
    <script src="{{ asset('frontend/vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Core plugin JavaScript --}}
    <script src="{{ asset('frontend/vendor/js/jquery.easing.min.js') }}"></script>

    {{-- Custom scripts for all pages --}}
    <script src="{{ asset('frontend/vendor/js/sb-admin-2.min.js') }}"></script>

    {{-- <AOS Script --}}
    {{-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> --}}
    <script src="{{ asset('frontend/js/aos.js') }}"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>
