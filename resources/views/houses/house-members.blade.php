@extends('layouts.includes.prints-master')
@section('title', $title . ' House List : ' . $date)
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid" style="min-height: 508px;">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary" align="center">{{ $title }} House List
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" data-toggle="modal" data-target="#House"
                                class="btn btn-md btn-success">Add
                                New House</button>
                        </div>
                        <div class="col-md-6 offset-col-3">
                            <a href="{{ route('houses.archive', $title) }}" class="float-right"><button
                                    class="btn btn-md btn-info btn-flat"><i class="fas fa-archive"></i>
                                    {{ $title }} Archives</button></a>
                        </div>
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
                                @if (count($HouseMembers) !== null)
                                    <th>S/N</th>
                                    <th>Student ID</th>
                                    <th>Name of Student</th>
                                    <th>Gender</th>
                                    <th>Class/Form</th>
                                    <th>Residential Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($HouseMembers as $key => $HouseMember)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $HouseMember->student_id }}</td>
                                    <td>{{ ucwords($HouseMember->student_name) }}
                                    </td>
                                    <td>{{ $HouseMember->gender }}</td>
                                    <td>{{ $HouseMember->current_class }}</td>
                                    <td>{{ $HouseMember->residential_status }}</td>
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
    {{-- Add House Modal Starts --}}
    <div class="modal fade" id="House" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">House Registration Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">House</span>
                                    </div>
                                    <input class="form-control" type="text" name="house_of_affiliation"
                                        placeholder="Enter House of Affiliation" value="{{ old('house_of_affiliation') }}">
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
    {{-- Add House Modal Ends --}}
@endsection
