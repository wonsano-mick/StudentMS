@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Classes</h6>
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif

                @include('sweetalert::alert')
                <div class="col-md-3">
                    <button type="button" data-toggle="modal" data-target="#currentClass"
                        class="btn btn-md btn-success">Add New Class</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($CurrentClass) !== null)
                                    <th>S/N</th>
                                    <th>Class Name</th>
                                    <th>Delete Class</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($CurrentClass as $key => $Class)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $Class->current_class }}</td>
                                    <td>
                                        <form method="POST" action="{{ url('current-class/' . $Class->id . '/delete') }}">
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


    {{-- Add Class Modal Starts --}}
    <div class="modal fade" id="currentClass" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('current-class') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Class Registration Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Class</span>
                                    </div>
                                    <input class="form-control" type="text" name="current_class"
                                        placeholder="Enter Class" value="{{ old('current_class') }}">
                                </div>
                                {{-- <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Sub
                                            Class</span>
                                    </div>
                                    <div class="controls" style="width:340px;">
                                        <select class="form-control" name="sub_current_class" style="font-size:20px;">
                                            <option value="{{ old('sub_current_class') }}" style="font-size:20px;">
                                                {{ old('sub_current_class') }}</option>
                                            <option value="A" style="font-size:20px;">A</option>
                                            <option value="B" style="font-size:20px;">B</option>
                                            <option value="C" style="font-size:20px;">C</option>
                                        </select>
                                    </div>
                                </div> --}}
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
    {{-- Add Class Modal Ends --}}
@endsection
