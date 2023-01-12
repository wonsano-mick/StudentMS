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
    {{-- <link rel="icon" href="images/{{ $SchoolInfoExist->logo_of_school }}"/> --}}
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

    {{-- DataTables --}}
    <link rel="stylesheet" href="{{ asset('frontend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('frontend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- Google Fonts Ubuntu --}}
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">

    {{-- AOS Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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

            {{-- DataTables  & Plugins --}}
            <script src="{{ asset('frontend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/pdfmake/pdfmake.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/pdfmake/vfs_fonts.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('frontend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

            {{-- AdminLTE App --}}
            <script src="{{ asset('frontend/dist/js/adminlte.min.js') }}"></script>
            {{-- AdminLTE for demo purposes --}}
            <script src="{{ asset('frontend/dist/js/demo.js') }}"></script>
            <script>
                $(function() {
                    $("#example1").DataTable({
                        "responsive": true,
                        "lengthChange": false,
                        "autoWidth": false,
                        "buttons": ["copy", "excel", "pdf", "print"]
                        // "buttons": ["copy", "csv", "excel", "pdf", "print"]
                    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    // $('#example2').DataTable({
                    //     "paging": true,
                    //     "lengthChange": false,
                    //     "searching": false,
                    //     "ordering": true,
                    //     "info": true,
                    //     "autoWidth": false,
                    //     "responsive": true,
                    // });
                });
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
            </script>
            <script src="../frontend/js/SweetAlert.js"></script> --}}
            <script src="{{ asset('frontend/js/SweetAlert.js') }}"></script>
            <script type="text/javascript">
                document.getElementById('actual-btn').onchange = function(evt) {
                    var tgt = evt.target || window.event.srcElement,
                        files = tgt.files;

                    //   FileReader support
                    if (FileReader && files && files.length) {
                        var fr = new FileReader();
                        fr.onload = function() {
                            document.getElementById('showImage').src = fr.result;
                        }
                        fr.readAsDataURL(files[0]);
                    } else {
                        // fallback -- perhaps submit the input to an iframe and temporarily store
                        // them on the server until the user's session ends.
                    }
                }
            </script>
</body>
@yield('scripts_students')

</html>
