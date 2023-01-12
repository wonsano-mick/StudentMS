<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use App\Models\StudentScholarshipInfo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $Scholarships   = Scholarship::all();
        return view('scholarships.index', compact('Scholarships'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
            'scholarship' => 'required|unique:scholarships,scholarship'
        ]);

        $ScholarshipData    = new Scholarship;
        $ScholarshipData->scholarship   = Str::of($request->scholarship)->title();

        $ScholarshipData->save();

        Alert::success('Success', 'Scholarship Successfully Added');
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
        $ScholarshipData    = Scholarship::find($id);

        $StudentScholarshipInfo = StudentScholarshipInfo::where('scholarship_name', $ScholarshipData->scholarship);

        $StudentScholarshipInfo->delete();

        $ScholarshipData->delete();

        Alert::success('Success', 'Scholarship Details Successfully Deleted');
        return back();
    }

    // Scholarship List Function
    public function scholarshipList(Request $request, $ScholarshipName)
    {
        $CurrentClass   = CurrentClass::latest()->get();
        $date           = date('d-m-Y');
        $Beneficiaries   = StudentScholarshipInfo::where('scholarship_name', '=', $ScholarshipName)->where('active', 'Yes')->get();
        return view('scholarships.beneficiaries', [
            'CurrentClass' => $CurrentClass,
            'title' => $ScholarshipName,
            'Beneficiaries' => $Beneficiaries,
            'date' => $date
        ]);
    }
}
