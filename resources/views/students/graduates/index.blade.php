@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Graduates')
@section('content')
    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Graduates</h6>
            </div>
        </div>
        <div class="card-body">
            @if ($errors)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                            type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                            aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                @endforeach
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            @if (count($GraduateStudents) !== null)
                                <th>S/N</th>
                                <th>Name of Student</th>
                                <th>Gender</th>
                                <th>Name of Guardian</th>
                                <th>Mobile Number</th>
                                <th>Date Graduated</th>
                                <th>Profile</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($GraduateStudents as $key => $GraduateStudent)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ ucwords($GraduateStudent->sur_name . ' ' . ucwords($GraduateStudent->other_names)) }}
                                </td>
                                <td>{{ $GraduateStudent->gender }}</td>
                                <td>{{ $GraduateStudent->guardian_name }}</td>
                                <td>{{ $GraduateStudent->mobile_number }}</td>
                                <td>{{ $GraduateStudent->year_completed }}</td>
                                <td>
                                    <a href="{{ route('graduates.profile', $GraduateStudent->student_id) }}"
                                        class="btn btn-sm btn-primary mb-2"><i class="fas fa-eye"></i> Details</a>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @else
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><strong>No Past Students</strong></div> --}}
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}
@endsection
