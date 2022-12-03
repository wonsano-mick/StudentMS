<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\CurrentClass;
use Illuminate\Http\Request;
use App\Models\HouseOfAffiliation;
use App\Models\StudentSchoolInfo;
use phpDocumentor\Reflection\Types\Null_;
use RealRashid\SweetAlert\Facades\Alert;

class HouseOfAffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Houses = HouseOfAffiliation::latest()->get();
        return view('houses.index', compact('Houses'));
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
            'house_of_affiliation' => 'required|unique:house_of_affiliations,house_of_affiliation'
        ]);

        $House   = new HouseOfAffiliation;
        $House->house_of_affiliation = Str::of($request->house_of_affiliation)->title();
        $House->save();

        Alert::success('Success', 'House Successfully Added');
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
        $HouseData    = HouseOfAffiliation::find($id);

        $StudentHouseInfo = StudentSchoolInfo::where('house_affiliation', $HouseData->house_of_affiliation)->update([
            'house_affiliation' => Null
        ]);

        $HouseData->delete();

        Alert::success('Success', 'House of Affiliation Details Successfully Deleted');
        return back();
    }

    // House List Function
    public function houseList(Request $request, $HouseName)
    {
        $CurrentClass   = CurrentClass::latest()->get();
        $date           = date('d-m-Y');
        $HouseMembers   = StudentSchoolInfo::where('house_affiliation', '=', $HouseName)->where('active', 'Yes')->get();
        return view('houses.house-members', [
            'CurrentClass' => $CurrentClass,
            'title' => $HouseName,
            'HouseMembers' => $HouseMembers,
            'date' => $date
        ]);
    }

    // House Archives
    public function archive(Request $request, $HouseName)
    {
        $date           = date('d-m-Y');
        $HouseMembers   = StudentSchoolInfo::where('house_affiliation', '=', $HouseName)->where('active', 'No')->get();
        return view('houses.archive', [
            'title' => $HouseName,
            'HouseMembers' => $HouseMembers,
            'date' => $date
        ]);
    }
}
