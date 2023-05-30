<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserDetails;

class PatientProfileController extends Controller
{
    
    public function index()
    {
        $patient_data=DB::table('users')->join('usersdetails', 'users.id', '=','usersdetails.userId')
        ->where('users.id',Auth::user()->id)
        ->select('users.*', 'usersdetails.address1',
        'usersdetails.address2',
        'usersdetails.zip_code',
        'usersdetails.city_name',
        'usersdetails.state_name',
        'usersdetails.weight',
        'usersdetails.height',
        'usersdetails.allergies',
        'usersdetails.pregnancy',
        'usersdetails.current_medications',
        'usersdetails.driver_license_id',
        'usersdetails.userId','usersdetails.metadata')->first();
        // dd($patient_data);
        return view('home.patient_profile',compact('patient_data'));
    }

    
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        // dd($request,$id);
        DB::transaction(function () use ($id, $request) {
            $user = User::find($id);
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->date_of_birth=$request->dateOfBirth;
            $user->gender=$request->gender;
            $user->phone_number=$request->phonenumber;
            $user->save();

            $userDetails = UserDetails::where('refrence_id', $id)->first();
            if ($userDetails) {
                $userDetails->address1=$request->address1;
                $userDetails->address2=$request->address2;
                $userDetails->zip_code=$request->zip;
                $userDetails->city_name=$request->city;
                $userDetails->state_name=$request->state;
                $userDetails->weight=$request->weight;
                $userDetails->height=$request->height;
                $userDetails->save();
            }            
        });
        return redirect()->back()->with('success', 'Record updated successfully.');
    }

    
    public function destroy($id)
    {
        //
    }

    public function updatePassword(Request $request, $id)
    {
        dd($request);
    }
}
