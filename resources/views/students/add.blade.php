@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Add Student')
@section('content')
    {{-- Begin Page Content --}}
    {{-- <div class="container-fluid"> --}}

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
            <div class="container row">
                {{-- <div class="offset-lg-3 col-lg-6"> --}}
                <form action="{{ route('students.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card">
                            <div class="card-header text-white-50 bg-dark text-center">
                                <h2 class="card-title text-center">Student Registration Form</h2>
                            </div>
                            <div class="card-body text-dark">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Surname Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="sur_name"
                                                    value="{{ old('sur_name') }}" style="font-size:20px;" autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Other Names</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="other_names"
                                                    value="{{ old('other_names') }}" style="font-size:20px;"
                                                    autocomplete="on">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select id="Gender" class="form-control" name="gender"
                                                    value="{{ old('gender') }}" style="font-size:20px;">
                                                    <option value="" style="font-size:20px;"></option>
                                                    <option value="Male" style="font-size:20px;">Male</option>
                                                    <option value="Female" style="font-size:20px;">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of Birth <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input class="form-control" type="date" name="date_of_birth"
                                                    value="{{ old('date_of_birth') }}" style="font-size:20px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Class/Form <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select id="CurrentClass" class="form-control" name="current_class"
                                                    value="{{ old('current_class') }}" style="font-size:20px;">
                                                    <option value="" style="font-size:20px;"></option>
                                                    @foreach ($Classes as $Class)
                                                        <option style="font-size:20px;">{{ $Class->current_class }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Sub Class</h5>
                                            <div class="controls">
                                                <select class="form-control" name="sub_current_class"
                                                    style="font-size:20px;">
                                                    <option value="{{ old('sub_current_class') }}" style="font-size:20px;">
                                                        {{ old('sub_current_class') }}</option>
                                                    <option value="A" style="font-size:20px;">A</option>
                                                    <option value="B" style="font-size:20px;">B</option>
                                                    <option value="C" style="font-size:20px;">C</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Date of Admission <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input class="form-control" type="date" name="date_of_admission"
                                                    value="@php echo (new DateTime())->format('Y-m-d'); @endphp"
                                                    style="font-size:20px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Term <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="form-control" name="term" value="{{ old('term') }}"
                                                    style="font-size:20px;">
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
                                                    <option style="font-size:20px;" value="Second Term">Second Term
                                                    </option>
                                                    <option style="font-size:20px;" value="Third Term">Third Term</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Religion</h5>
                                            <div class="controls">
                                                <select class="form-control" name="religion" style="font-size:20px;">
                                                    <option value="{{ old('religion') }}" style="font-size:20px;">
                                                        {{ old('religion') }}</option>
                                                    <option value="Christianity" style="font-size:20px;">Christianity
                                                    </option>
                                                    <option value="Islam" style="font-size:20px;">Islam</option>
                                                    <option value="Other" style="font-size:20px;">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Denomination</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="denomination"
                                                    value="{{ old('denomination') }}" style="font-size:20px;"
                                                    autocomplete="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Residential Status <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select id="ResidentialStatus" class="form-control"
                                                    name="residential_status" value="{{ old('residential_status') }}"
                                                    style="font-size:20px;">
                                                    <option value="" style="font-size:20px;"></option>
                                                    <option value="Day" style="font-size:20px;">Day</option>
                                                    <option value="Boarding" style="font-size:20px;">Boarding</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>House of Affiliation <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select id="HouseAffiliation" class="form-control"
                                                    name="house_of_affiliation" value="{{ old('house_of_affiliation') }}"
                                                    style="font-size:20px;">
                                                    <option value="" style="font-size:20px;"></option>
                                                    @foreach ($Houses as $House)
                                                        <option style="font-size:20px;"
                                                            value="{{ $House->house_of_affiliation }}">
                                                            {{ $House->house_of_affiliation }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Guardian's Name</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="name_of_guardian"
                                                    value="{{ old('name_of_guardian') }}" style="font-size:20px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Guardian's Phone Number</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="mobile_number"
                                                    value="{{ old('mobile_number') }}" style="font-size:20px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Residential Address</h5>
                                            <div class="controls">
                                                <input class="form-control" type="text" name="residential_address"
                                                    value="{{ old('residential_address') }}" style="font-size:20px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="mb-4">
                                                <img id="showImage" src="{{ asset('images/students/avatar.png') }}"
                                                    width="120" height="90" alt="Student Image"><br>
                                                <input type="file" id="actual-btn" class="form-control-file"
                                                    name="student_image" hidden>
                                                <label for="actual-btn"
                                                    style="background-color: indigo; color:white; padding:0.5rem; border-radius:0.3rem; cursor:pointer; margin-top:1rem;">choose
                                                    student Image</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <a href="{{ route('students.index') }}">
                                            <button type="button" class="btn btn-danger btn-lg btn-block"><i
                                                    class="fas fa-times"></i> Close</button>
                                        </a>
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <button type="submit" class="btn btn-success btn-lg btn-block"><i
                                                class="fas fa-check"></i> Add Student</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    {{-- </div> --}}
    </div>
@endsection
