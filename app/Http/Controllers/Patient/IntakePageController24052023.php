<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\IntakeFormAnswer;
use App\Models\StoreMedications;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\DocumentUpload;
use Illuminate\Support\Facades\DB;


// use JsValidator;

class IntakePageController extends Controller
{

    public function index($email)
    {
        // $disease_name="";
        // $data=[];
        // $all_medicine=[];
        // return view('patient/intakeform', compact('disease_name','data', 'all_medicine'));
        //Dynamic Token Generation starts
        $dynamic_token_body = [
            'grant_type' => 'client_credentials',
            'client_id' => '98ed9674-0727-40e0-abee-46b7271c8424',
            'client_secret' => 'sEAXrJW1FP6bylpACsvlkvE82juQS3F5XNbFSOv5',
            'scope' => '*'
        ];

        $json_token = json_encode($dynamic_token_body);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/auth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $json_token,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));
        $response_token = curl_exec($curl);
        curl_close($curl);
        //Dynamic Token Generation ends
        $token = json_decode($response_token)->access_token;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/questionnaires',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer' . ' ' . $token
            )
        ));


        $response = curl_exec($curl);
        $disease_name = json_decode($response)[0]->name;
        $medication_ids = json_decode($response)[0]->offerings->medications;
        $partner_quest_id = json_decode($response)[0]->partner_questionnaire_id;

        // foreach(json_decode($response) as $k=>$v){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/questionnaires/' . $partner_quest_id . '/questions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Bearer' . ' ' . $token
            ),
        ));

        $response = curl_exec($curl);
        $data = json_decode($response);


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/medications',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer' . ' ' . $token,
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $all_medicine = [];
        foreach (json_decode($response) as $k => $val) {
            if (in_array($val->partner_medication_id, array_column($medication_ids, 'partner_medication_id'))) {
                $all_medicine[$k] = $val;
            }
        }

        // curl_close($curl);
        // echo $response;
        // }
        // curl_close($curl);
        // echo $response;

        return view('patient/intakeform ', compact('disease_name', 'data', 'all_medicine','email'));
    }

    public function create()
    {
        //
    }

    public function store(Request $data)
    {
        $validatedData = $data->validate([
            'user_data.first_name' => 'required',
            'user_data.last_name' => 'required',
            'user_data.gender' => 'required',
            'user_data.dob' => 'required',
            'user_data.phone' => 'required',
            'user_data.phone_type' => 'required',
            'user_data.address' => 'required',
            'user_data.address2' => 'required',
            'user_data.city' => 'required',
            'user_data.state' => 'required',
            'user_data.zip_code' => 'required',
            'user_data.password' => 'required',
            'user_data.confirm_password' => 'required',
            'user_data.weight' => 'required',
            'user_data.height' => 'required',
            'user_data.pregnancy' => 'required',
            'user_data.allergeis' => 'required',
            'user_data.current_medication' => 'required',
            'medication_data.shipped_time'=> 'required',
            'file' => 'required',
            'filename' => 'required',
            'intake_data.*.answer' => 'required',
            
        ],
         [
            'user_data.first_name' => 'Field is required',
            'user_data.last_name' => 'Field is required',
            'user_data.gender' => 'Field is required',
            'user_data.dob' => 'Field is required',
            'user_data.phone' => 'Field is required',
            'user_data.phone_type' => 'Field is required',
            'user_data.address' => 'Field is required',
            'user_data.address2' => 'Field is required',
            'user_data.city' => 'Field is required',
            'user_data.state' => 'Field is required',
            'user_data.zip_code' => 'Field is required',
            'user_data.password' => 'Field is required',
            'user_data.confirm_password' => 'Field is required',
            'user_data.weight' => 'Field is required',
            'user_data.height' => 'Field is required',
            'user_data.pregnancy' => 'Field is required',
            'user_data.allergeis' => 'Field is required',
            'user_data.current_medication' => 'Field is required',
            'file'=> 'Field is required',
            'filename'=> 'Field is required',
            'intake_data.*.answer' => 'Field is required',
          
        ]
    );

       
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OGVkOTY3NC0wNzI3LTQwZTAtYWJlZS00NmI3MjcxYzg0MjQiLCJqdGkiOiI1NTQ0OTY4YmYwYmQwODZhY2FmOTQzODYyODdhZDExZGJlMDhmZDc4NWM4ZWMxZTMwNjk0YzdlZGI0MTA4OTc1MjUzNzRhNjY5YzY2ZDA0ZiIsImlhdCI6MTY4MzcwNzU0OC42NjAyODcsIm5iZiI6MTY4MzcwNzU0OC42NjAyOTIsImV4cCI6MTY4Mzc5Mzk0OC42NTU1MDMsInN1YiI6IiIsInNjb3BlcyI6WyIqIl19.TpIxq4bIgEmEYAQGLBWupB1mN4CdzwabqsIYM-QD_puiwOdoeZCWEERVMABPtZUL3mCXhUYoTB8Ngvlt45l2Zt3197W-yd88byI5eDNfhxAPtweCrHDzmKIR3yBUd-Qgv-AHfQb6FkC_yzOn7wTSOzMYm1YtpYcVIEAwX8ck-lKumCTQE1lPw7q9SMDYbZzR1U3IiS-7QgSi9uW5OEFYlvyfHQkfG28xNnPgw5lvmBWjIrnLAU2jdbHpPLShecvECqAWIQ_RThkdAhZo58QSkOo4pZ2LzlzqQ9juZBMDm9034mgQ-3TPJDAWSRILu2algHXBH_FOIN1zFXxK1DYaPZ3yjRG9wnTtAuYzuTCop82MjcF_1WPX6valGq8O0nPvv7sCKes16EWwtO65Cg4C8Y2tMGgOE7WpILANTuaFWfvx6Kr1V2Y__N-2zBPxHVxqCH5FPAwDDgRESDABVY8iMVwlIqVZkqEtxa3x9dhLZAPSCQtqzmVK9BDb0kgmGXpYNPReIbSluZ2yfv6MKXswwiOlgspQdOQZAg5kldOEfZNA565xGTGZgUI5c_7cZqG_o_icd5gnOun0hxYEMoAFY3F-tONmg0hj3imAkQXoSN_syGcF8dp3pmtPub1sYI_ikVSxzPVRIHWkj8PLQ8FkMT5m727vFHKVdoyhfyLaalM';
        ################################################Patient Creation#####################################################################
        $gender = "";
        if ($data['user_data']['gender'] == 0) {
            $gender = 'hello';
        } elseif ($data['user_data']['gender'] == 1) {
            $gender = 'Mr';
        } elseif ($data['user_data']['gender'] == 2) {
            $gender = 'Mrs';
        } elseif ($data['user_data']['gender'] == 9) {
            $gender = 'Not';
        }
        $data_post = [
            'prefix' => $gender,
            'first_name' => $data['user_data']['first_name'],
            'last_name' => $data['user_data']['last_name'],
            'email' => $data['user_data']['email'],
            'password' => Hash::make($data['user_data']['password']),
            'date_of_birth' => $data['user_data']['dob'],
            'driver_license_id' => '',
            'gender' => (int)($data['user_data']['gender']),
            'metadata' => 'data',
            'phone_number' => $data['user_data']['phone'],
            'phone_type' => $data['user_data']['phone_type'],
            'address' => [
                'address' => $data['user_data']['address'],
                'address2' => $data['user_data']['address2'],
                'zip_code' => $data['user_data']['zip_code'],
                'city_name' => $data['user_data']['city'],
                'state_name' => $data['user_data']['state'],
            ],
            'weight' => $data['user_data']['weight'],
            'height' => $data['user_data']['height'],
            'allergies' => $data['user_data']['allergeis'],
            'pregnancy' => false,
            'current_medications' => $data['user_data']['current_medication'],
            'password' => $data['user_data']['password'],
        ];
        // ################################################################CASECREATION#############################################################################
        $fileupload = new \CURLFile($_FILES['file']['tmp_name'], $_FILES['file']['type'], $_FILES['file']['name']);
        DB::transaction(function () use ($data, $gender, $token, $fileupload, $data_post) {
            // ****************************Patient Api ***********************************
            $json = json_encode($data_post);
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

            // ****************************Case Api ***********************************
            $patient_response = json_decode($response_patient);
            // dd($patient_response);
            $question_option = array();
            foreach ($data->intake_data as $key => $value) {
                if ($value['type'] == 'multiple option' || $value['type'] == 'text' || $value['type'] == 'single option' || $value['type'] == 'date')
                    $type = 'string';
                else if ($value['type'] == 'numeric' || $value['type'] == 'range')
                    $type = 'number';
                else
                    $type = 'boolean';
                $arr = array(
                    'question' => $value['title'],
                    'answer' => $value['answer'] ?? 'food',
                    'type' => $type,
                    'important' => isset($value['is_important']) ? true : false,
                    'is_critical' => isset($value['is_critical']) ? true : false,
                    'display_in_pdf' => true,
                    'description' => $value['description'] ?? '',
                    'label' => $value['label'] ?? '',
                    'metadata' => 'example of metatada #123 for question',
                    'displayed_options' => [
                        'yes',
                        'no'
                    ]
                );
                array_push($question_option, $arr);
            }
            $case_data_post = [
                'hold_status' => true,
                'patient_id' => $patient_response->patient_id,
                'metadata' => 'CicloCare',
                'is_chargeable' => true,
                'case_files' => [],
                'case_questions' => $question_option
            ];
            $case_json = json_encode($case_data_post);
            $case_curl = curl_init();
            curl_setopt_array($case_curl, array(
                CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/cases',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_POSTFIELDS => $case_json,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer' . ' ' . $token,
                    'Accept: application/json',
                    'Content-Type: application/json'
                ),
            ));
            $case_response = curl_exec($case_curl);
            curl_close($case_curl);


            // *****************************File Store Api *************************************
            $filecurl = curl_init();
            curl_setopt_array($filecurl, array(
                CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/files',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array('name' => 'azeem', 'file' => $fileupload),
                CURLOPT_HTTPHEADER => array(
                    'Content: multipart/form-data;',
                    'Authorization: Bearer' . ' ' . $token,
                    'Content: multipart/form-data;'
                ),
            ));

            $responsefile = curl_exec($curl);
            curl_close($filecurl);
            $user = User::create([
                'prefix' => $gender,
                'first_name' => $data['user_data']['first_name'],
                'last_name' => $data['user_data']['last_name'],
                'email' => $data['user_data']['email'],
                'password' => Hash::make($data['user_data']['password']),
                'date_of_birth' => $data['user_data']['dob'],
                'gender' => $data['user_data']['gender'],
                'phone_number' => $data['user_data']['phone'],
                'phone_type' => $data['user_data']['phone_type'],
                'role' => 3,
                'customer_of' => 0,
            ]);

            foreach ($data['intake_data'] as $key => $value) {
                IntakeFormAnswer::create([
                    'questionnaire_id' => $value['partner_questionnaire_question_id'],
                    'answer' => json_encode($value['answer']),
                    'type' => $value['type'],
                    'title' => $value['title'],
                    'description' => $value['description'],
                    'label' => $value['label'],
                    'placeholder' => $value['placeholder'],
                    'is_important' => $value['is_important'],
                    'is_critical' => $value['is_critical'],
                    'is_optional' => $value['is_optional'],
                    'is_visible' => $value['is_visible'],
                    'order' => $value['order'],
                    'default_value' => $value['default_value'],
                    'userId' => $user->id,
                ]);
            }

            UserDetails::create([
                'driver_license_id' => '',
                'metadata' => $data['user_data']['metadata'],
                'refrence_id' => $user->id,
                'address1' => $data['user_data']['address'],
                'address2' => $data['user_data']['address2'],
                'zip_code' => $data['user_data']['zip_code'],
                'city_name' => $data['user_data']['city'],
                'state_name' => $data['user_data']['state'],
                'weight' => $data['user_data']['weight'],
                'height' => $data['user_data']['height'],
                'allergies' => $data['user_data']['allergeis'],
                'pregnancy' => $data['user_data']['pregnancy'],
                'current_medications' => $data['user_data']['current_medication'],
            ]);

            $fileModel = new DocumentUpload;
            if ($data->file()) {
                $fileName = time() . '_' . $data->file->getClientOriginalName();
                $filePath = $data->file('file')->storeAs('uploads', $fileName, 'public');
                $fileModel->name = time() . '_' . $data->file->getClientOriginalName();
                $fileModel->file_path = '/storage/' . $filePath;
                $fileModel->doc_id = 1;
                $fileModel->filename = $data->filename;
                $fileModel->user_id = $user->id;
                $fileModel->save();
                return back()
                    ->with('success', 'File has been uploaded.')
                    ->with('file', $fileName);
            }
        });
        return redirect()->route('login');

        //         StoreMedications::create([
        //                   'partner_medication_id'=>$data['medication_data']['partner_medication_id'],
        //                    'dosespot_rxcui'=>$data['medication_data']['dosespot_rxcui'],
        //                    'active'=>$data['medication_data']['active'],
        //                    'ndc'=>$data['medication_data']['ndc'],
        //                    'days_supply'=>$data['medication_data']['days_supply'],
        //                    'refills'=>$data['medication_data']['refills'],
        //                    'name'=>$data['medication_data']['name'],
        //                    'pharmacy_notes'=>$data['medication_data']['pharmacy_notes'],
        //                    'directions'=>$data['medication_data']['directions'],
        //                    'quantity'=>$data['medication_data']['quantity'],
        //                    'dispense_unit'=>$data['medication_data']['dispense_unit'],
        //                    'strength'=>$data['medication_data']['strength'],
        //                    'dispense_unit_id'=>$data['medication_data']['dispense_unit_id'],
        //                    'pharmacy_id'=>$data['medication_data']['pharmacy_id'],
        //                    'pharmacy_name'=>$data['medication_data']['pharmacy_name'],
        //                    'metadata'=>$data['medication_data']['metadata'],
        //                    'thank_you_note'=>$data['medication_data']['thank_you_note'],
        //                    'clinical_note'=>$data['medication_data']['clinical_note'],
        //                    'allow_substitutions'=>$data['medication_data']['allow_substitutions'],
        //                    'title'=>$data['medication_data']['title'],
        //                    'effective_date'=>$data['medication_data']['effective_date'],
        //                 ]);

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
        //
    }


    public function destroy($id)
    {
        //
    }

    public function home_page()
    {
        return view('welcome');
    }
}
