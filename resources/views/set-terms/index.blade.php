@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')
    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid" style="min-height: 508px;">

        {{-- Set Term and Academic Year --}}
        <div class="card shadow mb-4">

            <div class="card-body">
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif
                <div class="row ml-5">
                    <div class="col-lg-6 offset-lg-2">
                        <form action="{{ route('setTerm') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    {{-- <div class="card"> --}}
                                    <div class="card-header bg-dark text-white-50 text-center">
                                        <h3>Select Term and Academic Year</h3>
                                    </div>
                                    <div class="card-body">

                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white" id="Term"
                                                    style="width:180px; font-size:20px;">Term</span>
                                            </div>
                                            <select class="form-control" name="term" style="font-size:20px;">
                                                @php
                                                    $Date = date('n');
                                                    if ($Date >= 1 && $Date <= 4) {
                                                        $Term = 'First Term';
                                                    } elseif ($Date > 4 && $Date <= 8) {
                                                        $Term = 'Second Term';
                                                    } elseif ($Date > 8 && $Date <= 12) {
                                                        $Term = 'Third Term';
                                                    }
                                                @endphp
                                                <option value="@php echo $Term @endphp" style="font-size:20px;">
                                                    @php echo $Term; @endphp</option>
                                                <option style="font-size:20px;" value="First Term">First Term</option>
                                                <option style="font-size:20px;" value="Second Term">Second Term</option>
                                                <option style="font-size:20px;" value="Third Term">Third Term</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white"
                                                    style="width:180px; font-size:20px;">Academic Year</span>
                                            </div>
                                            @php
                                                $AcademicYear = date('Y');
                                                $AcademicYear = $AcademicYear . '/' . ($AcademicYear + 1);
                                            @endphp
                                            <input type="text" class="form-control bg-light border-0 "
                                                name="academic_year" value="{{ $AcademicYear }}" style="margin-right: 2px;">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 mb-2">
                                            <a href="{{ route('home') }}" class="btn btn-danger btn-md btn-block"
                                                style="font-size:20px;"><i class="fas fa-times"></i> Cancel</a>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <button type="submit" class="btn btn-success btn-md btn-block"
                                                style="font-size:20px;"><i class="fas fa-check"></i>
                                                Set Bill</button>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>

        </div>
        {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}
@endsection
