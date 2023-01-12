@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | New Admission')
@section('content')
    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All New Admissions</h6>
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" data-toggle="modal" data-target="#newAdmission"
                            class="btn btn-md btn-success">Add New Admission</button>
                    </div>
                    <div class="col-md-6 offset-col-3">
                        <a href="{{ route('admissions.archive') }}" class="float-right"><button
                                class="btn btn-md btn-info btn-flat"><i class="fas fa-archive"></i>
                                Admission Archives</button></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($NewAdmissions) !== null)
                                    <th>S/N</th>
                                    <th>Name of Student</th>
                                    <th>Admission Number</th>
                                    <th>Class</th>
                                    <th>Reporting Date</th>
                                    <th>Admission Letter</th>
                                    <th>Register Student</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($NewAdmissions as $key => $NewAdmission)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $NewAdmission->sur_name . ' ' . $NewAdmission->other_names }}</td>
                                    <td>{{ $NewAdmission->admission_number }}</td>
                                    <td>{{ $NewAdmission->class }}</td>
                                    <td>{{ date('d M Y', strtotime($NewAdmission->date_of_reporting)) }}</td>
                                    <td><a href="{{ route('admissions.print', $NewAdmission->id) }}" target="_blank"
                                            class="btn btn-sm btn-danger mb-2"><i class="fas fa-print"></i> Letter</a>
                                    </td>
                                    <td><a
                                            href="{{ route('admissions.register', $NewAdmission->id) }}"class="btn btn-sm btn-success mb-2"><i
                                                class="fas fa-plus"></i> Register</a>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}


    {{-- Add New Admission Modal Starts --}}
    <div class="modal fade" id="newAdmission" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admissions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">New Admission Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        {{-- <span class="input-group-text bg-primary text-white" style="width:160px;">Admission
                                            Number</span> --}}
                                        <span class="input-group-text bg-primary text-white" style="width:160px;">Admission
                                            Date</span>
                                    </div>
                                    {{-- @php
                                        $LastIdQuery = App\Models\NewAdmission::latest('id')->first();
                                        $Year = Str::substr(date('Y'), 2, 2);
                                        if ($LastIdQuery === null) {
                                            $Id = 1;
                                            $RandomId = random_int(100, 999);
                                            $spri_id = sprintf('%03d', $Id);
                                            $AdmissionNumber = "$Year" . "$spri_id" . "$RandomId";
                                        } else {
                                            $LastId = $LastIdQuery->id;
                                            $RandomId = random_int(100, 999);
                                            $Id = $LastId + 1;
                                            $spri_id = sprintf('%03d', $Id);
                                            $AdmissionNumber = "$Year" . "$spri_id" . "$RandomId";
                                        }
                                    @endphp
                                    <input class="form-control" type="text" name="admission_number"
                                        placeholder="Enter Class" value="{{ $AdmissionNumber }}" readonly> --}}
                                    <input class="form-control" type="date" name="date">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:160px;">Sur
                                            Name</span>
                                    </div>
                                    <input class="form-control" type="text" name="sur_name" placeholder="Enter Surname"
                                        value="{{ old('sur_name') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:160px;">Other
                                            Names</span>
                                    </div>
                                    <input class="form-control" type="text" name="other_names"
                                        placeholder="Enter Other Names" value="{{ old('other_names') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:160px;">Gender</span>
                                    </div>
                                    <div class="controls">
                                        <select class="form-control" name="gender" style="font-size:20px; width:330px;">
                                            <option value="{{ old('gender') }}" style="font-size:20px;">
                                                {{ old('gender') }}</option>
                                            <option value="Male" style="font-size:20px;">Male</option>
                                            <option value="Female" style="font-size:20px;">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:160px;">Date of
                                            Birth</span>
                                    </div>
                                    <input class="form-control" type="date" name="date_of_birth"
                                        value="{{ old('date_of_birth') }}" style="font-size:20px;">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:160px;">Class</span>
                                    </div>
                                    <div class="controls">
                                        <select id="CurrentClass" class="form-control" name="current_class"
                                            value="{{ old('current_class') }}" style="font-size:20px; width:330px;">
                                            <option value="" style="font-size:20px;"></option>
                                            @php
                                                $Classes = App\Models\CurrentClass::all();
                                            @endphp
                                            @foreach ($Classes as $Class)
                                                <option style="font-size:20px;">{{ $Class->current_class }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:160px;">School
                                            Fees</span>
                                    </div>
                                    <input class="form-control" type="number" min="0" step="any"
                                        name="fees" placeholder="Enter Fees to be paid" value="{{ old('fees') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:160px;">Reporting
                                            Date</span>
                                    </div>
                                    <input class="form-control" type="date" name="reporting_date"
                                        value="@php echo (new DateTime())->format('Y-m-d'); @endphp"
                                        style="font-size:20px;">
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
    {{-- Add New Admission Modal Ends --}}
@endsection
