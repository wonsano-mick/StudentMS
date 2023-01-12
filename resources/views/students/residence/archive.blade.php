@extends('layouts.includes.app')
@section('title', 'Wonsano SFMS | Day Students')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Page Content --}}
    <div class="container-fluid">

        {{-- All Users --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary" align="center">All {{ $ResidentialStatus }} Students</h6>
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
                                @if (count($Students) !== null)
                                    <th>S/N</th>
                                    <th>Name of Student</th>
                                    <th>Gender</th>
                                    <th>Class</th>
                                    <th>House</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Students as $key => $Student)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ ucwords($Student->student_name) }}
                                    </td>
                                    <td>{{ $Student->gender }}</td>
                                    <td>{{ $Student->current_class }}</td>
                                    <td>{{ $Student->house_affiliation }}</td>
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
