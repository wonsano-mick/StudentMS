@extends('layouts.includes.prints-master')
@section('title', $title . '\'s Scholarship Beneficiaries List : ' . $date)
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid" style="min-height: 508px;">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" align="center">{{ $title }} 's Scholarship
                        Beneficiaries List
                    </h6>
                    <div class="col-md-3">
                        <button type="button" data-toggle="modal" data-target="#scholarship"
                            class="btn btn-md btn-success">Add
                            Scholarship</button>
                    </div>
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

                @include('sweetalert::alert')
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($Beneficiaries) !== null)
                                    <th>S/N</th>
                                    <th>Student ID</th>
                                    <th>Name of Student</th>
                                    <th>Class/Form</th>
                                    <th>Scholarship Type</th>
                                    <th>Scholarship Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Beneficiaries as $key => $Beneficiaries)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $Beneficiaries->student_id }}</td>
                                    <td>{{ ucwords($Beneficiaries->student_name) }}
                                    </td>
                                    <td>{{ $Beneficiaries->current_class }}</td>
                                    <td>{{ $Beneficiaries->scholarship_name }}</td>
                                    <td>{{ $Beneficiaries->scholarship_status }}</td>
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
    {{-- Add Scholarship Modal Starts --}}
    <div class="modal fade" id="scholarship" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('scholarships.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Schorlaship Type Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Type of
                                            Scholarhip</span>
                                    </div>
                                    <input class="form-control" type="text" name="scholarship"
                                        placeholder="Enter Type of Scholarship" value="{{ old('scholarship') }}">
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal"> <i
                                            class="fas fa-times"></i> Close</button>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                            class="fas fa-check"></i> Register </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Add Scholarship Modal Ends --}}
@endsection
