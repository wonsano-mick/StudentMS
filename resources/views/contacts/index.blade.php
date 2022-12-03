@extends('layouts.includes.app')
@section('title', 'SMS | Contact')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Main Content --}}
    <div class="container">
        {{-- Student Population --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-10 offset-1 col-lg-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <div class="mb-2">
                                <p class="text-center text-uppercase" style="font-size: 2em;">Contact me on</p>
                                <div class="row">
                                    <div class="col-md-6 shadow">
                                        <p class="text-center text-uppercase">social media</p>
                                        <p><i class="fas fa-facebook fa-lg"></i> michaelwonsano</p>
                                        <p><i class="fas fa-telegram fa-lg"></i> wonsano</p>
                                        <p><i class="fas fa-whatsapp fa-lg"></i> +233243877994</p>
                                    </div>
                                    <div class="col-md-6 shadow">
                                        <p class="text-center text-uppercase">Contact</p>
                                        <p>Mobile Number : +233206646949</p>
                                        <p>Phone Number : +233243877994</p>
                                        <p>Email Address : ofosuachmick@yahoo.com</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <p class="text-center text-uppercase" style="font-size: 2em;">for the following</p>
                                <div class="shadow">
                                    <p class="text-center text-uppercase">management systems</p>
                                    <div class="ml-4">
                                        <p>School Fees Management System</p>
                                        <p>Students Management System</p>
                                        <p>Employee Management System</p>
                                        <p>Point of Sales Management System</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- /.container-fluid --}}
    </div>
    {{-- End of Main Content --}}
@endsection
