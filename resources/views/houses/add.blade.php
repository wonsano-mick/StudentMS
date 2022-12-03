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
                <form action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    {{-- <div class="card">  --}}
                    <div class="card-header text-dark-50 bg-transparent text-center">
                        <h2 class="card-title text-center">Class House Form</h2>
                    </div>
                    <div class="card-body text-dark">
                        <table class="table table-md table-bordered" id="class_table">
                            <button type="button" name="add" id="addMore" class="btn btn-success">Add More</button>
                        </table>
                        <button type="submit" class="btn btn-success btn-md">Submit</button>
                    </div>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
