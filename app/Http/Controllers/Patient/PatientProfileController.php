<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use App\Models\User;
use App\Models\UserDetails;
use function helper;
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
        return view('home.patient_profile',compact('patient_data'));
    }


    public function create(){}


    public function store(Request $request){}


    public function show($id){}


    public function edit($id){}


    public function update(Request $request, $id)
    {
        // dd($request,$id);
        DB::transaction(function () use ($id, $request) {
            $user = User::find($id);
            $user->name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->email=$request->email;
            $user->date_of_birth=$request->dateOfBirth;
            $user->gender=$request->gender;
            $user->phone_number=$request->phonenumber;
            $user->save();

            $userDetails = UserDetails::where('userId', $id)->first();
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

            if ($request->gender == 0) {
                $gender = 'hello';
            } elseif ($request->gender == 1) {
                $gender = 'Mr';
            } elseif ($request->gender == 2) {
                $gender = 'Mrs';
            } elseif ($request->gender == 9) {
                $gender = 'Not';
            }

            $json = array(
                "prefix"=> $gender,
                "first_name"=> $request->first_name,
                "last_name"=> $request->last_name,
                "gender"=> $request->gender,
                "date_of_birth"=> "2023-20-05",
                "active"=> false,
                "weight"=> $request->weight,
                "height"=> $request->height,
                "metadata"=> "patient number 200",
                "email"=> $request->email,
                "phone_number"=> $request->phonenumber,
                "phone_type"=> 2,
                "address"=> array(
                    "address"=> $request->address1,
                    "address2"=> $request->address2,
                    "zip_code"=> $request->zip,
                    "city_id"=> "9f3c4995-8416-4d19-a1e0-3d469afa3a7b",
                    "city_name"=> $request->city,
                    "state_name"=> $request->state
                ),
                "current_medications"=> "paracetamol",
                "allergies"=> "polen",
                "pregnancy"=> false
            );

            $json = json_encode($json);

           

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/patients/?patient_id=83cd9225-e25a-4392-aaf7-9080d8f84aa4',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer' . ' ' . getToken(),
                'Accept: application/json',
                'Content-Type: application/json'
            ),
            ));
            $response_patient = curl_exec($curl);

            curl_close($curl);
            dd($response_patient,getToken(),$json,$request->dateOfBirth);
            dd($response_patient);
        });
        return redirect()->back()->with('success', 'Record updated successfully.');
    }


    public function destroy($id){}

    public function updatePassword(Request $request, $id)
    {

        DB::transaction(function () use ($id, $request) {
            $user = User::find($id);
                if (Hash::check($request->password, $user->password)) {
                    $user->password = Hash::make($request->newpassword);
                    alert()->success('Data Saved', 'Success')->persistent('Close');
                } else {
                    alert()->warning('Wrong Old Password', 'Warning')->persistent('Close');
                }
            $user->save();
        dd($request, $id, Hash::make($request->password));
        });
        return redirect()->back()->with('success', 'Record updated successfully.');
    }
}
