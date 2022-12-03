@extends('layouts.includes.app')
@section('title', 'SMS | Male Population')
@section('content')

    @include('sweetalert::alert')
    {{-- Begin Main Content --}}
    <div class="container-fluid" style="min-height: 508px;">
        {{-- Student Population --}}
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-10 offset-1 col-lg-10 d-flex justify-content-center align-items-center">
                        <div class="card-body">
                            <div>
                                @php
                                    $Classes = App\Models\SubCurrentClass::all();
                                    if ($Classes != null) {
                                        foreach ($Classes as $Class) {
                                            $Males = App\Models\Student::where('gender', 'Male')
                                                ->where('actual_class', $Class->current_class)
                                                ->get();
                                            // foreach ($Males as $Male) {
                                            //     dd(count($Males));
                                            // }
                                        }
                                    }
                                @endphp
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
