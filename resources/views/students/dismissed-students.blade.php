@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | ' . $title)
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Dismissed Students</h6>
            </div>
            <div class="card-body">
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" align="center"><button
                                type="button" class="close" data-dismiss="alert" aria-label="Close" <span
                                aria-hidden="true">&times;</span></button><strong>{{ $error }}</strong></div>
                    @endforeach
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                @if (count($DismissedStudents) !== null)
                                    <th>S/N</th>
                                    <th>Name of Student</th>
                                    <th>Gender</th>
                                    <th>Guardian Name</th>
                                    <th>Mobile Number</th>
                                    <th>Date Dismissed</th>
                                    <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($DismissedStudents as $key => $DismissedStudent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucwords($DismissedStudent->sur_name) . ' ' . ucwords($DismissedStudent->other_names) }}
                                    </td>
                                    <td>{{ $DismissedStudent->gender }}</td>
                                    <td>{{ $DismissedStudent->guardian_name }}</td>
                                    <td>{{ $DismissedStudent->mobile_number }}</td>
                                    <td>{{ date('d M Y', strtotime($DismissedStudent->date_of_exit)) }}</td>
                                    <td>
                                        <a href="{{ route('dismissed-students.profile', $DismissedStudent->student_id) }}"
                                            class="btn btn-sm btn-primary mb-2"><i class="fas fa-eye"></i> Details</a>
                                    </td>
                                </tr>
                            @endforeach
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
