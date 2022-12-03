@extends('layouts.includes.auth-master')
{{-- @section('title', 'Wonsano SFMS | Login') --}}
@php
    $SchoolInfoExist = App\Models\SchoolInfo::first();
@endphp
@section('title', $SchoolInfoExist->name_of_school . ' SMS | Login')
@section('content')
    @include('sweetalert::alert')
    <div class="container">
        <br />
        {{-- <h1><span style="color: white;">we</span><span style="color: white;">ll</span><span style="color: white;">be</span><span style="color: white;">ing</span> <span style="color: white;">k</span><span style="color: white;">i</span><span style="color: white;">d</span><span style="color: white;">s</span><span style="color: white;"> sfms</span> </h1> --}}
        <h1><span style="color: white; font-family: Ubuntu;">students' management system</h1>

        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button type="button"
                        class="close" data-dismiss="alert" aria-label="Close" <span
                        aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
            @endforeach
        @endif

        @include('sweetalert::alert')
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-3" style="background-color: transparent; opacity:inherit">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="p-2">
                                    <div class="text-center pb-3">
                                        <img src="{{ !empty($SchoolInfoExist->logo_of_school) ? url('images/' . $SchoolInfoExist->logo_of_school) : url('images/avatar.png') }}"
                                            alt="" srcset="" class="rounded-circle"
                                            style="width: 150px; height: 150px;">
                                    </div>
                                    <form class="user" action="{{ route('login') }}" method="post"
                                        style="font-family: Ubuntu; font-size: 2rem;">
                                        @csrf
                                        <div class="form-group mb-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="my-addon"><i
                                                            class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text"
                                                    class="form-control form-control-user border-bottom-primary border-left-success"
                                                    name="username" placeholder="Enter Username" autofocus
                                                    autocomplete="off" style="font-size: 1rem; font-family: Ubuntu;">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="my-addon"><i
                                                            class="fas fa-key"></i></span>
                                                </div>
                                                <input type="password" name="password"
                                                    class="form-control form-control-user border-bottom-primary border-left-success"
                                                    id="exampleInputPassword" placeholder="Enter Password"
                                                    style="font-size: 1rem; font-family: Ubuntu;">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="login-btn btn-block" name="Login"
                                            style="font-family: Ubuntu; color: antiquewhite;" data-aos="fade-right"
                                            data-aos-duration="1800"> Login</button>
                                        <div class="d-none d-lg-block d-xl-block">
                                            <hr class="border-bottom-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
