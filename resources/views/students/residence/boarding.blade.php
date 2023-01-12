@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Boarding Students')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All Boarding Students</h6>
            </div>
            <div class="row">
                <div class="col-md-6 offset-col-3">
                    <a href="{{ route('residence.archive', 'Boarding') }}"><button class="btn btn-md btn-info btn-flat"><i
                                class="fas fa-archive"></i>
                            Boarding Students Archives</button></a>
                </div>
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
                                @if (count($Boarders) !== null)
                                    <th>S/N</th>
                                    <th>Name of Student</th>
                                    <th>Gender</th>
                                    <th>Class</th>
                                    <th>House</th>
                                    <th>Profile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Boarders as $key => $Boarder)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucwords($Boarder->student_name) }}
                                    </td>
                                    <td>{{ $Boarder->gender }}</td>
                                    <td>{{ $Boarder->current_class }}</td>
                                    <td>{{ $Boarder->house_affiliation }}</td>
                                    <td>
                                        <a href="{{ route('students.profile', $Boarder->student_id) }}"
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
