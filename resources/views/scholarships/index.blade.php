@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Scholarships')
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Scholarships</h6>
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif

                @include('sweetalert::alert')
                <div class="col-md-3">
                    <button type="button" data-toggle="modal" data-target="#scholarship" class="btn btn-md btn-success">Add
                        New Scholarship</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($Scholarships) !== null)
                                    <th>S/N</th>
                                    <th>Class Name</th>
                                    <th>Delete Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Scholarships as $key => $Scholarship)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $Scholarship->scholarship }}</td>
                                    <td>
                                        <form method="POST"
                                            action="{{ url('scholarships/' . $Scholarship->id . '/delete') }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm"
                                                data-toggle="tooltip" title='Delete'>Delete</button>
                                        </form>
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
