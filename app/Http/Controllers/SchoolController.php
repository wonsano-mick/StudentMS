<?php

namespace App\Http\Controllers;

use App\Models\SchoolInfo;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // if (Auth::user()->user_level != 'Unlimited') {
        //     Alert::error('Error', 'Access Denied. Please Contact the Administrator');
        //     return back();
        // }
        $CurrentClass   = CurrentClass::latest()->get();
        $SchoolInfo     = SchoolInfo::latest()->first();
        // dd($SchoolInfo->id);
        if ($SchoolInfo !== null) {
            Alert::info('A School is Registered', 'Please Login');
            return redirect('/login');
        }
        return view('school-info.index', [
            'title' => 'School Info',
            'SchoolInfo' => $SchoolInfo,
            'CurrentClass' => $CurrentClass
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $SchoolInfo      = SchoolInfo::latest()->first();
        if ($SchoolInfo !== null) {
            Alert::info('School Registered', 'Please Login');
            return redirect('/login');
        }
        $CurrentClass   = CurrentClass::latest()->get();
        return view('school-info.add', [
            'title' => 'Add School Information',
            'CurrentClass' => $CurrentClass
        ]);
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
            'name_of_school' => 'required',
            'town_and_region_location_of_school' => 'required',
            'digital_address_of_school' => 'required',
            'phone_number_of_school' => 'required',
            'email_of_school' => 'required',
            'name_of_company' => 'required'
        ]);

        DB::transaction(function () use ($request) {

            if ($request->hasFile('logo_of_school')) {
                $image          = $request->file('logo_of_school');
                $newImageName   = uniqid() . '_' . Str::slug($request->name_of_school) . '.' . $image->getClientOriginalExtension();
                $location       = public_path('/images');
                $image->move($location, $newImageName);
            } else {
                $newImageName   = 'avatar.png';
            }

            $InsertSchoolInfo   = new SchoolInfo;
            $InsertSchoolInfo->name_of_school                       = ucwords($request->name_of_school);
            $InsertSchoolInfo->name_of_company                      = ucwords($request->name_of_company);
            $InsertSchoolInfo->landmark_location_of_school          = ucwords($request->landmark_location_of_school);
            $InsertSchoolInfo->town_and_region_location_of_school   = ucwords($request->town_and_region_location_of_school);
            $InsertSchoolInfo->digital_address_of_school            = $request->digital_address_of_school;
            $InsertSchoolInfo->phone_number_of_school               = $request->phone_number_of_school;
            $InsertSchoolInfo->email_of_school                      = ucwords($request->email_of_school);
            // $InsertSchoolInfo->company_ssnit_number                 = $request->company_ssnit_number;
            // $InsertSchoolInfo->company_tin_number                   = $request->company_tin_number;
            // $InsertSchoolInfo->company_bank_name                    = $request->company_bank_name;
            // $InsertSchoolInfo->company_momo_name                    = $request->company_momo_name;
            $InsertSchoolInfo->logo_of_school                       = $newImageName;

            $InsertSchoolInfo->save();
        });

        Alert::success('Success', 'School Successfully Registered');
        return redirect('/home');
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
}
