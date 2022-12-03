<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>{{ Str::of($Class->current_class)->slug('_') . '_student_list' }}</title>
    {{-- Bootstrap core CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/bootstrap.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        .bill-table {
            margin: auto;
            width: 50% !important;
        }

        .container {
            font-weight: bold;
            text-align: center;
        }

        .mt {
            margin-top: 20px;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .student-details {
            font-size: 12pt;
        }

        .class-table-head {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
        }
    </style>
</head>

<body style="font-family: times;">
    <div class="container">
        <!--logo goes here-->
        @php
            $SchoolInfoExist = App\Models\SchoolInfo::first();
        @endphp
        <span><img src="images/{{ $SchoolInfoExist->logo_of_school }}" alt="school logo" style="float:left"
                width="170" height="120"></span>
        <div>
            <a target="_blank" href="javascript:;" style="font-size: 18pt;">{{ $SchoolInfoExist->name_of_school }}</a>
        </div>
        <div style="font-size: 8pt;">{{ $SchoolInfoExist->landmark_location_of_school }}</div>
        <div style="font-size: 8pt;">{{ $SchoolInfoExist->town_and_region_location_of_school }}</div>
        <div style="font-size: 8pt;">Digital Address: {{ $SchoolInfoExist->digital_address_of_school }}</div>
        <div style="font-size: 8pt;">Phone: {{ $SchoolInfoExist->phone_number_of_school }}</div>
        <div style="font-size: 8pt;">Email: {{ $SchoolInfoExist->email_of_school }}</div>

        <div class="mt" style="font-weight: bolder; font-size: 16pt;">List of {{ $Class->current_class }} Students
        </div>

        <table class="table bill-table" style="font-size: 12pt; margin-top:20px;">
            <tr>
                <th style="width: 20px;">S/N</th>
                <th style="width: 100px;">Student ID</th>
                <th style="width: 300px;">Name of Student</th>
                <th style="width: 60px;">Gender</th>
            </tr>
            @foreach ($ClassDetails as $key => $ClassDetail)
                <tr style="font-weight: normal;">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $ClassDetail->student_id }}</td>
                    <td>{{ $ClassDetail->sur_name . ' ' . $ClassDetail->other_names }}</td>
                    <td>{{ $ClassDetail->gender }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
