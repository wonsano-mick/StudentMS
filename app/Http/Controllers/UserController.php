<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\CurrentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
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
        if (Auth::user()->role_as != 'Admin' && Auth::user()->user_level != 'Unlimited') {
            Alert::error('Error', 'Access Denied. Please Contact the Administrator');
            return back();
        }
        $CurrentClass   = CurrentClass::latest()->get();
        $Users      = User::latest()->get();
        return view('users.index', [
            'title' => 'Users',
            'Users' => $Users,
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $User               = new User;
        $User->name         = $request->name;
        $User->email        = $request->email;
        $User->username     = $request->username;
        $User->password     = Hash::make($request->password);
        $User->save();

        Alert::success('Success', 'User Successfully Registered');
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
        $CurrentClass   = CurrentClass::latest()->get();
        $User   = User::find($id);
        return view('users.update', [
            'title' => 'Update User Details',
            'User' => $User,
            'CurrentClass' => $CurrentClass
        ]);
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
        $User   = User::find($id);
        if ($User->email != $request->email) {
            $request->validate([
                'email' => 'required|email:rfc,dns|unique:users,email'
            ]);
        }
        if ($User->username != $request->username) {
            $request->validate([
                'username' => 'required|unique:users,username'
            ]);
        }
        $slug = Str::slug($request->username);

        if ($request->hasFile('user_image')) {
            $image          = $request->file('user_image');
            $newImageName   = uniqid() . '_' . $slug . '.' . $image->getClientOriginalExtension();
            $location       = public_path('/images/users');
            $image->move($location, $newImageName);
            if ($User->user_image != 'avatar.png') {
                $OldImage       = public_path('/images/users/' . $User->user_image);
                unlink($OldImage);
            }
        } else {
            $newImageName   = $request->user_image1;
        }

        $User               = User::find($id);
        $User->name         = ucwords($request->name);
        $User->email        = ucwords($request->email);
        $User->username     = ucwords($request->username);
        $User->user_level   = ucwords($request->user_level);
        $User->role_as      = $request->role_as;
        if (empty($request->paswword)) {
            $User->password  = $User->password;
        } else {
            $User->password = bcrypt($request->password);
        }
        $User->user_image   = $newImageName;
        $Result             = $User->save();

        if ($Result) {

            Alert::success('Success', 'User Details Successfully Updated');
            return redirect()->route('users.index');
        } else {

            Alert::error('Error', 'Oops... User Details Update Failed. Try again!!!');
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User   = User::find($id);
        $User->delete();

        Alert::success('Success', 'User Details Deleted Successfully');
        return back();
    }

    public function idleLogout(Request $request)
    {
        Auth::logout();
        Alert::info('You are being timed-out due to Inactivity', 'Please, Log in Again.');
        return redirect('/login');
    }
}
