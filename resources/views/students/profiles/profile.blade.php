@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Student Profile')
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">
        @include('sweetalert::alert')
        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button type="button"
                        class="close" data-dismiss="alert" aria-label="Close" <span
                        aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
            @endforeach
        @endif
        {{-- student Profile --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 student-vr">
                        <div class="row">
                            <div class="col-lg-2">
                                <img src="{{ !empty($StudentData->student_image) ? url('images/students/' . $StudentData->student_image) : url('images/students/avatar.png') }}"
                                    width="80" height="80" alt="" class="rounded-circle">
                            </div>
                            <div class="col-lg-10">
                                <span
                                    style="font-size: 20px">{{ Str::title($StudentData->sur_name . ' ' . $StudentData->other_names) }}</span><br><br>
                                <span style="font-weight: bold">Student ID: {{ $StudentData->student_id }}</span><br>
                                <span style="font-weight:bold" class="student-profile">Class:
                                    {{ $StudentData->actual_class }}</span><br>
                                {{-- <span style="font-weight:bold" class="student-profile">Position:
                                    {{ $StudentSchoolData->school_position }}</span><br> --}}
                                <span class="student-profile">Date of Admission:
                                    {{ date('d M Y', strtotime($StudentData->date_of_admission)) }}</span>
                            </div>
                        </div><br>
                        <a href="{{ route('students.edit', $StudentData->student_id) }}"
                            class="btn btn-md btn-warning mb-2"><i class="fas fa-edit"></i> Update Details</a>
                        <a href="{{ route('students.print', $StudentData->student_id) }}" target="_blank"
                            class="btn btn-md btn-primary mb-2"><i class="fas fa-print"></i> Print
                            Details</a>
                        <a href="{{ url('students/confirmDelete/' . $StudentData->student_id) }}"
                            class="float-right"><button type="submit" class="btn btn-md btn-danger btn-flat"><i
                                    class="fas fa-trash"></i> Delete</button></a>
                        {{-- <form method="POST" action="{{ route('students.delete', $StudentData->id) }}" class="float-right">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-md btn-danger btn-flat show_confirm" data-toggle="tooltip"
                                title='Delete'><i class="fas fa-trash"></i> Delete</button>
                        </form> --}}
                    </div>
                    <div class="col-lg-6">
                        <span style="font-weight: bold">Birthay:</span><span
                            class="student-info-3">{{ date('d M', strtotime($StudentData->date_of_birth)) }}</span><br>
                        <span style="font-weight: bold">Gender:</span><span
                            class="student-info-5">{{ $StudentData->gender }}</span><br>
                        <span style="font-weight: bold">Address:</span><span
                            class="student-info-4">{{ $StudentData->residential_address }}</span><br>
                        <span style="font-weight: bold">Guardian's Name:</span><span
                            class="student-personal-info-7 student-text">{{ ucwords($StudentParentData->name_of_guardian) }}</span><br>
                        <span style="font-weight: bold">Mobile Number:</span><span
                            class="student-personal-info-8 student-text">{{ $StudentParentData->mobile_number }}</span><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Personal Information</p>
                        <span style="font-weight: bold">Religion:</span><span
                            class="student-personal-info-1 student-text">{{ $StudentData->religion }}</span><br>
                        <span style="font-weight: bold">Denomination:</span><span
                            class="student-personal-info-2 student-text">{{ $StudentData->denomination }}</span><br>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Parents Information</p>
                        <span style="font-weight: bold">Father's Name:</span><span
                            class="student-personal-info-6 student-text">{{ $StudentParentData->name_of_father }}</span><br>
                        <span style="font-weight: bold">Mobile Number:</span><span
                            class="student-personal-info-2 student-text">{{ $StudentParentData->father_mobile_number }}</span><br>
                        <span style="font-weight: bold">Father's Occupation:</span><span
                            class="student-personal-info-4 student-text">{{ $StudentParentData->father_occupation }}</span><br>
                        <span style="font-weight: bold">Mother's Name:</span><span
                            class="student-personal-info-2 student-text">{{ $StudentParentData->name_of_mother }}</span><br>
                        <span style="font-weight: bold">Mobile Number:</span><span
                            class="student-personal-info-2 student-text">{{ $StudentParentData->mother_mobile_number }}</span><br>
                        <span style="font-weight: bold">Mother's Occupation:</span><span
                            class="student-personal-info-5 student-text">{{ $StudentParentData->mother_occupation }}</span><br>
                    </div>
                    <div class="col-lg-4">
                        <button type="button" data-toggle="modal" data-target="#editParents"
                            class="btn btn-md btn-warning">Update</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">School Position(s) Held</p>
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (count($StudentPositions) !== null)
                                            <th>Position</th>
                                            <th>Class</th>
                                            <th>Year</th>
                                            <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentPositions as $StudentPosition)
                                        <tr>
                                            <td>{{ $StudentPosition->position }}</td>
                                            <td>{{ $StudentPosition->current_class }}</td>
                                            <td>{{ $StudentPosition->year }} </td>
                                            <td>
                                                <a href="{{ url('students/positions/delete', $StudentPosition->id) }}"
                                                    class="text-primary">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" data-toggle="modal" data-target="#addPositionInfo"
                                class="btn btn-md btn-success">Add Position</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Scholarship Information</p>
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (count($StudentScholarship) !== null)
                                            <th>Scholarship Name</th>
                                            <th>Status</th>
                                            <th>Duration</th>
                                            <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentScholarship as $Scholarship)
                                        <tr>
                                            <td>{{ $Scholarship->scholarship_name }}</td>
                                            <td>{{ $Scholarship->scholarship_status }}</td>
                                            <td>{{ $Scholarship->start_year }} - {{ $Scholarship->end_year }}</td>
                                            <td>
                                                <a href="{{ url('students/scholarship/delete/' . $Scholarship->id) }}"
                                                    class="text-primary">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" data-toggle="modal" data-target="#addScholarshipInfo"
                                class="btn btn-md btn-success">Add Scholarship</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Sporting Information</p>
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (count($StudentSportsData) !== null)
                                            <th>Sports Name</th>
                                            <th>Discipline</th>
                                            <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentSportsData as $SportsData)
                                        <tr>
                                            <td>{{ $SportsData->sports_academy }}</td>
                                            <td>{{ $SportsData->sports_discipline }}</td>
                                            <td>
                                                <a href="{{ url('students/sports/delete/' . $SportsData->id) }}"
                                                    class="text-primary">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" data-toggle="modal" data-target="#addSportsInfo"
                                class="btn btn-md btn-success">Add Sports Discipline</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Certificate Information</p>
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (count($StudentCertificate) !== null)
                                            <th>Certificate Name</th>
                                            <th>Awarding Institution</th>
                                            <th>Date</th>
                                            <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentCertificate as $Certificate)
                                        <tr>
                                            <td>{{ $Certificate->certificate_name }}</td>
                                            <td>{{ $Certificate->awarding_institution }}</td>
                                            <td>{{ $Certificate->date_of_award }} </td>
                                            <td>
                                                <a href="{{ url('students/certificate/delete', $Certificate->id) }}"
                                                    class="text-primary">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" data-toggle="modal" data-target="#addCertifivateInfo"
                                class="btn btn-md btn-success">Add Certificate</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Club/Society Information</p>
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (count($StudentClubs) !== null)
                                            <th>Club/Society Name</th>
                                            <th>Position</th>
                                            <th>Year</th>
                                            <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentClubs as $Club)
                                        <tr>
                                            <td>{{ $Club->name_of_club }}</td>
                                            <td>{{ $Club->position }}</td>
                                            <td>{{ $Club->year }} </td>
                                            <td>
                                                <a href="{{ url('students/clubs/delete', $Club->id) }}"
                                                    class="text-primary">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <button type="button" data-toggle="modal" data-target="#addClubInfo"
                                class="btn btn-md btn-success">Add Club/Society</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="border-bottom-info">Former School Information</p>
                        @if ($StudentLastSchool !== null)
                            <span style="font-weight: bold">Name of School:</span><span
                                class="student-personal-info-4 student-text">{{ $StudentLastSchool->last_school_attended }}</span><br>
                            <span style="font-weight: bold">Date of Exit:</span><span
                                class="student-personal-info-2 student-text">{{ date('d-M-Y', strtotime($StudentLastSchool->date_of_last_school_exit)) }}</span><br>
                            <span style="font-weight: bold">Reason for Exit:</span><span
                                class="student-personal-info-5 student-text">{{ $StudentLastSchool->reason_for_exit }}</span><br>
                            <div class="col-lg-6 mt-3">
                                <button type="button" data-toggle="modal" data-target="#editLastSchool"
                                    class="btn btn-md btn-warning">Update Details</button>
                            </div>
                        @else
                            <div class="col-lg-6">
                                <button type="button" data-toggle="modal" data-target="#addLastSchool"
                                    class="btn btn-md btn-warning">Add Details</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}

    {{-- Add Student Sports Information Modal Starts --}}
    <div class="modal fade" id="addSportsInfo" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/sports/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Sports Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>
                                <input class="form-control" type="text" name="name_of_student"
                                    value="{{ $StudentData->surname . ' ' . $StudentData->other_names }}" hidden>
                                <input class="form-control" type="text" name="current_class"
                                    value="{{ $StudentData->actual_class }}" hidden>

                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                            Sports</span>
                                    </div>
                                    <input class="form-control" type="text" name="name_of_sports"
                                        placeholder="Enter Name of Sports" value="{{ old('name_of_sports') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Sports
                                            Discipline</span>
                                    </div>
                                    <input class="form-control" type="text" name="sports_discipline"
                                        value="{{ old('sports_discipline') }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student Sports Information Modal Ends --}}

    {{-- Add Student Scholarship Information Modal Starts --}}
    <div class="modal fade" id="addScholarshipInfo" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/scholarship/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Scholarship Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>
                                <input class="form-control" type="text" name="name_of_student"
                                    value="{{ $StudentData->sur_name . ' ' . $StudentData->other_names }}" hidden>
                                <input class="form-control" type="text" name="current_class"
                                    value="{{ $StudentData->actual_class }}" hidden>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Scholarship
                                            Type</span>
                                    </div>
                                    <select class="form-control" name="scholarship_name" style="font-size:20px;">
                                        <option value="{{ old('scholarship_name') }}" style="font-size:20px;">
                                            {{ old('scholarship_name') }}</option>
                                        @foreach ($Scholarships as $Scholarship)
                                            <option value="{{ $Scholarship->scholarship }}" style="font-size:20px;">
                                                {{ $Scholarship->scholarship }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Description</span>
                                    </div>
                                    <input class="form-control" type="text" name="description"
                                        placeholder="Brief Description of Scholarship" value="{{ old('description') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Scholarship
                                            Status</span>
                                    </div>
                                    <select class="form-control" name="scholarship_status"
                                        value="{{ old('scholarship_status') }}" style="font-size:20px;">
                                        <option value="{{ old('scholarship_status') }}" style="font-size:20px;">
                                            {{ old('scholarship_status') }}</option>
                                        <option value="Full" style="font-size:20px;">Full</option>
                                        <option value="Partial" style="font-size:20px;">Partial</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Start
                                            Year</span>
                                    </div>
                                    <input class="form-control" type="text" name="start_year"
                                        placeholder="Enter Starting Year" value="{{ old('start_year') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">End
                                            Year</span>
                                    </div>
                                    <input class="form-control" type="text" name="end_year"
                                        placeholder="Enter Ending Year" value="{{ old('end_year') }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student Scholarship Information Modal Ends --}}

    {{-- Add Student Certificates Information Modal Starts --}}
    <div class="modal fade" id="addCertifivateInfo" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/certificate/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Certificate Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>
                                <input class="form-control" type="text" name="name_of_student"
                                    value="{{ $StudentData->sur_name . ' ' . $StudentData->other_names }}" hidden>

                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                            Certificate</span>
                                    </div>
                                    <input class="form-control" type="text" name="certificate_name"
                                        placeholder="Enter Name of Certificate" value="{{ old('certificate_name') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Awarding
                                            Institution</span>
                                    </div>
                                    <input class="form-control" type="text" name="awarding_institution"
                                        placeholder="Enter Name of Awarding Institution"
                                        value="{{ old('awarding_institution') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Date of
                                            Award</span>
                                    </div>
                                    <input class="form-control" type="date" name="date_of_award"
                                        placeholder="Enter Date of Award" value="{{ old('date_of_award') }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student Certificate Information Modal Ends --}}

    {{-- Add Student Parents Information Modal Starts --}}
    <div class="modal fade" id="editParents" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/parents/edit', $StudentData->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Sports Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>

                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                            Father</span>
                                    </div>
                                    <input class="form-control" type="text" name="name_of_father"
                                        value="{{ $StudentParentData->name_of_father }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Mobile
                                            No.</span>
                                    </div>
                                    <input class="form-control" type="text" name="father_mobile_number"
                                        value="{{ $StudentParentData->father_mobile_number }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Occupation</span>
                                    </div>
                                    <input class="form-control" type="text" name="father_occupation"
                                        value="{{ $StudentParentData->father_occupation }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Mother's
                                            Name</span>
                                    </div>
                                    <input class="form-control" type="text" name="name_of_mother"
                                        value="{{ $StudentParentData->name_of_mother }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Mobile
                                            No.</span>
                                    </div>
                                    <input class="form-control" type="text" name="mother_mobile_number"
                                        value="{{ $StudentParentData->mother_mobile_number }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Occupation</span>
                                    </div>
                                    <input class="form-control" type="text" name="mother_occupation"
                                        value="{{ $StudentParentData->mother_occupation }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student Parents Information Modal Ends --}}

    {{-- Add Student Last School Information Modal Starts --}}
    <div class="modal fade" id="addLastSchool" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/lastSchool/create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Last School Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>
                                <input class="form-control" type="text" name="name_of_student"
                                    value="{{ $StudentData->sur_name . ' ' . $StudentData->other_names }}" hidden>

                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                            Last School</span>
                                    </div>
                                    <input class="form-control" type="text" name="last_school_attended"
                                        placeholder="Enter Last School Name">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Date of
                                            Exit</span>
                                    </div>
                                    <input class="form-control" type="date" name="date_of_last_school_exit">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Reason
                                            for exit</span>
                                    </div>
                                    <input type="text" name="reason_for_exit" class="form-control" id="">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student Last School Information Modal Ends --}}

    @if ($StudentLastSchool !== null)
        <div class="modal fade" id="editLastSchool" role="dialog">
            <div class="modal-dialog">
                {{-- Modal content --}}
                <div class="modal-content">
                    <div class="modal-header text-center card-header text-black">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('students/lastSchool/edit/' . $StudentData->student_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="card">
                            <div class="card-header text-white-50 bg-dark text-center">
                                <h2 class="card-title text-center">Last School Information Form</h2>
                            </div>
                            <div class="card-body text-dark">
                                <div class="row">
                                    <input class="form-control" type="text" name="student_id"
                                        value="{{ $StudentData->student_id }}" hidden>

                                    <div class="input-group">
                                        <div class="input-group-prepend mb-3">
                                            <span class="input-group-text bg-primary text-white" style="width:150px;">Name
                                                of
                                                Last School</span>
                                        </div>
                                        <input class="form-control" type="text" name="last_school_attended"
                                            value="{{ $StudentLastSchool->last_school_attended }}">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend mb-3">
                                            <span class="input-group-text bg-primary text-white"
                                                style="width:150px;">Mobile
                                                No.</span>
                                        </div>
                                        <input class="form-control" type="text" name="date_of_last_school_exit"
                                            value="{{ $StudentLastSchool->date_of_last_school_exit }}">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend mb-3">
                                            <span class="input-group-text bg-primary text-white"
                                                style="width:150px;">Reason for Exit</span>
                                        </div>
                                        <input class="form-control" type="text" name="reason_for_exit"
                                            value="{{ $StudentLastSchool->reason_for_exit }}">
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <button type="button" class="btn btn-danger btn-lg btn-block"
                                            data-dismiss="modal">
                                            <i class="fas fa-times"></i> Close</button>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                                class="fas fa-check"></i> Submit </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- Add Student Club/Society Information Modal Starts --}}
    <div class="modal fade" id="addClubInfo" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/clubs/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Club/Society Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>
                                <input class="form-control" type="text" name="name_of_student"
                                    value="{{ $StudentData->sur_name . ' ' . $StudentData->other_names }}" hidden>
                                <input class="form-control" type="text" name="current_class"
                                    value="{{ $StudentData->actual_class }}" hidden>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                            Club</span>
                                    </div>
                                    <select class="form-control" name="name_of_club" style="font-size:20px;">
                                        <option value="{{ old('name_of_club') }}" style="font-size:20px;">
                                            {{ old('name_of_club') }}</option>
                                        @foreach ($Clubs as $Club)
                                            <option style="font-size:20px;" value="{{ $Club->club }}">
                                                {{ $Club->club }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Position</span>
                                    </div>
                                    <input class="form-control" type="text" name="position"
                                        placeholder="Enter Position Held: e.g Member, President..."
                                        value="{{ old('position') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Year</span>
                                    </div>
                                    <input class="form-control" type="text" name="year" placeholder="Enter Year"
                                        value="{{ old('year') }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student Club Information Modal Ends --}}

    {{-- Add Student School Position Information Modal Starts --}}
    <div class="modal fade" id="addPositionInfo" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('students/positions/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">School Position Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <input class="form-control" type="text" name="student_id"
                                    value="{{ $StudentData->student_id }}" hidden>
                                <input class="form-control" type="text" name="name_of_student"
                                    value="{{ $StudentData->sur_name . ' ' . $StudentData->other_names }}" hidden>
                                <input class="form-control" type="text" name="current_class"
                                    value="{{ $StudentData->actual_class }}" hidden>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Position</span>
                                    </div>
                                    <input class="form-control" type="text" name="position"
                                        placeholder="Enter Position Held: e.g Member, President..."
                                        value="{{ old('position') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Class</span>
                                    </div>
                                    <input class="form-control" type="text" name="class" placeholder="Enter Class"
                                        value="{{ old('class') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Year</span>
                                    </div>
                                    <input class="form-control" type="text" name="year" placeholder="Enter Year"
                                        value="{{ old('year') }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Submit </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Student School Position Information Modal Ends --}}
@endsection
