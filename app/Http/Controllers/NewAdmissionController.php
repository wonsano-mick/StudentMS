<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Student;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use App\Models\NewAdmission;
use Illuminate\Http\Request;
use App\Models\SubCurrentClass;
use App\Models\StudentSchoolInfo;
use App\Models\HouseOfAffiliation;
use App\Models\ParentGuidanceInfo;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\Environment\Runtime;

class NewAdmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $NewAdmissions  = NewAdmission::where('admitted', 'No')->get();
        return view('admissions.index', compact('NewAdmissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
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
            'admission_number' => 'required|unique:new_admissions,admission_number',
            'sur_name' => 'required',
            'other_names' => 'required',
            'current_class' => 'required',
            'fees' => 'required',
            'reporting_date' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d,before:toady'
        ]);
        $FeesInWords        = Helper::convertNumber($request->fees);

        $AdmitStudent       = new NewAdmission;
        $AdmitStudent->admission_number     = $request->admission_number;
        $AdmitStudent->sur_name             = ucwords($request->sur_name);
        $AdmitStudent->other_names          = ucwords($request->other_names);
        $AdmitStudent->class                = $request->current_class;
        $AdmitStudent->gender               = $request->gender;
        $AdmitStudent->date_of_birth        = $request->date_of_birth;
        $AdmitStudent->admission_fees       = $request->fees;
        $AdmitStudent->fees_in_words        = $FeesInWords;
        $AdmitStudent->date_of_reporting    = $request->reporting_date;

        $AdmitStudent->save();

        Alert::success('Congrats', 'New Admission Successfully Added');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function register($id)
    {
        $NewStudentData     = NewAdmission::find($id);
        $Houses             = HouseOfAffiliation::all();
        return view('admissions.add', compact('NewStudentData', 'Houses'));
    }

    public function registerStudent(Request $request)
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
        $CutAcademicYear1   = Str::of($AcademicYear)->substr(2, 2);

        // Insert CheckStudent to write code to check existence of student
        $NameOfStudent      = Str::of($request->sur_name . '_' . $request->other_names)->slug('_');
        $CheckStudent       = $NameOfStudent . '_' . $request->gender . '_' . $CurrentClass . '_' . $request->date_of_birth;

        $LastIdQuery            = Student::latest('SN')->first();
        if ($LastIdQuery === null) {
            $SId                = 1;
            $sch_id             = 'KHS';
            $spri_id            = sprintf("%03d", $SId);
            $student_id         = "$sch_id" . "$spri_id" . "$CutAcademicYear1";
        } else {
            $LastId             = $LastIdQuery->SN;
            $sch_id             = 'KHS';
            $pre_sid        = $LastId;
            $SId            = $pre_sid + 1;
            $spri_id            = sprintf("%03d", $SId);
            $student_id         = "$sch_id" . "$spri_id" . "$CutAcademicYear1";
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
        $RegisterStudent->admission_number      = $request->admission_number;
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

        $UpdateAdmissionTable   = NewAdmission::where('admission_number', $request->admission_number)->update([
            'admitted' => 'Yes',
            'date_of_admission' => $request->date_of_admission
        ]);
        Alert::success('Congrats', 'Student Successfully Registered with Student ID: ' . $student_id);
        return redirect()->route('students.index');
        // });
    }

    public function archive()
    {

        $Archives  = NewAdmission::where('admitted', 'Yes')->get();
        return view('admissions.archive', compact('Archives'));
    }
}
