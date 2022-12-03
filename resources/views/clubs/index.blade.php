@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Scholarships')
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Clubs</h6>
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif

                @include('sweetalert::alert')
                <div class="col-md-3">
                    <button type="button" data-toggle="modal" data-target="#addClub" class="btn btn-md btn-success">Add
                        New Club</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($Clubs) !== null)
                                    <th>S/N</th>
                                    <th>Class Name</th>
                                    <th>Delete Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Clubs as $key => $Club)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $Club->club }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('clubs/' . $Club->id . '/delete') }}">
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

    {{-- Add Club/Society Information Modal Starts --}}
    <div class="modal fade" id="addClub" role="dialog">
        <div class="modal-dialog">
            {{-- Modal content --}}
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('clubs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Club/Society Information Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                            Club</span>
                                    </div>
                                    <input class="form-control" type="text" name="name_of_club"
                                        placeholder="Enter Name of Club/Society" value="{{ old('name_of_club') }}">
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
    {{-- Add Club Information Modal Ends --}}
@endsection
