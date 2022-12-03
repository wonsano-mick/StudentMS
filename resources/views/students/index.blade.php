@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Students')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Students</h6>
            </div>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('students.create') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-success shadow h-100"><i
                        class="fas fa-user fa-sm text-white-50"></i> Add New Student</a>
                <a href="{{ route('graduates.index') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-danger shadow h-100"><i
                        class="fas fa-users fa-sm text-white-50"></i> Graduate Students</a>
                {{-- <a href="{{ 'finance/new-admission' }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow h-100"><i
                        class="fas fa-school fa-sm text-white-50"></i> New Admission</a> --}}
            </div>
        </div>

        <div class="card-body shadow">
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
                            @if (count($Students) !== null)
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
                        @foreach ($Students as $Student)
                            <tr>
                                <td>
                                    <a href="{{ route('students.profile', $Student->student_id) }}">
                                        <img src="{{ !empty($Student->student_image) ? url('images/students/' . $Student->student_image) : url('images/students/avatar.png') }}"
                                            alt="" height="40" width="40" class="rounded-circle">
                                        {{ ucwords($Student->sur_name) . ' ' . ucwords($Student->other_names) }}
                                    </a>
                                </td>
                                <td>{{ $Student->gender }}</td>
                                <td>{{ $Student->current_class }}</td>
                                <td>{{ $Student->mobile_number }}</td>
                                <td>
                                    <a href="{{ route('students.profile', $Student->student_id) }}"
                                        class="btn btn-sm btn-primary mb-2"><i class="fas fa-eye"></i> Details</a>
                                </td>
                                <td>
                                    <a href="{{ route('students.edit', $Student->student_id) }}"
                                        class="btn btn-sm btn-warning mb-2"><i class="fas fa-edit"></i> Update</a>
                                </td>
                                <td>
                                    <a href="{{ url('students/confirmDelete/' . $Student->student_id) }}"
                                        class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                        Delete</a>
                                    {{-- <form method="POST"
                                        action="{{ url('students/' . $Student->student_id . '/delete') }}">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm"
                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                        {{-- @else
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><strong>No Student Registered</strong></div> --}}
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
