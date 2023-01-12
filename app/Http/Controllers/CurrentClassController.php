<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\CurrentClass;
use App\Models\Student;
use App\Models\SubCurrentClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CurrentClassController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $CurrentClass   = CurrentClass::latest()->get();
        return view('current-classes.index', [
            'title' => 'Class',
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
        $CurrentClass   = CurrentClass::latest()->get();
        return view('current-classes.add', [
            'title' => 'Wonsano SFMS | Add New Class',
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
            'current_class' => 'required|unique:current_classes,current_class'
        ]);
        $LastClassId    = CurrentClass::latest()->where('current_class_id', '!=', null)->orderBy('current_class_id', 'DESC')->first();

        $current_class  = ucwords($request->current_class);
        if ($LastClassId == null) {
            $current_class_id   = 1;
        } else {
            if ($current_class == 'Graduate') {
                $current_class_id   = null;
            } else {
                $current_class_id   = $LastClassId->current_class_id + 1;
            }
        }
        $InsertCurrentClass     = new CurrentClass;
        $InsertCurrentClass->current_class_id   = $current_class_id;
        $InsertCurrentClass->current_class      = $current_class;

        $InsertCurrentClass->save();

        // $InsertSubClass         = new SubCurrentClass;
        // $InsertSubClass->current_class  = $current_class . ' ' . $request->sub_current_class;

        // $InsertSubClass->save();

        Alert::success('Success', 'Class Successfully Added');
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
        $Class              = CurrentClass::find($id);
        // $ClassBillExist     = Student::where('current_class', '=', $Class->current_class)->first();

        // if ($ClassBillExist != null) {

        //     Alert::error('Error', 'Sorry... This Class can no be DELETED');
        //     return back();
        // } else {

        $Class->delete();
        // }
        Alert::success('Success', $Class->current_class . '\'s Details Successfully DELETED');
        return back();
    }

    // Class List Function
    public function classList(Request $request, $ClassName)
    {
        $CurrentClass   = SubCurrentClass::latest()->get();
        $date           = date('d-m-Y');
        $ClassMembers   = Student::where('actual_class', '=', $ClassName)->get();
        return view('current-classes.class-members', [
            'CurrentClass' => $CurrentClass,
            'title' => $ClassName,
            'ClassMembers' => $ClassMembers,
            'date' => $date
        ]);
    }
}
