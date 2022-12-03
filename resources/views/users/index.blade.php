@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Users</h6>
                <div class="col-md-3"><button type="button" data-toggle="modal" data-target="#addUser"
                        class="btn btn-md btn-success">Add New User</button>
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
                {{-- @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert" align="center"><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times;</span></button><strong>{{ session('success') }}</strong></div>
                            @endif --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($Users) !== null)
                                    <th>S/N</th>
                                    <th>Name of User</th>
                                    <th>Username</th>
                                    <th>User Type</th>
                                    <th>Update User</th>
                                    <th>Delete User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Users as $key => $User)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucwords($User->name) }}</td>
                                    <td>{{ ucwords($User->username) }}</td>
                                    <td>{{ $User->role_as }}</td>
                                    <td>
                                        <a href="{{ url('users/' . $User->id . '/edit') }}"
                                            class="btn btn-sm btn-warning mb-2"><i class="fas fa-edit"></i> Update</a>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ url('users/' . $User->id . '/delete') }}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger btn-flat show_confirm"
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
    {{-- container-fluid --}}

    </div>
    {{-- End of Main Content --}}

    {{-- Add User Modal Starts --}}
    <div class="modal fade" id="addUser" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center card-header text-black">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('users') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">User Registration Form</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Username</span>
                                    </div>
                                    <input class="form-control" type="text" name="username" placeholder="Enter Username"
                                        value="{{ old('username') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Name</span>
                                    </div>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Name"
                                        value="{{ old('name') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Email</span>
                                    </div>
                                    <input class="form-control" type="email" name="email" placeholder="Enter Email"
                                        value="{{ old('email') }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Password</span>
                                    </div>
                                    <input class="form-control" type="password" name="password"
                                        placeholder="Enter Password">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">Confirm
                                            Password</span>
                                    </div>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        placeholder="Confirmed Password">
                                </div>
                                {{-- <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white mr-4" style="width:150px;">User
                                            Image</span>
                                        <input type="file" class="form-control-file" name="user_img">
                                        @if ($errors->has('user_img'))
                                            <span class="text-danger text-left">{{ $errors->first('user_img') }}</span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 mb-2">
                                    <button type="button" class="btn btn-danger btn-lg btn-block" data-dismiss="modal">
                                        <i class="fas fa-times"></i> Close</button>
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
    {{-- Add User Modal Ends --}}
@endsection
