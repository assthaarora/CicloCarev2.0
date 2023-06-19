<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PatientInfoStore;
use function helper;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\DB;

class PatientPersonalInfo extends Controller
{
    
    public function index($email,$mId,$bId,$qId)
    {
        $email=decrypt($email);
        $mId=decrypt($mId);
        $bid=decrypt($bId);
        // $bid=DB::table('genral_admin_medicinedetails')->where('id',$mId)->pluck('userId')->first();
        return view('patient/personalInfor',compact('email','mId','bid','qId'));
    }

    public function create(){}

    public function store(Request $request)
    {
        $token =getToken();
        //dd($request,$token);
        ################################################Patient Creation#####################################################################
        $gender = "";
        if ($request['gender'] == 0) {
            $gender = '';
        } elseif ($request['gender'] == 1) {
            $gender = 'Mr';
        } elseif ($request['gender'] == 2) {
            $gender = 'Mrs';
        } elseif ($request['gender'] == 9) {
            $gender = 'Not';
        }
        $preg = "";
        if ($request['pregnancy'] == 'y') {
            $preg =true;
        } elseif ($request['pregnancy'] == 'n') {
            $preg =false;
        } 
         //Patient Api Data
         $api_data = [
            'prefix' => $gender,
            'first_name' => $request['firstname'],
            'last_name' => $request['lastname'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'date_of_birth' => $request['dob'],
            'driver_license_id' => '',
            'gender' => (int)($request['gender']),
            'metadata' => 'CicloCare Patient',
            'phone_number' => $request['phone'],
            'phone_type' => $request['phntype'],
            'address' => [
                'address' => $request['address1'],
                'address2' => $request['address2'],
                'zip_code' => $request['zip'],
                'city_name' => $request['city'],
                'state_name' => $request['state'],
            ],
            'weight' => $request['weight'],
            'height' => $request['height'],
            'allergies' => $request['allergeis'],
            'pregnancy' => $preg,
            'current_medications' => $request['c_med'],
        ];

        $userId=0;


        DB::transaction(function () use ( $gender, $token, $request,$api_data,&$userId) {
            // Store Data to our DB first to get details for Metadata for api hit 
            // ****************************Patient Api ***********************************
            $json = json_encode($api_data);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/patients',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_POSTFIELDS => $json,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer' . ' ' . $token,
                    'Accept: application/json',
                    'Content-Type: application/json'
                ),
            ));
            $response_patient = curl_exec($curl);
            curl_close($curl);
            $user = User::create([
                'prefix' => $gender,
                'name' => $request['firstname'],
                'last_name' => $request['lastname'],
                'email' => $request['email'],
                'date_of_birth' => $request['dob'],
                'gender' => $request['gender'],
                'phone_number' => $request['phone'],
                'phone_type' => $request['phntype'],
                'password' => Hash::make($request['password']),
                'role' => 3,
                'customer_of' => $request->bid,
            ]);
            $userId=$user->id;
            $apiresponse = checkResponse($response_patient);
            $data = json_decode($response_patient, true);
            if ($apiresponse['success']) {
                $userDetails =UserDetails::create([
                    'driver_license_id' => '',
                    'userId' => $user->id,
                    'metadata' => 'CicloCare Patient'.$user->id,
                    'address1' => $request['address1'],
                    'address2' => $request['address2'],
                    'zip_code' => $request['zip'],
                    'city_name' => $request['city'],
                    'state_name' => $request['state'],
                    'weight' => $request['weight'],
                    'height' => $request['height'],
                    'bmi'=>$request['bmi'],
                    'allergies' => $request['allergeis'],
                    'pregnancy' => $request['pregnancy'],
                    'current_medications' => $request['c_med'],
                    'mdi_patientId'=>$data['patient_id']
                ]);
                $savedRowId = $userDetails->id;
                // dd($apiresponse['message']);
                alert()->success('Patient Registered')->autoclose(3500);
                
            } else {
                dd($apiresponse['message']);
                alert()->error($apiresponse['message']);
            }
            
        });
        return redirect()->route('form',['userId' =>encrypt($userId),'mId' => encrypt($request->mId),'qId' => $request->qId]);
   
        }

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}
}
