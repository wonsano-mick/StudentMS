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

        .adm-right {
            float: right !important;
            position: absolute !important;
            top: 120px !important;
        }

        .adm-left {
            float: left !important;
            position: absolute !important;
            top: 120px !important;
        }

        .letter-text {
            font-style: normal !important;
            font-weight: normal !important;
            align-content: justify !important;
        }

        .offer {
            text-transform: uppercase;
            text-decoration: underline;
            font-size: 1.5em;
        }

        .sign {
            text-transform: uppercase;
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

        <table style="width: 500px; font-size: 12pt; margin-top: 40px;">
            <tr>
                <th style="width: 400px;">Name of Student :
                    {{ $StudentDetails->sur_name . ' ' . $StudentDetails->other_names }} </th>
                <th style="width: 300px">Date : {{ date('dS F Y') }}</th>
            </tr>
            <tr>
                <th style="width: 450px;">Class of Admission : {{ $StudentDetails->class }}</th>
                <th style="width: 300px">Admission Number : {{ $StudentDetails->admission_number }}</th>
            </tr>
        </table>
        <br>
        <hr>
        <table style="width: 400px; font-size: 12pt;">
            <tr>
                <th style="width: 150px;">Dear Guardian, </th>
            </tr>
        </table>
        <br>
        <p class="offer">offer of admission</p>
        <table style="width: 700px; font-size: 14pt;">
            <p class="letter-text">
                I write on behalf of the Management of {{ $SchoolInfoExist->name_of_school }} to offer your ward
                admission into the school to futher @if ($StudentDetails->gender == 'Male')
                    his
                @else
                    her
                @endif
                education. In connection with this offer,
                you are to note
                the following
                points carefully and endeavour to comply with them.
            </p>
            <P>
            <ol>
                <li class="letter-text">
                    This admission takes effect from
                    <span
                        style="font-weight: bolder">{{ date('dS F, Y', strtotime($StudentDetails->date_of_reporting)) }}</span>,
                    when your ward is expected to report for academic work.
                </li>
                <li class="letter-text">The Fee for the term is
                    <span style="font-weight: bolder">{{ $StudentDetails->fees_in_words }}
                        (GHS {{ number_format($StudentDetails->admission_fees, 2) }}).
                    </span>
                    You are expected to either pay in full or a minimum of fifty percent (50%) by the <span
                        style="font-weight: bolder">REPORTING DAY</span>.
                </li>
                <li class="letter-text">
                    You are to note that, termly fees as determined by the school shall be paid. Failure of which the
                    school reserve the right <span style="font-weight: bolder">to withdraw your ward</span>.
                </li>
                <li class="letter-text">
                    You are to report to the <span style="font-weight: bolder">Headmaster's office with official
                        receipt</span> of Fees payment for your ward to be registered.
                </li>
            </ol>
            </P>
            <p class="letter-text">
                Congratulations on this admission and we wish your ward successful stay with our community.
            </p>
            <br>
            <p class="letter-text">
                Yours faithfully,
            </p><br>
            <p>
                ...................................
            </p>
            <p class="sign">
                mordecai narh
            </p>
            <p class="sign">
                headmaster
            </p>
            <p class="sign">(for: management)</p>
        </table>
    </div>
</body>

</html>
