@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Confirm Delete')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container" style="min-height: 508px">
        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button type="button"
                        class="close" data-dismiss="alert" aria-label="Close" <span
                        aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
            @endforeach
        @endif
        <form action="{{ url('students/delete') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="card-body shadow">
                {{-- <div class="card-header text-white-50 text-center"> --}}
                <h2 class="card-title text-center">Fill out the form before deleting student</h2>
                {{-- </div> --}}
                {{-- <div class="card-body text-dark"> --}}
                <div class="row">
                    <div class="input-group">
                        <div class="input-group-prepend mb-3">
                            <span class="input-group-text bg-primary text-white" style="width:150px;">Student
                                ID</span>
                        </div>
                        <input class="form-control" type="text" name="student_id" value="{{ $StudentData->student_id }}">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend mb-3">
                            <span class="input-group-text bg-primary text-white" style="width:150px;">Name of
                                Student</span>
                        </div>
                        <input class="form-control" type="text" name="name_of_student"
                            value="{{ $StudentData->sur_name . ' ' . $StudentData->other_names }}">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend mb-3">
                            <span class="input-group-text bg-primary text-white" style="width:150px;">Current
                                Class</span>
                        </div>
                        <input class="form-control" type="text" name="name_of_student"
                            value="{{ $StudentData->current_class }}">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend mb-3">
                            <span class="input-group-text bg-primary text-white" style="width:150px;">Reason</span>
                        </div>
                        <select class="form-control" name="reason"style="font-size:20px;">
                            <option value="{{ old('reason') }}" style="font-size:20px;">
                                {{ old('reason') }}</option>
                            <option value="Graduated" style="font-size:20px;">Graduated</option>
                            <option value="Withdrawn" style="font-size:20px;">Withdrawn</option>
                            <option value="Dismissed" style="font-size:20px;">Dismissed</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend mb-3">
                            <span class="input-group-text bg-primary text-white" style="width:150px;">Date</span>
                        </div>
                        <input type="date" name="date_of_delete" class="form-control"
                            value="@php echo (new DateTime())->format('Y-m-d'); @endphp">
                    </div>

                    <div class="col-lg-6 mb-2">
                        <a href="{{ route('students.index') }}"><button type="button"
                                class="btn btn-warning btn-lg btn-block" data-dismiss="modal">
                                <i class="fas fa-times"></i> Close</button></a>
                    </div>
                    <div class="col-lg-6 mb-2">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-lg btn-block show_confirm"><i
                                class="fas fa-trash"></i>
                            Delete Student Details </button>
                    </div>
                </div>
        </form>
    </div>
    </div>
    {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}
@endsection
