<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\IntakeFormAnswer;
use App\Models\StoreMedications;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        dd($data);
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5OGVkOTY3NC0wNzI3LTQwZTAtYWJlZS00NmI3MjcxYzg0MjQiLCJqdGkiOiJmODY5MjU4MTAyNTI5YjRjYzJiYmQ1YThmYTY4MjY5MTBjNGVkNmM3Zjk4ZDQxN2M2NTUzZjY1NDRkZGVjNDE0NmIxNDYzYmJhZTVhYjA3NyIsImlhdCI6MTY4MjM2NjU0MS40NjUwNTMsIm5iZiI6MTY4MjM2NjU0MS40NjUwNTYsImV4cCI6MTY4MjQ1Mjk0MS40NjE5MDcsInN1YiI6IiIsInNjb3BlcyI6WyIqIl19.GbiRGkEnCl8W1PmHMwolmqNiYF8VfYtWx-IMpPRchWRtJrP86KKvfJKK55KJy8tKM-DSoeBE20plrtO6OvT_QtLzPP-o7XDIHMAAVVG-K2WaxsJ7Ub_5xYw_OHLzE9ManV7TpD37Bv1Zcp_nztAyvhqAqLlZ3CU9XdvJ8DcefBPyJREqX8aWClioqTwekz_wcDziSotSQX3dbCdzyHmay54SnirQ7lRo4luPahpfp3bajV94th3cl4S50xwdIr7wF86lz3VKFwMg8FJtg54iuTx1j4NFaMhH5uvlHnumRvRWYx4V7FF048waih21WjyJSdoaQHnN4-8yIkJL5w7szLTFWkbZ89UUy3r66bPM3WDYmNR2IM06OawJLWkY2HZmrDDUqDz2XuQQDGY5HQcG6DdFEAgREhuXRjdDcPpfaTnHGkfvLYf2PdAFAr0G-Rna6XmIQDmogAnrf_pLQcFwvISjUAm1C3KG3sJJ4jcqMb6lekPq0NlEDXmavI_t4nHXXim58azqWkCQP_x_xaSl-hjxTQbUVh95C1Ck9G74WmS8-csotIduzKWqc-dGTQVDukXKnvgZXy70bQGcZnZvmdu_x5HBU2hclfYYlzqfvwSOd6X7gK1VpUwIQ2pOXAL9wf0uXZhmB2GDkMi6XaEiVOXRAQU1DKq6LLxNnPoXOk0';
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
            'email' => $data['email'],
            'password' => Hash::make($data['user_data']['password']),
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
            'password'=>$data['user_data']['password'],
        ];

        $json = json_encode($data_post);
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
        $response = curl_exec($curl);
        curl_close($curl);

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
            'email' => $data['email'],
            'password' => Hash::make($data['user_data']['password']),
            'date_of_birth'=>$data['user_data']['dob'],
            'gender'=>$data['user_data']['gender'],
             'phone_number'=>$data['user_data']['phone'],
            'phone_type'=>2,
        ]);

       return  UserDetails::create([
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
    }
}
