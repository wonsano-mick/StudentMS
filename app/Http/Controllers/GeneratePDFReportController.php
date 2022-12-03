<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClubSociety;
use App\Models\Scholarship;
use App\Models\StudentClub;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use App\Models\NewAdmission;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\StudentSchoolInfo;
use App\Models\StudentSportsInfo;
use App\Models\ParentGuidanceInfo;
use App\Models\StudentLastSchoolInfo;
use App\Models\StudentCertificateInfo;
use App\Models\StudentScholarshipInfo;

class GeneratePDFReportController extends Controller
{

    // Generate Class List
    public function printClassList(Request $request, $class_name)
    {

        $Class          = CurrentClass::where('current_class', '=', $class_name)->first();
        $ClassDetails   = Student::where('current_class', '=', $class_name)->orderBy('id', 'DESC')->get();
        $pdf = PDF::loadview('current-classes.print-class-list', [
            'ClassDetails' => $ClassDetails,
            'Class' => $Class
        ]);
        return $pdf->stream(Str::of($Class->current_class)->slug('_') . '_student_list.pdf');
    }

    // Generate Student Profile
    public function printStudentProfile(Request $request, $id)
    {
        $StudentDetails     = Student::where('student_id', $id)->first();
        // dd($StudentDetails->sur_name);
        $StudentSchoolData  = StudentSchoolInfo::where('student_id', $id)->first();
        $StudentParentData  = ParentGuidanceInfo::where('student_id', $id)->first();
        $StudentSportsData  = StudentSportsInfo::where('student_id', $id)->get();
        $StudentScholarship = StudentScholarshipInfo::where('student_id', $id)->get();
        $StudentCertificate = StudentCertificateInfo::where('student_id', $id)->get();
        $StudentLastSchool  = StudentLastSchoolInfo::where('student_id', $id)->first();
        $Clubs              = ClubSociety::all();
        $StudentClubs       = StudentClub::where('student_id', $id)->get();
        $Scholarships       = Scholarship::all();
        $pdf = PDF::loadview('students.profiles.generate-profile', compact(
            'StudentDetails',
            'StudentSchoolData',
            'StudentParentData',
            'StudentSportsData',
            'StudentScholarship',
            'StudentCertificate',
            'StudentLastSchool',
            'Scholarships',
            'Clubs',
            'StudentClubs'
        ));
        return $pdf->stream(Str::of($StudentDetails->sur_name . '_' . $StudentDetails->other_names)->slug('_') . '_profile.pdf');
    }

    public function admissionLetter(Request $request, $id)
    {
        $StudentDetails        = NewAdmission::find($id);
        $pdf = PDF::loadview('admissions.letter', compact(
            'StudentDetails'
        ));
        return $pdf->stream(Str::of($StudentDetails->sur_name . '_' . $StudentDetails->other_names)->slug('_') . '_admission_letter.pdf');
    }
}
