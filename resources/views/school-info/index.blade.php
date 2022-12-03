@extends('layouts.includes.schoolinfo-master')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')
    @include('sweetalert::alert')
    <div class="row justify-content-center" style="margin-top: 10%">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-3" style="background-color: transparent; opacity:inherit">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="col-lg-6 offset-lg-3 mb-2">
                                <a href="{{ url('schoolInfo/create') }}"><button
                                        class="btn bg-primary text-uppercase rounded text-white text-lg border-secondary">
                                        Register School </span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
