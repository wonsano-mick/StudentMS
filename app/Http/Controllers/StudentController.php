<?php

namespace App\Http\Controllers;

use App\Models\ClubSociety;
use App\Models\Student;
use App\Models\Scholarship;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use Illuminate\Http\Request;
use App\Models\GraduateStudent;
use App\Models\HouseOfAffiliation;
use App\Models\ParentGuidanceInfo;
use App\Models\StudentCertificateInfo;
use App\Models\StudentClub;
use App\Models\StudentLastSchoolInfo;
use App\Models\StudentScholarshipInfo;
use App\Models\StudentSchoolInfo;
use App\Models\StudentSportsInfo;
use App\Models\SubCurrentClass;
use App\Models\WithdrawnStudent;
use Faker\Core\File;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Students   = Student::all();
        return view('students.index', compact('Students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Scholarships   = Scholarship::all();
        $Houses         = HouseOfAffiliation::all();
        $Classes        = CurrentClass::all();
        return view('students.add', compact('Scholarships', 'Houses', 'Classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sur_name' => 'required',
            'other_names' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d,before:toady',
            'current_class' => 'required',
            'residential_status' => 'required',
            'house_of_affiliation' => 'required',
            'term' => 'required'
        ]);
        // DB::transaction(function () use ($request) {
        $AcademicYear       = date('Y', strtotime($request->date_of_admission));
        $Term               = $request->term;
        $CurrentClass       = $request->current_class;
        $CutAcademicYear    = Str::of($AcademicYear)->substr(2, 2);

        // Insert CheckStudent to write code to check existence of student
        $NameOfStudent      = Str::of($request->sur_name . '_' . $request->other_names)->slug('_');
        $CheckStudent       = $NameOfStudent . '_' . $request->gender . '_' . $CurrentClass . '_' . $request->date_of_birth;

        $LastIdQuery        = Student::latest('SN')->first();
        if ($LastIdQuery === null) {
            $SId            = 1;
            $sch_id         = 'KHS';
            $spri_id        = sprintf("%03d", $SId);
            $student_id     = "$sch_id" . "$spri_id" . "$CutAcademicYear";
        } else {
            $LastId         = $LastIdQuery->SN;
            $sch_id         = 'KHS';
            $pre_sid        = $LastId;
            $SId            = $pre_sid + 1;
            $spri_id        = sprintf("%03d", $SId);
            $student_id     = "$sch_id" . "$spri_id" . "$CutAcademicYear";
        }

        $CheckStudentQuery      = Student::where('check_student', '=', $CheckStudent)->first();
        if ($CheckStudentQuery !== null) {

            Alert::error('Oops', 'A Registered Student has the SAME Details in the same Class');
            return back();
        }
        // Fetch Class ID
        $ClassId        = CurrentClass::where('current_class', '=', $request->current_class)->first();
        $ClassIdFetched = $ClassId->current_class_id;

        // Student Image
        if ($request->hasFile('student_image')) {
            $image          = $request->file('student_image');
            $newImageName   = uniqid() . '_' . Str::slug($request->surname_name . '_' . $request->other_names) . '.' . $image->getClientOriginalExtension();
            $location       = public_path('/images/students');
            $image->move($location, $newImageName);
        } else {
            $newImageName   = 'avatar.png';
        }

        $RegisterStudent    = new Student;
        $RegisterStudent->id                    = $student_id;
        $RegisterStudent->sid                   = $SId;
        $RegisterStudent->sch_id                = $sch_id;
        $RegisterStudent->student_id            = $student_id;
        // $RegisterStudent->admission_number      = $Admission_Number;
        $RegisterStudent->sur_name              = ucwords($request->sur_name);
        $RegisterStudent->other_names           = ucwords($request->other_names);
        $RegisterStudent->gender                = $request->gender;
        $RegisterStudent->date_of_birth         = $request->date_of_birth;
        $RegisterStudent->date_of_admission     = $request->date_of_admission;
        $RegisterStudent->current_class         = $request->current_class;
        $RegisterStudent->sub_current_class     = $request->sub_current_class;
        $RegisterStudent->actual_class          = $request->current_class . ' ' . $request->sub_current_class;
        $RegisterStudent->current_class_id      = $ClassIdFetched;
        $RegisterStudent->term                  = $Term;
        $RegisterStudent->academic_year         = $AcademicYear;
        $RegisterStudent->residential_address   = $request->residential_address;
        $RegisterStudent->check_student         = $CheckStudent;
        $RegisterStudent->religion              = $request->religion;
        $RegisterStudent->denomination          = ucwords($request->denomination);
        $RegisterStudent->student_image         = $newImageName;
        $RegisterStudent->guardian_name         = ucwords($request->name_of_guardian);
        $RegisterStudent->mobile_number         = $request->mobile_number;

        $RegisterStudent->save();

        $StudentGuardian    = new ParentGuidanceInfo;
        $StudentGuardian->student_id        = $student_id;
        $StudentGuardian->student_name      = Str::of($request->sur_name . ' ' . $request->other_names)->title();
        $StudentGuardian->name_of_guardian  = $request->name_of_guardian;
        $StudentGuardian->mobile_number     = $request->mobile_number;

        $StudentGuardian->save();

        $StudentResidential    = new StudentSchoolInfo;
        $StudentResidential->student_id             = $student_id;
        $StudentResidential->student_name           = Str::of($request->sur_name . ' ' . $request->other_names)->title();
        $StudentResidential->gender                 = $request->gender;
        $StudentResidential->residential_status     = $request->residential_status;
        $StudentResidential->house_affiliation      = $request->house_of_affiliation;
        $StudentResidential->current_class          = $CurrentClass;

        $StudentResidential->save();

        $Class_SubClass         = $CurrentClass . ' ' . $request->sub_current_class;
        $SubClass   = SubCurrentClass::where('current_class', $Class_SubClass)->first();
        if ($SubClass == null) {
            $InsertSubClass         = new SubCurrentClass;
            $InsertSubClass->current_class  = $CurrentClass . ' ' . $request->sub_current_class;
            $InsertSubClass->save();
        }
        Alert::success('Congrats', 'Student Successfully Registered with Student ID: ' . $student_id);
        return redirect()->route('students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Scholarships       = Scholarship::all();
        $Houses             = HouseOfAffiliation::all();
        $Classes            = CurrentClass::all();
        $Students           = Student::where('student_id', $id)->first();
        $StudentResidential = StudentSchoolInfo::where('student_id', $id)->first();
        $StudentParent      = ParentGuidanceInfo::where('student_id', $id)->first();
        return view('students.update', compact(
            'Students',
            'StudentResidential',
            'StudentParent',
            'Scholarships',
            'Houses',
            'Classes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sur_name' => 'required',
            'other_names' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d,before:toady',
            'current_class' => 'required'
        ]);
        // dd($request->all());
        // DB::transaction(function () use ($request, $id) {

        $Student            = Student::where('student_id', $id)->first();
        $AcademicYear       = date('Y', strtotime($request->date_of_admission));
        $Term               = $request->term;
        $CurrentClass       = $request->current_class;
        $CutAcademicYear    = Str::of($AcademicYear)->substr(2, 2);

        // Insert CheckStudent to write code to check existence of student
        $NameOfStudent      = Str::of($request->sur_name . '_' . $request->other_names)->slug('_');
        $CheckStudent       = $NameOfStudent . '_' . $request->gender . '_' . $CurrentClass . '_' . $request->date_of_birth;

        $LastIdQuery            = Student::latest('SN')->first();
        if ($LastIdQuery === null) {
            $SId                = 1;
            $sch_id             = 'KHS';
            $spri_id            = sprintf("%03d", $SId);
            $student_id         = "$sch_id" . "$spri_id" . "$CutAcademicYear";
        } else {
            $LastId             = $LastIdQuery->SN;
            $sch_id             = 'KHS';
            $pre_sid        = $LastId;
            $SId            = $pre_sid + 1;
            $spri_id            = sprintf("%03d", $SId);
            $student_id         = "$sch_id" . "$spri_id" . "$CutAcademicYear";
        }
        if ($student_id !== $Student->student_id) {
            $StudentId  = $student_id;
        } else {
            $StudentId = $Student->student_id;
        }
        $ClassId        = CurrentClass::where('current_class', '=', $request->current_class)->first();
        $ClassIdFetched = $ClassId->current_class_id;

        //Student Image
        if ($request->hasFile('student_image')) {
            $image          = $request->file('student_image');
            $newImageName   = uniqid() . '_' . Str::slug($request->sur_name . '_' . $request->other_names) . '.' . $image->getClientOriginalExtension();
            $location       = public_path('/images/students');
            $image->move($location, $newImageName);
            if ($Student->student_image != 'avatar.png') {
                $OldImage       = public_path('/images/students/' . $Student->student_image);
                unlink($OldImage);
            }
        } else {
            $newImageName   = $request->student_image1;
        }

        $RegisterStudent    = Student::find($id);
        $RegisterStudent->student_id            = $StudentId;
        $RegisterStudent->sur_name              = ucwords($request->sur_name);
        $RegisterStudent->other_names           = ucwords($request->other_names);
        $RegisterStudent->gender                = $request->gender;
        $RegisterStudent->date_of_birth         = $request->date_of_birth;
        $RegisterStudent->date_of_admission     = $request->date_of_admission;
        $RegisterStudent->current_class         = $request->current_class;
        $RegisterStudent->current_class_id      = $ClassIdFetched;
        $RegisterStudent->sub_current_class     = $request->sub_current_class;
        $RegisterStudent->actual_class          = $request->current_class . ' ' . $request->sub_current_class;
        $RegisterStudent->term                  = $Term;
        $RegisterStudent->academic_year         = $AcademicYear;
        $RegisterStudent->residential_address   = $request->residential_address;
        // $RegisterStudent->check_student         = $CheckStudent;
        $RegisterStudent->religion              = $request->religion;
        $RegisterStudent->denomination          = ucwords($request->denomination);
        $RegisterStudent->guardian_name         = ucwords($request->name_of_guardian);
        $RegisterStudent->mobile_number         = $request->mobile_number;
        $RegisterStudent->student_image         = $newImageName;

        $RegisterStudent->save();

        $StudentGuardian    = ParentGuidanceInfo::where('student_id', $id)->first();
        if ($StudentGuardian !== null) {
            $UpdateStudentGuardian    = ParentGuidanceInfo::where('student_id', $id)->update([
                'student_id' => $StudentId,
                'student_name' => Str::of($request->sur_name . ' ' . $request->other_names)->title(),
                'name_of_guardian' => $request->name_of_guardian,
                'mobile_number' => $request->mobile_number
            ]);
        } else {
            $StudentGuardian    = new ParentGuidanceInfo;
            $StudentGuardian->student_id        = $id;
            $StudentGuardian->student_name      = Str::of($request->sur_name . ' ' . $request->other_names)->title();
            $StudentGuardian->name_of_guardian  = $request->name_of_guardian;
            $StudentGuardian->mobile_number     = $request->mobile_number;

            $StudentGuardian->save();
        }

        $StudentResidential    = StudentSchoolInfo::where('student_id', $id)->first();
        if ($StudentResidential !== null) {
            $UpdateStudentResidential    = StudentSchoolInfo::where('student_id', $id)->update([
                'student_id' => $StudentId,
                'student_name'           => Str::of($request->sur_name . ' ' . $request->other_names)->title(),
                'residential_status'     => $request->residential_status,
                'house_affiliation'      => $request->house_of_affiliation,
                'gender'                => $request->gender
            ]);
        } else {
            $StudentResidential    = new StudentSchoolInfo;
            $StudentResidential->student_id             = $id;
            $StudentResidential->student_name           = Str::of($request->sur_name . ' ' . $request->other_names)->title();
            $StudentResidential->residential_status     = $request->residential_status;
            $StudentResidential->house_affiliation      = $request->house_of_affiliation;
            $StudentResidential->current_class          = $CurrentClass;
            $StudentResidential->gender                 = $request->gender;

            $StudentResidential->save();
        }

        $Class_SubClass         = $CurrentClass . ' ' . $request->sub_current_class;
        $SubClass   = SubCurrentClass::where('current_class', $Class_SubClass)->first();
        if ($SubClass == null) {
            $InsertSubClass         = new SubCurrentClass;
            $InsertSubClass->current_class  = $CurrentClass . ' ' . $request->sub_current_class;
            $InsertSubClass->save();
        }
        Alert::success('Congrats', 'Student Details Successfully Updated ');
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'reason' => 'required',
            'date_of_delete' => 'required'
        ]);
        $year_completed = date('Y', strtotime($request->date_of_delete));
        $StudentData    = Student::where('student_id', $request->student_id)->first();
        if ($request->reason == 'Graduated') {
            $GraduateStudent    = new GraduateStudent;
            $GraduateStudent->student_id            = $request->student_id;
            $GraduateStudent->admission_number      = $StudentData->admission_number;
            $GraduateStudent->sur_name              = $StudentData->sur_name;
            $GraduateStudent->other_names           = $StudentData->other_names;
            $GraduateStudent->gender                = $StudentData->gender;
            $GraduateStudent->date_of_birth         = $StudentData->date_of_birth;
            $GraduateStudent->date_of_admission     = $StudentData->date_of_admission;
            $GraduateStudent->current_class         = $request->reason;
            $GraduateStudent->year_completed        = $year_completed;
            $GraduateStudent->residential_address   = $StudentData->residential_address;
            $GraduateStudent->religion              = $StudentData->religion;
            $GraduateStudent->denomination          = $StudentData->denomination;
            $GraduateStudent->student_image         = $StudentData->student_image;
            $GraduateStudent->guardian_name         = $StudentData->guardian_name;
            $GraduateStudent->mobile_number         = $StudentData->mobile_number;

            $GraduateStudent->save();

            $Sports     = StudentSportsInfo::where('student_id', $request->student_id)->first();
            if ($Sports !== null) {
                $UpdateSports   = StudentSportsInfo::where('student_id', $request->student_id)->update([
                    'current_class' => $request->reason
                ]);
            }

            $Scholarship    = StudentScholarshipInfo::where('student_id', $request->student_id)->first();
            if ($Scholarship !== null) {
                $updateScholarship  = StudentScholarshipInfo::where('student_id', $request->student_id)->update([
                    'current_class' => $request->reason,
                    'active' => 'No'
                ]);
            }

            $SchoolInfo    = StudentSchoolInfo::where('student_id', $request->student_id)->first();
            if ($SchoolInfo !== null) {
                $updateSchoolInfo  = StudentSchoolInfo::where('student_id', $request->student_id)->update([
                    'current_class' => $request->reason,
                    'active' => 'No',
                    'exit_date' => date('d M Y', strtotime($request->date_of_delete))
                ]);
            }
            $StudentData->delete();
            Alert::success('Congrats', ucwords($request->name_of_student) . '\'s Details Successfully Removed ');
            return redirect()->route('students.index');
        }

        if ($request->reason == 'Withdrawn' || $request->reason == 'Dismissed') {

            $ExitStudent    = new WithdrawnStudent;
            $ExitStudent->student_id            = $request->student_id;
            $ExitStudent->admission_number      = $StudentData->admission_number;
            $ExitStudent->sur_name              = $StudentData->sur_name;
            $ExitStudent->other_names           = $StudentData->other_names;
            $ExitStudent->gender                = $StudentData->gender;
            $ExitStudent->date_of_birth         = $StudentData->date_of_birth;
            $ExitStudent->date_of_admission     = $StudentData->date_of_admission;
            $ExitStudent->class_before          = $StudentData->actual_class;
            $ExitStudent->current_class         = $request->reason;
            $ExitStudent->date_of_exit          = $request->date_of_delete;
            $ExitStudent->residential_address   = $StudentData->residential_address;
            $ExitStudent->religion              = $StudentData->religion;
            $ExitStudent->denomination          = $StudentData->denomination;
            $ExitStudent->student_image         = $StudentData->student_image;
            $ExitStudent->guardian_name         = $StudentData->guardian_name;
            $ExitStudent->mobile_number         = $StudentData->mobile_number;

            $ExitStudent->save();

            $Sports     = StudentSportsInfo::where('student_id', $request->student_id)->first();
            if ($Sports !== null) {
                $UpdateSports   = StudentSportsInfo::where('student_id', $request->student_id)->update([
                    'current_class' => $request->reason
                ]);
            }

            $Scholarship    = StudentScholarshipInfo::where('student_id', $request->student_id)->first();
            if ($Scholarship !== null) {
                $updateScholarship  = StudentScholarshipInfo::where('student_id', $request->student_id)->update([
                    'current_class' => $request->reason,
                    'active' => 'No'
                ]);
            }

            $SchoolInfo    = StudentSchoolInfo::where('student_id', $request->student_id)->first();
            if ($SchoolInfo !== null) {
                $updateSchoolInfo  = StudentSchoolInfo::where('student_id', $request->student_id)->update([
                    'current_class' => $request->reason,
                    'active' => 'No',
                    'exit_date' => date('d M Y', strtotime($request->date_of_delete))
                ]);
            }
            $StudentData->delete();
            Alert::success('Congrats', ucwords($request->name_of_student) . '\'s Details Successfully Removed ');
            return redirect()->route('students.index');
        }
    }

    /*=================================================================================================
                Student Profile Codes
    ==================================================================================================*/

    public function profile($id)
    {
        $StudentData        = Student::find($id);
        $StudentSchoolData  = StudentSchoolInfo::where('student_id', $id)->first();
        $StudentParentData  = ParentGuidanceInfo::where('student_id', $id)->first();
        $StudentSportsData  = StudentSportsInfo::where('student_id', $id)->get();
        $StudentScholarship = StudentScholarshipInfo::where('student_id', $id)->get();
        $StudentCertificate = StudentCertificateInfo::where('student_id', $id)->get();
        $StudentLastSchool  = StudentLastSchoolInfo::where('student_id', $id)->first();
        $Clubs              = ClubSociety::all();
        $StudentClubs       = StudentClub::where('student_id', $id)->get();
        $Scholarships       = Scholarship::all();
        return view('students.profiles.profile', compact(
            'StudentData',
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
    }

    public function createSports(Request $request)
    {
        $request->validate([
            'name_of_sports' => 'required',
            'sports_discipline' => 'required'
        ]);

        $InsertSports   = new StudentSportsInfo;
        $InsertSports->student_id           = $request->student_id;
        $InsertSports->student_name         = ucwords($request->name_of_student);
        $InsertSports->current_class        = $request->current_class;
        $InsertSports->sports_academy       = ucwords($request->name_of_sports);
        $InsertSports->sports_discipline    = ucwords($request->sports_discipline);

        $InsertSports->save();
        Alert::success('Congrats', 'Sports Details is successfully Added !!');
        return back();
    }

    public function deleteSports($id)
    {
        $SportsData     = StudentSportsInfo::find($id);
        $SportsData->delete();

        Alert::success('Congrats', 'Sports Details Removed successfully!!');
        return back();
    }

    public function createScholarship(Request $request)
    {
        $request->validate([
            'scholarship_name' => 'required',
            'scholarship_status' => 'required',
            'start_year' => 'required',
            'end_year' => 'required'
        ]);

        $InsertScholarship  = new StudentScholarshipInfo;
        $InsertScholarship->student_id          = $request->student_id;
        $InsertScholarship->current_class       = $request->current_class;
        $InsertScholarship->student_name        = ucwords($request->name_of_student);
        $InsertScholarship->scholarship_name    = Str::of($request->scholarship_name)->title();
        $InsertScholarship->description         = $request->description;
        $InsertScholarship->scholarship_status  = $request->scholarship_status;
        $InsertScholarship->start_year          = $request->start_year;
        $InsertScholarship->end_year            = $request->end_year;

        $InsertScholarship->save();

        Alert::success('Congrats', 'Scholarship Details is successfully Added !!');
        return back();
    }

    public function deleteScholarship($id)
    {
        $StudentSchoolData = StudentScholarshipInfo::find($id);
        $StudentSchoolData->delete();

        Alert::success('Congrats', 'Scholarship Details Removed successfully!!');
        return back();
    }

    public function editParents(Request $request, $id)
    {
        $UpdateParentsInfo  = ParentGuidanceInfo::where('student_id', $request->student_id)->update([
            'name_of_father' => Str::of($request->name_of_father)->title(),
            'father_mobile_number' => $request->father_mobile_number,
            'father_occupation' => Str::of($request->father_occupation)->title(),
            'name_of_mother' => Str::of($request->name_of_mother)->title(),
            'mother_mobile_number' => $request->mother_mobile_number,
            'mother_occupation' => Str::of($request->mother_occupation)->title()
        ]);

        Alert::success('Congrats', 'Parents Details is successfully Updated !!');
        return back();
    }

    public function createCertificate(Request $request)
    {
        $request->validate([
            'certificate_name' => 'required',
            'awarding_institution' => 'required',
            'date_of_award' => 'required'
        ]);

        $InsertCert     = new StudentCertificateInfo;
        $InsertCert->student_id             = $request->student_id;
        $InsertCert->student_name           = ucwords($request->name_of_student);
        $InsertCert->certificate_name       = ucwords($request->certificate_name);
        $InsertCert->awarding_institution   = ucwords($request->awarding_institution);
        $InsertCert->date_of_award          = $request->date_of_award;

        $InsertCert->save();

        Alert::success('Congrats', 'Certificate Details is successfully Updated !!');
        return back();
    }
    public function deleteCert($id)
    {
        $StudentCertData = StudentCertificateInfo::find($id);
        $StudentCertData->delete();

        Alert::success('Congrats', 'Certificate Details Removed successfully!!');
        return back();
    }

    public function createLastSchool(Request $request)
    {
        $request->validate([
            'last_school_attended' => 'required',
            'date_of_last_school_exit' => 'required',
            'reason_for_exit' => 'required'
        ]);

        $InsertLastSchoolData   = new StudentLastSchoolInfo;
        $InsertLastSchoolData->student_id               = $request->student_id;
        $InsertLastSchoolData->student_name             = ucwords($request->name_of_student);
        $InsertLastSchoolData->last_school_attended     = ucwords($request->last_school_attended);
        $InsertLastSchoolData->date_of_last_school_exit = $request->date_of_last_school_exit;
        $InsertLastSchoolData->reason_for_exit          = ucwords($request->reason_for_exit);

        $InsertLastSchoolData->save();

        Alert::success('Congrats', 'Last School Details Removed successfully!!');
        return back();
    }

    public function editLastSchool(Request $request, $id)
    {
        $request->validate([
            'last_school_attended' => 'required',
            'date_of_last_school_exit' => 'required',
            'reason_for_exit' => 'required'
        ]);

        $UpdateLastSchoolData   = StudentLastSchoolInfo::where('student_id', $id)->update([
            'last_school_attended' => ucwords($request->last_school_attended),
            'date_of_last_school_exit' => $request->date_of_last_school_exit,
            'reason_for_exit' => ucwords($request->reason_for_exit)
        ]);

        Alert::success('Congrats', 'Last School Details Updated successfully!!');
        return back();
    }

    public function deleteShow($id)
    {

        $StudentData    = Student::where('student_id', $id)->first();
        return view('students.confirm-delete', compact('StudentData'));
    }


    public function createClub(Request $request)
    {
        $request->validate([
            'name_of_club' => 'required',
            'position' => 'required',
            'year' => 'required'
        ]);

        $InsertClub  = new StudentClub;
        $InsertClub->student_id          = $request->student_id;
        $InsertClub->current_class       = $request->current_class;
        $InsertClub->student_name        = ucwords($request->name_of_student);
        $InsertClub->name_of_club        = Str::of($request->name_of_club)->title();
        $InsertClub->position            = ucwords($request->position);
        $InsertClub->year                = $request->year;

        $InsertClub->save();

        Alert::success('Congrats', 'Club Details is successfully Added !!');
        return back();
    }
    public function deleteClub($id)
    {
        $StudentClubData = StudentClub::find($id);
        $StudentClubData->delete();

        Alert::success('Congrats', 'Club Details Removed successfully!!');
        return back();
    }
    /*=========================================================================================================
            Withdrwan and Dismissed Students
========================================================================================================*/
    public function withdrawnStudents()
    {
        $CurrentClass       = CurrentClass::latest()->get();
        $WithdrawnStudents  = WithdrawnStudent::where('current_class', 'Withdrawn')->get();
        return view('students.withdrawn-students', [
            'title' => 'Withdrawn Students',
            'CurrentClass' => $CurrentClass,
            'WithdrawnStudents' => $WithdrawnStudents
        ]);
    }

    public function withdrawnProfile($id)
    {
        $StudentData        = WithdrawnStudent::where('student_id', $id)->first();
        $StudentSchoolData  = StudentSchoolInfo::where('student_id', $id)->first();
        $StudentParentData  = ParentGuidanceInfo::where('student_id', $id)->first();
        $StudentSportsData  = StudentSportsInfo::where('student_id', $id)->get();
        $StudentScholarship = StudentScholarshipInfo::where('student_id', $id)->get();
        $StudentCertificate = StudentCertificateInfo::where('student_id', $id)->get();
        $StudentLastSchool  = StudentLastSchoolInfo::where('student_id', $id)->first();
        $Scholarships       = Scholarship::all();
        return view('students.dismissedprofile', compact(
            'StudentData',
            'StudentSchoolData',
            'StudentParentData',
            'StudentSportsData',
            'StudentScholarship',
            'StudentCertificate',
            'StudentLastSchool',
            'Scholarships'
        ));
    }

    public function dismissedStudents()
    {
        $CurrentClass       = CurrentClass::latest()->get();
        $DismissedStudents  = WithdrawnStudent::where('current_class', 'Dismissed')->get();
        return view('students.dismissed-students', [
            'title' => 'Dismissed Students',
            'CurrentClass' => $CurrentClass,
            'DismissedStudents' => $DismissedStudents
        ]);
    }

    public function dismissedProfile($id)
    {
        $StudentData        = WithdrawnStudent::where('student_id', $id)->first();
        $StudentSchoolData  = StudentSchoolInfo::where('student_id', $id)->first();
        $StudentParentData  = ParentGuidanceInfo::where('student_id', $id)->first();
        $StudentSportsData  = StudentSportsInfo::where('student_id', $id)->get();
        $StudentScholarship = StudentScholarshipInfo::where('student_id', $id)->get();
        $StudentCertificate = StudentCertificateInfo::where('student_id', $id)->get();
        $StudentLastSchool  = StudentLastSchoolInfo::where('student_id', $id)->first();
        $Scholarships       = Scholarship::all();
        return view('students.dismissedprofile', compact(
            'StudentData',
            'StudentSchoolData',
            'StudentParentData',
            'StudentSportsData',
            'StudentScholarship',
            'StudentCertificate',
            'StudentLastSchool',
            'Scholarships'
        ));
    }

    /*=================================================================================================
                Student Population Statistics Codes
    =================================================================================================*/
    public function males()
    {
        return view('students-stats.male');
    }



    /*===============================================================================================================
                Set Term and Academic Year
    ===============================================================================================================*/

    public function term()
    {
        return view('set-terms.index', [
            'title' => 'Set Term'
        ]);
    }
    public function setTerm(Request $request)
    {
        $request->validate([
            'term' => 'required',
            'academic_year' => 'required'
        ]);
        $TermQuery      = Student::where('term', '=', $request->term)->first();
        if ($TermQuery !== null) {
            Alert::error('Error', 'The ' . $request->term . ' is Already Set. Please, Set a different Term');
            return back();
        }
        if ($request->term === 'Second Term' || $request->term === 'Third Term') {
            $QueryStudent       = Student::all();
            foreach ($QueryStudent as $StudentRow) {
                $UpdateStudent      = Student::where('current_class', '=', $StudentRow->current_class)->update([
                    'term' => $request->term,
                ]);
            }
            Alert::success('Congrats', $request->term . ' for ' . $request->academic_year . ' is Successfully Set !!');
            return redirect()->route('/home');
        } else {
            $QueryStudent       = Student::all();
            foreach ($QueryStudent as $StudentRow) {
                $UpdateStudent      = Student::where('current_class', '=', $StudentRow->current_class)->update([
                    'academic_year' => $request->academic_year,
                ]);
            }
            foreach ($QueryStudent as $Student) {
                if ($Student->current_class == 'Graduate') {
                    $NewClassId = $Student->current_class_id;
                } else {
                    $NewClassId     = $Student->current_class_id + 1;
                }

                $FetchClass     = CurrentClass::where('id', '=', $NewClassId)->get();
                foreach ($FetchClass as $NewClass) {

                    $UpdateClass      = Student::where('student_id', '=', $Student->student_id)->update([
                        'current_class_id' => $NewClassId,
                        'current_class' => $NewClass->current_class,
                        'actual_class' => $NewClass->current_class . ' ' . $Student->sub_current_class,
                        'term' => $request->term
                    ]);
                    $UpdateSports   = StudentSportsInfo::where('student_id', $Student->student_id)->update([
                        'current_class' => $NewClass->current_class . ' ' . $Student->sub_current_class
                    ]);
                    $updateScholarship  = StudentScholarshipInfo::where('student_id', $Student->student_id)->update([
                        'current_class' => $NewClass->current_class . ' ' . $Student->sub_current_class
                    ]);
                    $updateSchoolInfo  = StudentSchoolInfo::where('student_id', $Student->student_id)->update([
                        'current_class' => $NewClass->current_class . ' ' . $Student->sub_current_class
                    ]);
                }
            }
            Alert::success('Congrats', $request->term . ' for ' . $request->academic_year . ' is Successfully Set !!');
            return redirect()->route('home');
        }
    }
}
