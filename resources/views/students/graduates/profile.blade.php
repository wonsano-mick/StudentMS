@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Student Profile')
@section('content')
    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">
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
                                <span style="font-weight:bold; color: red;">Student Status:
                                    {{ $StudentData->current_class }}</span><br>
                                {{-- <span style="font-weight:bold" class="student-profile">Position Held:
                                    {{ $StudentSchoolData->school_position }}</span><br> --}}
                                <span class="student-profile">Date of Admission:
                                    {{ date('d-M Y', strtotime($StudentData->date_of_admission)) }}</span><br>
                                <span class="student-profile">Year Completed:
                                    {{ date('d-M Y', strtotime($StudentData->year_completed)) }}</span>
                            </div>
                        </div>
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
                        <p class="border-bottom-info">School Position(s) Held</p>
                        <div class="table-responsive">
                            <table class="table" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        @if (count($StudentPositions) !== null)
                                            <th>Position</th>
                                            <th>Class</th>
                                            <th>Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentPositions as $StudentPosition)
                                        <tr>
                                            <td>{{ $StudentPosition->position }}</td>
                                            <td>{{ $StudentPosition->current_class }}</td>
                                            <td>{{ $StudentPosition->year }} </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
        </div>
        <div class="row">
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentScholarship as $Scholarship)
                                        <tr>
                                            <td>{{ $Scholarship->scholarship_type }}</td>
                                            <td>{{ $Scholarship->scholarship_status }}</td>
                                            <td>{{ $Scholarship->start_year }} - {{ $Scholarship->end_year }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentSportsData as $SportsData)
                                        <tr>
                                            <td>{{ $SportsData->sports_academy }}</td>
                                            <td>{{ $SportsData->sports_discipline }}</td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($StudentCertificate as $Certificate)
                                        <tr>
                                            <td>{{ $Certificate->certificate_name }}</td>
                                            <td>{{ $Certificate->awarding_institution }}</td>
                                            <td>{{ $Certificate->date_of_award }} </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}
@endsection
