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
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}


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

</head>

<body id="page-top"
    style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif">

    {{--  Page Wrapper  --}}
    <div id="wrapper">

        {{--  Sidebar  --}}
        @include('layouts.includes.adminsidebar')
        {{--  End of Sidebar  --}}

        {{--  Content Wrapper  --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{--  Main Content  --}}
            <div id="content">

                {{--  Topbar  --}}
                @include('layouts.includes.adminnavbar')
                {{-- <!-- Topbar --> --}}
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

            {{-- DataTable plugins --}}
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

            {{-- SweetAlert --}}
            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script> --}}
            <script src="{{ asset('frontend/js/SweetAlert.js') }}"></script>

            <script type="text/javascript">
                $('#summernote').summernote({
                    height: 200
                });
            </script>
            <script type="text/javascript">
                $('.show_confirm').click(function(event) {
                    var form = $(this).closest("form");
                    var name = $(this).data("name");
                    event.preventDefault();
                    swal({
                            title: `Are you sure you want to delete this record?`,
                            text: "You won't be able to revert this!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'Cancel, Please',
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            allowOutsideClick: false
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            }
                        });
                });
            </script>

            {{-- Select2 JS --}}
            <script src="{{ asset('frontend/vendor/js/select2.min.js') }}"></script>
            {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

</body>

</html>
