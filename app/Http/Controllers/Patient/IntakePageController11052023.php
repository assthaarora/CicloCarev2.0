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

class IntakePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        // dd("");
        // $disease_name="";
        // $data=[];
        // $all_medicine=[];
        // return view('patient/intakeform', compact('disease_name','data', 'all_medicine'));
        //Dynamic Token Generation starts
        $dynamic_token_body = [
            'grant_type'=> 'client_credentials',
            'client_id'=> '98ed9674-0727-40e0-abee-46b7271c8424',
            'client_secret'=> 'sEAXrJW1FP6bylpACsvlkvE82juQS3F5XNbFSOv5',
            'scope'=> '*'
        ];

        $json_token = json_encode($dynamic_token_body);
        // dd($json_token);
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
        // dd(json_decode($response_token));
        curl_close($curl);
        //Dynamic Token Generation ends
        $token =json_decode($response_token)->access_token;
        //  'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OGVkOTY3NC0wNzI3LTQwZTAtYWJlZS00NmI3MjcxYzg0MjQiLCJqdGkiOiIzZWY4NTRmYWVmNzhhMmExYWJlZWFmZTkwYzdkMGVjOGZjMGQ3ZWYxZjEwY2E4YTdjYjcyNDU2YTRhMTA2ODc2NmZmY2QwMGRmYjhkMTljMCIsImlhdCI6MTY4MzIyMjE4Ni4xNjgzNjMsIm5iZiI6MTY4MzIyMjE4Ni4xNjgzNjYsImV4cCI6MTY4MzMwODU4Ni4xNjM2NDYsInN1YiI6IiIsInNjb3BlcyI6WyIqIl19.XgUe0eJNZ73rXnTMBXjCw9UuoQtRLP94Rga0N39bS_DR-Seg23jXYL7VsH3hvdn8gDK8LySmmsVRgOs7hkPHYsz4v6e_YsPngUzwU04NmqpYcUzLuEoALod9VNsNvslg-475UyIxam7oMbT0gfnxlqhGSk9vxlHXiA8PVvZZmDLd0rckv39J1WYGbDOXU6ry5sjBBA0l5cO76Lz3qT0IDOCz9KnUQCES7zqYHcGS_7FkZ4Lcw9DDxlIEgXzoIb1vLwDwpP-in227fkxX0egmfBjH9Xv6uabjB4uHIW-W8eB2_shulMrRJhJENvvSjLTXTXRm7IEKd4oo6lOtbq-ej8Zu77r7rnwaki6yiZbFB4yuA8nytfpSUomRkM05Kx3ShC6AaDcIi12lBGOVHM4DB04ZOMzjah1ubxeBLgZBEoN-2DAYdns9Y59cGUiv1zHjdfN0JAac0vaJL7E0uMlgjNW5978w511GEq-Q-qJ5hcVzMF1e_7HMjvKJgNlGVhA8t7QI_1mO3dLkLQjvZCa1dzDJSVDrp50ZTkXoUTD6gjXaY9j688AactjbMTzFxv2iYt9P6gjIdLj6MdOz79NAIAKAq_mnn2pa9QMMHvF3v-KOb4xw9WDX1Upl205W04RL898dhCFDSb0cg2WeX9A48WHQ0FNvwssVvW2NmS6SofY';

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
        // dd(json_decode($response));
        $disease_name=json_decode($response)[0]->name;
        $medication_ids = json_decode($response)[0]->offerings->medications;
        $partner_quest_id = json_decode($response)[0]->partner_questionnaire_id;

        // foreach(json_decode($response) as $k=>$v){
        $curl = curl_init();
        // dd($v->partner_questionnaire_id);
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
        // dd(json_decode($response));
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
        //  dd($medication_ids);
        // dd($medicine=json_decode($response),$medication_ids);
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

        return view('patient/intakeform ', compact('disease_name','data', 'all_medicine'));
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
    public function store(Request $data)
    {
        // dd($data, 'Form');

        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OGVkOTY3NC0wNzI3LTQwZTAtYWJlZS00NmI3MjcxYzg0MjQiLCJqdGkiOiI3MTA1NzE1NDNiYjA5MGY4Y2MxOTkyNTI2NmRlN2RiY2FmZjkzMTZlYjViYzRmMmFiNDUzNzg0ZjI4Njg1NDZkZTBiZWY0YWNlMGMzZTA2NCIsImlhdCI6MTY4MjYwMzMzMS45MjU5ODgsIm5iZiI6MTY4MjYwMzMzMS45MjU5OTIsImV4cCI6MTY4MjY4OTczMS45MjIwNTksInN1YiI6IiIsInNjb3BlcyI6WyIqIl19.JLCKg_L9Jz9JF9CyZYP0kqOu7d-G5LXbHFzd0I-oHZv-iJe03T052UCcAiML_nY4z3Ng8xxngDBpZvtfEnfoiNFb-ZGQac7gfDHJvZ3rC66BZRkEGPP1wq3_1_UIQ-yu_dhkMoTvthf6aTNsc7db_v-K6PSflKV4CYPQoh3TiTbyeB-C6xZ-qPW7JHJu8XL9nBY6lSGpR3LORmPmprIoe9bi5BzDo3y6pCL1C6Huc3bw1qHuTMmwN6jeOsUBfWp4-nt4bXDXtgDybGCmg8s9RKAu2_TEnKLHdGHTEW2qAXr0JL8F0CX3KBx9wL9jAfC-T6N_opsSKlmR3tp2BWrhjhPmICSry4IsCuNZfbYekJufkXjx6Mx2C4uqR46na4m1yls8VFvsWNGo6as0ctmmk_mQ80ciLE7MzhZXM2yNJ4ugpSlDiqkHjD-muRF_zNpx43C4wHou2POrnPyvfgusVmLb51bElx6RGLIoDGQE5sp9hlFZh2wXo5gK1cCX0omblRwEMTBCll3ntiIbdO_TnLwe_Floqibh4OeQ_1a62nb2Co6-uvZBszkv2PyZ3RWJxEnRr0KEbQ8H5412XPXVGHeT2Jq9EXwbunpQ-mNHqPdgIswrPvj22wNLPpsT2e0Sxg3mKcSPlI8xvJbEpPfs4nQHaxbMs3-IMl5sFyGQEjo';
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
            'email' => 'aa@gmail.com',
            // $data['user_data']['password']
            'password' => Hash::make('Jacaob'),
            'date_of_birth'=>$data['user_data']['dob'],
            'driver_license_id'=>'',
            'gender'=>(int)($data['user_data']['gender']),
            'metadata'=>'data',
            'phone_number'=>$data['user_data']['phone'],
            'phone_type'=>2,
            'address'=>[
                'address'=>$data['user_data']['address'],
                'address2'=>$data['user_data']['address2'],
                'zip_code'=>$data['user_data']['zip_code'],
                'city_name'=>$data['user_data']['city'],
                'state_name'=>$data['user_data']['state'],
            ],
            'weight'=>$data['user_data']['weight'],
            'height'=>$data['user_data']['height'],
            'allergies'=>$data['user_data']['allergeis'],
            // 'pregnancy'=>$data['user_data']['pregnancy'],
            'pregnancy'=>false,
            'current_medications'=>$data['user_data']['current_medication'],
            // 'password'=>$data['user_data']['password'],
        ];

        $json = json_encode($data_post);
        // dd($data_post);
        $curl = curl_init();
        //  curl_setopt($ch, CURLOPT_POSTFIELDS, $json),

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

################################################################CASECREATION#############################################################################
        $patient_response=json_decode($response_patient);
        // dd($patient_response->patient_id);
        $question_option = array();
        // dd($data->intake_data);
        foreach ($data->intake_data as $key => $value) {
            // dd($data->intake_data, $value, $value['type'], $key);
            if($value['type']=='multiple option'||$value['type']=='text'||$value['type']=='single option'||$value['type']=='date')
                $type='string';
            else if($value['type']=='numeric'||$value['type']=='range')
                $type='number';
            else 
                $type='boolean';
            $arr = array(
                'question'=> $value['title'],
                'answer'=> $value['answer'] ?? 'food',
                'type'=>$type,
                'important'=> isset($value['is_important']) ? true : false,
                'is_critical'=> isset($value['is_critical']) ? true : false,
                'display_in_pdf'=> true,
                'description'=> $value['description'] ?? '',
                'label'=> $value['label'] ?? '',
                'metadata'=> 'example of metatada #123 for question',
                'displayed_options'=> [
                    'yes',
                    'no'
                ]);
            array_push($question_option, $arr);
        }
        // dd($data->intake_data, $question_option);

        $data_post = [
            'hold_status'=> true,
            'patient_id'=> $patient_response->patient_id,
            'metadata'=> 'CicloCare',
            'is_chargeable'=> true,
            'case_files'=> [],
            'case_questions'=> $question_option
        ];

        $json = json_encode($data_post);
        
        $curl = curl_init();
        //  curl_setopt($ch, CURLOPT_POSTFIELDS, $json),

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/cases',
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
        $response = curl_exec($curl);
        curl_close($curl);
        // dd($response,$data_post,$json);
#################################################################MY SQL DB##############################################################
        StoreMedications::create([
                  'partner_medication_id'=>$data['medication_data']['partner_medication_id'],
                   'dosespot_rxcui'=>$data['medication_data']['dosespot_rxcui'],
                   'active'=>$data['medication_data']['active'],
                   'ndc'=>$data['medication_data']['ndc'],
                   'days_supply'=>$data['medication_data']['days_supply'],
                   'refills'=>$data['medication_data']['refills'],
                   'name'=>$data['medication_data']['name'],
                   'pharmacy_notes'=>$data['medication_data']['pharmacy_notes'],
                   'directions'=>$data['medication_data']['directions'],
                   'quantity'=>$data['medication_data']['quantity'],
                   'dispense_unit'=>$data['medication_data']['dispense_unit'],
                   'strength'=>$data['medication_data']['strength'],
                   'dispense_unit_id'=>$data['medication_data']['dispense_unit_id'],
                   'pharmacy_id'=>$data['medication_data']['pharmacy_id'],
                   'pharmacy_name'=>$data['medication_data']['pharmacy_name'],
                   'metadata'=>$data['medication_data']['metadata'],
                   'thank_you_note'=>$data['medication_data']['thank_you_note'],
                   'clinical_note'=>$data['medication_data']['clinical_note'],
                   'allow_substitutions'=>$data['medication_data']['allow_substitutions'],
                   'title'=>$data['medication_data']['title'],
                   'effective_date'=>$data['medication_data']['effective_date'],
                ]);

        foreach($data['intake_data'] as $key=>$value){
            IntakeFormAnswer::create([
               'questionnaire_id'=>$value['partner_questionnaire_question_id'],
            //    'type'=>$value['quest_type'],
               'answer'=>json_encode($value['answer']),
               'type'=>$value['type'],
               'title'=>$value['title'],
               'description'=>$value['description'],
               'label'=>$value['label'],
               'placeholder'=>$value['placeholder'],
               'is_important'=>$value['is_important'],
               'is_critical'=>$value['is_critical'],
               'is_optional'=>$value['is_optional'],
               'is_visible'=>$value['is_visible'],
               'order'=>$value['order'],
               'default_value'=>$value['default_value'],
            ]);
           }
        $user= User::create([
            'prefix' => $gender,
            'first_name' => $data['user_data']['first_name'],
            'last_name' => $data['user_data']['last_name'],
            'email' => 'aa1@gmail.com',
            'password' => Hash::make('password'),
            'date_of_birth'=>$data['user_data']['dob'],
            'gender'=>$data['user_data']['gender'],
             'phone_number'=>$data['user_data']['phone'],
            'phone_type'=>2,
        ]);

        UserDetails::create([
            'driver_license_id' => '',
            'metadata' => 1,
            'refrence_id'=>$user->id,
            // 'phone_type'=>2,
            'address1' => $data['user_data']['address'],
            'address2' => $data['user_data']['address2'],
            'zip_code' => $data['user_data']['zip_code'],
            'city_name' => $data['user_data']['city'],
            'state_name' => $data['user_data']['state'],
            // 'weight'=>$data['user_data']['weight'],
            'height' => $data['user_data']['height'],
            'allergies' => $data['user_data']['allergeis'],
            // 'pregnancy'=>$data['user_data']['pregnancy'],
            'pregnancy' => 0,
            'current_medications' => $data['user_data']['current_medication'],
        ]);
        return redirect()->route('login');
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

    public function home_page()
    {
        return view('welcome');
    }
}
