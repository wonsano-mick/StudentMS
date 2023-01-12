@extends('layouts.includes.app-home')
@section('title', $Title)
@section('content')

    @include('sweetalert::alert')
    {{-- Content Wrapper --}}
    <div id="content-wrapper" class="d-flex flex-column">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" align="center"><button type="button"
                    class="close" data-dismiss="alert" aria-label="Close" <span
                    aria-hidden="true">&times;</span></button><strong>{{ session('success') }}</strong></div>
        @endif
        {{-- Main Content --}}
        <div id="content">

            {{--  Begin Page Content --}}
            <div class="container-fluid">

                {{-- Page Heading --}}
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>
                {{-- Page Heading --}}
                {{-- Students Population Row Starts --}}
                <div class="row">
                    {{-- Males --}}
                    <div class="col-xl-4 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1200">
                        <div class="card border-left-info shadow h-100 py-2">
                            <a href="{{ route('males.population') }}">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md text-center font-weight-bold text-info text-uppercase mb-1">
                                                Total Males

                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"
                                                style="font-size: 1.5em !important">
                                                {{ $Males }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- Females --}}
                    <div class="col-xl-4 col-md-6 mb-4" data-aos="fade-left" data-aos-duration="1400">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <a href="{{ route('males.population') }}">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md text-center font-weight-bold text-info text-uppercase mb-1">
                                                Total
                                                Females

                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"
                                                style="font-size: 1.5em !important">
                                                {{ $Females }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- Total Students --}}
                    <div class="col-xl-4 col-md-6 mb-4" data-aos="fade-right" data-aos-duration="1500">
                        <div class="card border-left-success shadow h-100 py-2">
                            <a href="{{ route('males.population') }}">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-md text-center font-weight-bold text-info text-uppercase mb-1">
                                                Total
                                                Students

                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-center"
                                                style="font-size: 1.5em !important">
                                                {{ $TotalStudents }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Students Population Row Ends --}}
                {{-- Row Content --}}
                <div class="row mt-4">

                    <div class="col-xl-4 mb-2" data-aos="fade-right" data-aos-duration="2000">
                        <a href="{{ route('students.create') }}"><button
                                class="btn bg-success text-uppercase rounded text-white text-lg border-secondary"
                                style="width: 300; height: 100; font-size: 24"><i
                                    class="fas fa-user fa-lg text-white-50"></i>
                                Add New Student <span class="badge badge-primary"></span>
                            </button></a>
                    </div>

                    <div class="col-xl-4 mb-2" data-aos="fade-up" data-aos-duration="1600">
                        <a href="{{ route('term') }}"><button
                                class="btn bg-warning text-uppercase rounded text-white text-lg border-secondary"
                                style="width: 300; height: 100; font-size: 24"><i
                                    class="fas fa-calendar fa-lg text-white-50"></i>
                                Set Term/Academic Year <span class="badge badge-primary"></span>
                            </button></a>
                    </div>
                    <div class="col-xl-4 mb-2" data-aos="fade-left" data-aos-duration="2200">
                        <a href="{{ route('admissions.index') }}"><button
                                class="btn bg-info text-uppercase rounded text-white text-lg border-secondary"
                                style="width: 300; height: 100; font-size: 24"><i
                                    class="fas fa-file fa-lg text-white-50"></i>
                                Admissions<span class="badge badge-warning"></span>
                            </button>
                        </a>
                    </div>

                </div>
                {{-- Row Content --}}
                {{-- Backup Database --}}
                <div class="section-1-container section-container mt-3">
                    <div class="container">
                        <div class="row">
                            <div class="card-body shadow">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                @if (count($StudentData) !== null)
                                                    <th>Name of Student</th>
                                                    <th>Gender</th>
                                                    <th>Class</th>
                                                    <th>Mobile Number</th>
                                                    <th>View Profile</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($StudentData as $Student)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('students.profile', $Student->student_id) }}">
                                                            <img src="{{ !empty($Student->student_image) ? url('images/students/' . $Student->student_image) : url('images/students/avatar.png') }}"
                                                                alt="" height="40" width="40"
                                                                class="rounded-circle">
                                                            {{ ucwords($Student->sur_name) . ' ' . ucwords($Student->other_names) }}
                                                        </a>
                                                    </td>
                                                    <td>{{ $Student->gender }}</td>
                                                    <td>{{ $Student->current_class . '' . $Student->sub_current_class }}
                                                    </td>
                                                    <td>{{ $Student->mobile_number }}</td>
                                                    <td>
                                                        <a href="{{ route('students.profile', $Student->student_id) }}"
                                                            class="btn btn-sm btn-primary mb-2"><i class="fas fa-eye"></i>
                                                            Details</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('students.edit', $Student->student_id) }}"
                                                            class="btn btn-sm btn-warning mb-2"><i class="fas fa-edit"></i>
                                                            Update</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('students/confirmDelete/' . $Student->student_id) }}"
                                                            class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                                            Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div
                                class="col-10 offset-1 col-lg-8 offset-lg-2 d-flex justify-content-center align-items-center mb-4 mt-4">
                                <form class="" action="{{ url('backup-database') }}">
                                    <div class="input-group">
                                        <div class="input-group-append">
                                            <a><button
                                                    class="btn bg-danger text-uppercase rounded text-white text-lg border-secondary"
                                                    style="width: 300; height: 100; font-size: 24" data-aos="fade-in"
                                                    data-aos-duration="2000">
                                                    Back Up Database <span class="badge badge-warning"></span>
                                                </button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--  container-fluid --}}
        </div>
        {{--  End of Main Content --}}
    </div>
    {{--  End of Content Wrapper --}}
    </div>
    {{--  End of Page Wrapper --}}

@endsection
