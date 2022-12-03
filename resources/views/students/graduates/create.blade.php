@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Graduates')
@section('content')
    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">
        {{-- Main content Start --}}
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Add Graduates</h3>
            </div>
            <form action="{{ route('graduates.store') }}" method="post">
                @csrf
                {{-- box-header --}}
                <div class="box-body">
                    {{-- <div class="table-responsive"> --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name of Student<span style="color: red">*</span></th>
                                <th>Student ID<span style="color: red">*</span></th>
                                <th>Year of Completion<span style="color: red">*</span></th>
                                <th>
                                    <a href="#" class="btn btn-sm btn-success add_more"><i
                                            class="fas fa-plus fa-lg"></i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="addMoreStudent">
                            <tr>
                                <th>1</th>
                                <th>
                                    <select name="student_id[]" id="student_id" class="form-control student_id">
                                        <option value="">Select Student</option>
                                        @foreach ($GraduateStudents as $Student)
                                            <option data-price="{{ $Student->student_id }}"
                                                value="{{ $Student->student_id }}">
                                                {{ $Student->first_name . ' ' . $Student->middle_name }}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <input type="text" class="form-control student_id" name="student_id[]"
                                        id="student_id">
                                </th>
                                <th>
                                    <input type="text" class="form-control year_complete" name="year_complete[]"
                                        id="year_complete">
                                </th>
                                <th><a href="#" class="btn btn-sm btn-danger"><i class="fas fa-minus fa-lg"></i></a>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="text-xs-right mb-2">
                            <a href="{{ route('graduates.index') }}" class="btn btn-danger btn-rounded"
                                style="width: 200px">Cancel</a>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-xs-left">
                            <button type="submit" class="btn btn-info btn-rounded" style="width: 200px">Add
                                Graduate</button>
                        </div>
                    </div>
                </div>
                {{-- box-body --}}
            </form>
        </div>
    </div>

    </div>
    {{-- /.container-fluid --}}
    {{-- End of Main Content --}}
@endsection
@section('scripts_students')
    <script type="text/javascript">
        // $(document).ready(function() {
        //     alert(1);
        // });

        $('.add_more').click(function() {
            var student = $('.student_id').html();
            var numberofrow = ($('.addMoreStudent tr').length - 0) + 1;
            var tr = '<tr>' +
                '<td>' + numberofrow + '</td>' +
                '<td> <select class="form-control student_id" name="student_name[]" >' + student +
                ' </select></td>' +
                '<td> <input type="text" class="form-control student_id" name="student_id[]"></td>' +
                '<td> <input type="text" class="form-control year_complete" name="year_complete[]"></td>' +
                '<td> <a href="#" class="btn btn-sm btn-danger delete"><i class="fas fa-minus fa-lg"></i></a></td>' +
                '</tr>';
            $('.addMoreStudent').append(tr);
        });
        $('.addMoreStudent').delegate('.delete', 'click', function() {
            $(this).parent().parent().remove();
        });

        $('.addMoreStudent').delegate('.student_id', 'change', function() {
            var tr = $(this).parent().parent();
            var student_id = tr.find('.student_id option:selected').attr('data-price');
            tr.find('.student_id').val(student_id);
        });
    </script>
@endsection
