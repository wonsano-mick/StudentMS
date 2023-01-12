<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Scholarship;
use Illuminate\Http\Request;

use App\Models\GraduateStudent;
use App\Models\StudentSchoolInfo;
use App\Models\StudentSportsInfo;
use App\Models\ParentGuidanceInfo;
use App\Models\SchoolPositionInfo;
use function GuzzleHttp\Promise\all;
use App\Models\StudentLastSchoolInfo;
use App\Models\StudentCertificateInfo;
use App\Models\StudentScholarshipInfo;

class GraduateStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $GraduateStudents    = GraduateStudent::all();
        return view('students.graduates.index', compact('GraduateStudents'));
        return view('students.graduates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $GraduateStudents    = Student::all();
        return view('students.graduates.create', compact('GraduateStudents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $request->validate([
            'student_id' => 'required',
            'year_complete' => 'required'
        ]);
        $FetchStudentName   = Student::where('student_id', $request->student_id);
        for ($student_id = 0; $student_id < count($request->student_id); $student_id++) {

            $GraduateDetails   = new GraduateStudent;
            $GraduateDetails->student_id        = $request->student_id[$student_id];
            // $GraduateDetails->year_completed    = $request->year_complete;
            // $GraduateDetails->name_of_student   = $request->student_id[$student_id];

            $GraduateDetails->save();
        }
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

    public function profile($id)
    {
        $StudentData        = GraduateStudent::where('student_id', $id)->first();
        $StudentSchoolData  = StudentSchoolInfo::where('student_id', $id)->first();
        $StudentParentData  = ParentGuidanceInfo::where('student_id', $id)->first();
        $StudentSportsData  = StudentSportsInfo::where('student_id', $id)->get();
        $StudentScholarship = StudentScholarshipInfo::where('student_id', $id)->get();
        $StudentCertificate = StudentCertificateInfo::where('student_id', $id)->get();
        $StudentLastSchool  = StudentLastSchoolInfo::where('student_id', $id)->first();
        $StudentPositions   = SchoolPositionInfo::where('student_id', $id)->orderBy('year', 'DESC')->get();
        $Scholarships       = Scholarship::all();
        return view('students.graduates.profile', compact(
            'StudentData',
            'StudentSchoolData',
            'StudentParentData',
            'StudentSportsData',
            'StudentScholarship',
            'StudentCertificate',
            'StudentLastSchool',
            'Scholarships',
            'StudentPositions'
        ));
    }
}
