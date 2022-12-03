@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif

                @include('sweetalert::alert')
                <form action="{{ url('users/' . $User->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <div class="card">
                        <div class="card-header text-white-50 bg-dark text-center">
                            <h2 class="card-title text-center">Update User Details</h2>
                        </div>
                        <div class="card-body text-dark">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Username</span>
                                    </div>
                                    <input class="form-control" type="text" name="username" placeholder="Enter Username"
                                        value="{{ $User->username }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Name</span>
                                    </div>
                                    <input class="form-control" type="text" name="name" placeholder="Enter Your Name"
                                        value="{{ $User->name }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white"
                                            style="width:150px;">Email</span>
                                    </div>
                                    <input class="form-control" type="email" name="email" placeholder="Enter Your Email"
                                        value="{{ $User->email }}">
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">User
                                            Type</span>
                                    </div>
                                    <select class="form-control" name="role_as">
                                        <option selected value="{{ $User->role_as }}">{{ $User->role_as }}</option>
                                        <option value="Admin">Admin</option>
                                        <option value="User">User</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend mb-3">
                                        <span class="input-group-text bg-primary text-white" style="width:150px;">User
                                            Level</span>
                                    </div>
                                    <select class="form-control" name="user_level">
                                        <option selected value="{{ $User->user_level }}">{{ $User->user_level }}</option>
                                        <option value="Limited">Limited</option>
                                        <option value="Unlimited">Unlimited</option>
                                    </select>
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

                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="mb-4">
                                            <img id="showImage"
                                                src="{{ !empty($User->user_image) ? url('images/users/' . $User->user_image) : url('images/users/avatar.png') }}"
                                                width="120" height="90" alt="User Image"><br>
                                            <input type="hidden" value="{{ $User->user_image }}" name="user_image1">
                                            <input type="file" id="actual-btn" class="form-control-file"
                                                name="user_image" hidden>
                                            <label for="actual-btn"
                                                style="background-color: indigo; color:white; padding:0.5rem; border-radius:0.3rem; cursor:pointer; margin-top:1rem;">choose
                                                user Image</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-2">
                                    <a href="{{ url('users') }}">
                                        <button type="button" class="btn btn-danger btn-lg btn-block"
                                            style="width: 200">
                                            <i class="fas fa-times"></i> Cancel</button>
                                    </a>
                                </div>
                                <div class="col-lg-5 mb-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" style="width: 200"><i
                                            class="fas fa-check"></i> Update </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    {{-- container-fluid --}}

    </div>
    {{-- End of Main Content --}}
@endsection
