@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')

    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Withdrawn Students</h6>
            </div>
            <div class="card-body">
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif
                @include('sweetalert::alert')
                {{-- @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" align="center"><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times;</span></button><strong>{{ session('success') }}</strong></div>
                @endif
                @if (Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button type="button" class="close" data-dismiss="alert" aria-label="Close" <span aria-hidden="true">&times;</span></button><strong>{{ session('fail') }}</strong></div>
                @endif --}}
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($WithdrawnStudents) !== null)
                                    <th>S/N</th>
                                    <th>Name of Student</th>
                                    <th>Gender</th>
                                    <th>Guardian Name</th>
                                    <th>Mobile Number</th>
                                    <th>Date Withdrawn</th>
                                    <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($WithdrawnStudents as $key => $WithdrawnStudent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucwords($WithdrawnStudent->sur_name) . ' ' . ucwords($WithdrawnStudent->other_names) }}
                                    </td>
                                    <td>{{ $WithdrawnStudent->gender }}</td>
                                    <td>{{ $WithdrawnStudent->guardian_name }}</td>
                                    <td>{{ $WithdrawnStudent->mobile_number }}</td>
                                    <td>{{ date('d M Y', strtotime($WithdrawnStudent->date_of_exit)) }}</td>
                                    <td>
                                        <a href="{{ route('withdrawn-students.profile', $WithdrawnStudent->student_id) }}"
                                            class="btn btn-sm btn-primary mb-2"><i class="fas fa-eye"></i> Details</a>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- @else
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><strong>No Student Registered</strong></div> --}}
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- /.container-fluid --}}

    </div>
    {{-- End of Main Content --}}
    <script>
        {
            $(document).ready(function() {
                $('#dataTable').DataTable({
                    "order": [
                        [3, "DESC"]
                    ]
                });

            });
        }
    </script>
@endsection
