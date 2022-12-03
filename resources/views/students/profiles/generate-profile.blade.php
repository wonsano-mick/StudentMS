<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>{{ Str::slug($StudentDetails->sur_name . '_' . $StudentDetails->other_names) . '_profile' }}</title>
    {{-- Bootstrap core CSS --}}
    <link rel="stylesheet" href="{{ asset('frontend/bootstrap.css') }}">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        table {
            /* border: 2px solid black; */
            text-align: left;
            border: none;
        }

        * {
            box-sizing: border-box;
        }

        .student-table {
            margin: auto;
            width: 50% !important;
        }

        .container {
            font-weight: bold;
            text-align: center;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .student-details {
            font-size: 12pt;
        }

        .profile-img {
            float: right !important;
            position: absolute !important;
            top: 70px !important;
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
            <a href="{{ route('home') }}" target="_blank"
                style="font-size: 18pt;">{{ $SchoolInfoExist->name_of_school }}</a>
        </div>
        <div style="font-size: 8pt;">{{ $SchoolInfoExist->landmark_location_of_school }}</div>
        <div style="font-size: 8pt;">{{ $SchoolInfoExist->town_and_region_location_of_school }}</div>
        <div style="font-size: 8pt;">Digital Address: {{ $SchoolInfoExist->digital_address_of_school }}</div>
        <div style="font-size: 8pt;">Phone: {{ $SchoolInfoExist->phone_number_of_school }}</div>
        <div style="font-size: 8pt;">Email: {{ $SchoolInfoExist->email_of_school }}</div>
        <div style="margin-top: 20px; font-size:16px;">Student's Profile</div>
        <span class="profile-img"><img src="images/students/{{ $StudentDetails->student_image }}" alt="school logo"
                width="150" height="120"></span>
        <table style="width: 400px; font-size: 12pt; margin-top: 20px;">
            <tr>
                <th style="width: 110px;">Personal Info : </th>
                <th style="width: 120px">Surname</th>
                <th style="width: 400px">Other Names</th>
                <th style="width: 10px"></th>
            </tr>
            <tr style="font-weight: normal">
                <td></td>
                <td>{{ ucwords($StudentDetails->sur_name) }}</td>
                <td style="text-align: ">{{ ucwords($StudentDetails->other_names) }}</td>
            </tr>
        </table>
        <table style="width: 400px; font-size: 12pt;">
            <tr>
                <th style="width: 110px"></th>
                <th style="width: 200px;">Student ID</th>
                <th style="width: 120px">Gender</th>
                <th style="width: 410px">Date of Birth</th>
            </tr>
            <tr style="font-weight: normal">
                <td></td>
                <td>{{ $StudentDetails->student_id }}</td>
                <td>{{ $StudentDetails->gender }}</td>
                <td>{{ date('d M Y', strtotime($StudentDetails->date_of_birth)) }}</td>
            </tr>
        </table>
        <table style="width: 400px; font-size: 12pt;">
            <tr>
                <th style="width: 110px"></th>
                <th style="width: 200px;">Date of Admission</th>
                <th style="width: 120px">Class</th>
                <th style="width: 410px">House</th>
            </tr>
            <tr style="font-weight: normal">
                <td></td>
                <td>{{ date('d M Y', strtotime($StudentDetails->date_of_admission)) }}</td>
                <td>{{ $StudentDetails->actual_class }}</td>
                <td>{{ $StudentSchoolData->house_affiliation }}</td>
            </tr>
        </table>
        <hr>
        <table style="width: 400px; font-size: 12pt;">
            <tr>
                <th style="width: 110px;">Parents : </th>
                <th style="width: 250px">Guardian's Name</th>
                <th style="width: 150px">Contact Number</th>
                <th style="width: 10px"></th>
            </tr>
            <tr style="font-weight: normal">
                <td></td>
                <td>{{ ucwords($StudentParentData->name_of_guardian) }}</td>
                <td>{{ $StudentParentData->mobile_number }}</td>
            </tr>
        </table>
        <table style="width: 400px; font-size: 12pt;">
            <tr>
                <th style="width: 110px;"></th>
                <th style="width: 250px">Father's Name</th>
                <th style="width: 150px">Contact Number</th>
                <th style="width: 170px">Occupation</th>
            </tr>
            <tr style="font-weight: normal">
                <td></td>
                <td>{{ $StudentParentData->name_of_father }}</td>
                <td>{{ $StudentParentData->father_mobile_number }}</td>
                <td>{{ $StudentParentData->father_occupation }}</td>
            </tr>
        </table>
        <table style="width: 400px; font-size: 12pt;">
            <tr>
                <th style="width: 110px;"></th>
                <th style="width: 250px">Mother's Name</th>
                <th style="width: 150px">Contact Number</th>
                <th style="width: 170px">Occupation</th>
            </tr>
            <tr style="font-weight: normal">
                <td></td>
                <td>{{ $StudentParentData->name_of_mother }}</td>
                <td>{{ $StudentParentData->mother_mobile_number }}</td>
                <td>{{ $StudentParentData->mother_occupation }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
