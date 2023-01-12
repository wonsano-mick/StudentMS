@extends('layouts.includes.app')
@section('title', 'SMS | Contact')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Main Content --}}
    <div class="container">
        {{-- Student Population --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-10 offset-1 col-lg-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <div class="mb-2">
                                <p class="text-center text-uppercase" style="font-size: 2em;">Contact me on</p>
                                <div class="row">
                                    <div class="col-md-6 shadow">
                                        <p class="text-center text-uppercase">social media</p>
                                        <p><i class="fas fa-facebook fa-lg"></i> michaelwonsano</p>
                                        <p><i class="fas fa-telegram fa-lg"></i> wonsano</p>
                                        <p><i class="fas fa-whatsapp fa-lg"></i> +233243877994</p>
                                    </div>
                                    <div class="col-md-6 shadow">
                                        <p class="text-center text-uppercase">Contact</p>
                                        <p>Mobile Number : +233206646949</p>
                                        <p>Phone Number : +233243877994</p>
                                        <p>Email Address : ofosuachmick@yahoo.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-center text-uppercase" style="font-size: 2em;">for the following</p>
                                <div class="shadow">
                                    <p class="text-center text-uppercase">management systems</p>
                                    <div class="ml-4">
                                        <p>School Fees Management System</p>
                                        <p>Students Management System</p>
                                        <p>Employee Management System</p>
                                        <p>Point of Sales Management System</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /.container-fluid --}}
    </div>
    {{-- End of Main Content --}}
@endsection
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,height=device-height,initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', '')</title>
    @php
        $SchoolInfoExist = App\Models\SchoolInfo::first();
    @endphp
    <link rel="icon" href="{{ asset('images/' . $SchoolInfoExist->logo_of_school) }}" />

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

    {{-- Custom styles for this page --}}
    <link href="{{ asset('frontend/vendor/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- Google Fonts Ubuntu --}}
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    {{-- AOS Library --}}
    {{-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> --}}
    <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet">

    {{-- Select2 CSS  --}}
    <link href="{{ asset('frontend/vendor/css/select2.min.css') }}" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <script type='text/javascript'
        src='https://platform-api.sharethis.com/js/sharethis.js#property=61cb81eacd90e100193cce65&product=inline-share-buttons'
        async='async'></script>
    <style>
        .reg-bg {
            background-color: rgba(72, 164, 236, 0.5);
        }

        .student-profile {
            font-size: 80%;
            color: #6c757d;
        }

        .student-text {
            color: #6c757d;
        }

        .student-info {
            margin-left: 50px;
        }

        .student-info-1 {
            margin-left: 45px;
        }

        .student-info-2 {
            margin-left: 120px;
            color: #6c757d;
        }

        .student-info-3 {
            margin-left: 105px;
            color: #6c757d;
        }

        .student-info-4 {
            margin-left: 98px;
            color: #6c757d;
        }

        .student-info-5 {
            margin-left: 105px;
            color: #6c757d;
        }

        .student-info-6 {
            margin-left: 82px;
            color: #6c757d;
        }

        .student-info-7 {
            margin-left: 75px;
            color: #6c757d;
        }

        .student-personal-info {
            margin-left: 80px;
        }

        .student-personal-info-1 {
            margin-left: 103px;
        }

        .student-personal-info-2 {
            margin-left: 58px;
        }

        .student-personal-info-3 {
            margin-left: 50px;
        }

        .student-personal-info-4 {
            margin-left: 18px;
        }

        .student-personal-info-5 {
            margin-left: 14px;
        }

        .student-personal-info-6 {
            margin-left: 60px;
        }

        .student-personal-info-7 {
            margin-left: 30px;
        }

        .student-personal-info-8 {
            margin-left: 45px;
        }

        .student-emergency {
            margin-left: 30px;
        }

        .student-emergency-1 {
            margin-left: 135px;
        }

        .student-emergency-2 {
            margin-left: 115px;
        }

        .student-emergency-3 {
            margin-left: 111px;
        }

        .student-bank-info {
            margin-left: 111px;
        }

        .student-bank-info-1 {
            margin-left: 25px;
        }

        .student-bank-info-2 {
            margin-left: 145px;
        }

        .student-education-info {
            margin-left: 50px;
        }

        .student-education-info-1 {
            margin-left: 100px;
        }

        .student-education-info-2 {
            margin-left: 100px;
        }

        .student-education-info-3 {
            margin-left: 75px;
        }

        .student-salary {
            margin-left: 30px;
        }

        .student-salary-1 {
            margin-left: 70px;
        }

        .student-salary-2 {
            margin-left: 160px;
        }

        .student-vr {
            border-right: 2px dashed #333;
        }

        .student-info-1 {
            margin-left: 95px;
            color: #6c757d;
        }

        .student-info-2 {
            margin-left: 98px;
            color: #6c757d;
        }

        .student-info-3 {
            margin-left: 105px;
            color: #6c757d;
        }

        .student-guardian-info {
            margin-left: 80px;
        }

        .student-guardian-info-1 {
            margin-left: 30px;
        }

        .student-parent {
            margin-left: 120px;
        }

        .student-parent-1 {
            margin-left: 70px;
        }

        .student-parent-2 {
            margin-left: 75px;
        }

        .student-parent-3 {
            margin-left: 95px;
        }
    </style>

</head>

<body id="page-top"
    style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">

    {{--  Page Wrapper  --}}
    <div id="wrapper">

        {{--  Content Wrapper  --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{--  Main Content  --}}
            <div id="content">
                @yield('content')
                {{--  /.container-fluid  --}}
                @include('layouts.includes.adminfooter')
            </div>

            {{--  Bootstrap core JavaScript --}}
            <script src="{{ asset('frontend/vendor/js/jquery.min.js') }}"></script>
            <script src="{{ asset('frontend/vendor/js/bootstrap.bundle.min.js') }}"></script>

            {{-- Core plugin JavaScript --}}
            <script src="{{ asset('frontend/vendor/js/jquery.easing.min.js') }}"></script>

            {{-- Custom scripts for all pages --}}
            <script src="{{ asset('frontend/vendor/js/sb-admin-2.min.js') }}"></script>

            {{-- DataTables plugins --}}
            <script src="{{ asset('frontend/vendor/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('frontend/vendor/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('frontend/vendor/js/datatables-demo.js') }}"></script>

            {{-- AOS Script --}}
            {{-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> --}}
            <script src="{{ asset('frontend/js/aos.js') }}"></script>

            {{-- Charts Scripts --}}
            <script src="{{ asset('frontend/vendor/chart/Chart.min.js') }}"></script>
            <script>
                AOS.init();
            </script>

            {{-- Fixed Navbar Script --}}
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    window.addEventListener('scroll', function() {
                        if (window.scrollY > 50) {
                            document.getElementById('navbar_top').classList.add('fixed-top');
                            // add padding top to show content behind navbar
                            navbar_height = document.querySelector('.navbar').offsetHeight;
                            document.body.style.paddingTop = navbar_height + 'px';
                        } else {
                            document.getElementById('navbar_top').classList.remove('fixed-top');
                            // remove padding top from body
                            document.body.style.paddingTop = '0';
                        }
                    });
                });
            </script>
            {{-- summernote css/js --}}
            <link href="{{ asset('summernote/summernote-0.8.18.min.css') }}" rel="stylesheet">
            <script type="text/javascript" src="{{ asset('summernote/summernote-0.8.18.min.js') }}"></script>
            <script src="{{ asset('frontend/js/SweetAlert.js') }}"></script>
</body>

</html>
