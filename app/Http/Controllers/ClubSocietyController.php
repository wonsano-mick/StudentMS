<?php

namespace App\Http\Controllers;

use App\Models\ClubSociety;
use App\Models\StudentClub;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClubSocietyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Clubs   = ClubSociety::all();
        return view('clubs.index', compact('Clubs'));
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
            'name_of_club' => 'required'
        ]);

        $ClubData    = new ClubSociety;
        $ClubData->club   = Str::of($request->name_of_club)->title();

        $ClubData->save();

        Alert::success('Congrats', 'Club/Society Successfully Added');
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

    // Club List Function
    public function clubList(Request $request, $ClubName)
    {
        $CurrentClass   = CurrentClass::latest()->get();
        $date           = date('d-m-Y');
        $Members        = StudentClub::where('name_of_club', '=', $ClubName)->where('active', 'Yes')->get();
        return view('clubs.members', [
            'CurrentClass' => $CurrentClass,
            'title' => $ClubName,
            'Members' => $Members,
            'date' => $date
        ]);
    }
}
