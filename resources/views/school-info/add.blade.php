@extends('layouts.includes.schoolinfo-master')
@section('title', 'Wonsano SFMS | Register School')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="margin-top: 5%">
                    <div class="card-header text-center">{{ __('School Registration Form') }}</div>
                    <div class="card-body">
                        <form action="{{ url('schoolInfo') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="card">
                                <div class="card-body text-dark">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Name of School<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="name_of_school"
                                                        value="{{ old('name_of_school') }}"
                                                        placeholder="Enter Name of School">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Landmark</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text"
                                                        name="landmark_location_of_school"
                                                        value="{{ old('landmark_location_of_school') }}"
                                                        placeholder="Enter Landmark Location of School">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Town <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text"
                                                        name="town_and_region_location_of_school"
                                                        value="{{ old('town_and_region_location_of_school') }}"
                                                        placeholder="Enter Town and Region of Location of School">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Digital Addres <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text"
                                                        name="digital_address_of_school"
                                                        value="{{ old('digital_address_of_school') }}"
                                                        placeholder="Enter Digital Address of School">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Phone Number</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="phone_number_of_school"
                                                        value="{{ old('phone_number_of_school') }}"
                                                        placeholder="Enter Phone Number of School">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Email</h5>
                                                <div class="controls">
                                                    <input class="form-control" type="email" name="email_of_school"
                                                        value="{{ old('email_of_school') }}"
                                                        placeholder="Enter Email Address of School">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Name of Company<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="name_of_company"
                                                        value="{{ old('name_of_company') }}"
                                                        placeholder="Enter Name of Company">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Company's SSNIT Number<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="company_ssnit_number"
                                                        value="{{ old('company_ssnit_number') }}"
                                                        placeholder="Enter Company's SSNIT Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Company's TIN Number<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="company_tin_number"
                                                        value="{{ old('company_tin_number') }}"
                                                        placeholder="Enter Company's TIN Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Company's Bank Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="company_bank_name"
                                                        value="{{ old('company_bank_name') }}"
                                                        placeholder="Enter Company's Bank Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Company's Bank Account Number<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text"
                                                        name="company_bank_account_number"
                                                        value="{{ old('company_bank_account_number') }}"
                                                        placeholder="Enter Company's Bank Account Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Company's Bank Branch<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="company_bank_branch"
                                                        value="{{ old('company_bank_branch') }}"
                                                        placeholder="Enter Company's Bank Branch">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Company's MoMo Name<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input class="form-control" type="text" name="company_momo_name"
                                                        value="{{ old('company_momo_name') }}"
                                                        placeholder="Enter Company's MoMo Name">
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>School Logo</h5>
                                                <div class="controls">
                                                    <input type="file" class="form-control-file" name="logo_of_school">
                                                    @if ($errors->has('logo_of_school'))
                                                        <span
                                                            class="text-danger text-left">{{ $errors->first('logo_of_school') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-2">
                                            <a href="{{ url('schoolInfo') }}">
                                                <button type="button" class="btn btn-danger btn-lg btn-block"
                                                    data-dismiss="modal"> <i class="fas fa-times"></i> Close</button>
                                            </a>
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
        </div>
    </div>
@endsection
