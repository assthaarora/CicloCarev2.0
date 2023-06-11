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
use function helper;
use Carbon\Carbon;
use Auth;

// use JsValidator;

class IntakePageController extends Controller
{

    public function index($userId,$mId)
    {
        $userId=decrypt($userId);
        $mId=decrypt($mId);
        //get medicine details 
        $genral_admin_medicinedetails=DB::table('genral_admin_medicinedetails')->where('id',$mId)->first();
        // get questions 
        $token = getToken();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/questionnaires/' .$genral_admin_medicinedetails->intakeformId . '/questions',
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
        $ques_response = curl_exec($curl);
        $apiresponse = checkResponse($ques_response);
        $ques = json_decode($ques_response);
        // dd($ques);
        if ($apiresponse['success']) {
            return view('patient/intakeform ', compact('genral_admin_medicinedetails', 'ques', 'userId','mId'));
        }else{
            return;
        }

        // dd(json_decode($response));

         // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/questionnaires/'.$genral_admin_medicinedetails->intakeformId,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Accept: application/json',
        //         'Content-Type: application/json',
        //         'Authorization: Bearer' . ' ' . $token
        //     )
        // ));


        // $response = curl_exec($curl);
        // $disease_name = json_decode($response)->name;
        // $medication_ids = json_decode($response)->offerings->medications;
        // $partner_quest_id = json_decode($response)->partner_questionnaire_id;

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/medications',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Authorization: Bearer' . ' ' . $token,
        //         'Accept: application/json',
        //         'Content-Type: application/json'
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $all_medicine = [];
        // foreach (json_decode($response) as $k => $val) {
        //     if (in_array($val->partner_medication_id, array_column($medication_ids, 'partner_medication_id'))) {
        //         $all_medicine[$k] = $val;
        //     }
        // }

        // curl_close($curl);
        // echo $response;
        // }
        // curl_close($curl);
        // echo $response;

        
    }

    public function create()
    {
        //
    }

    public function store(Request $data)
    {
        
        $patientId=DB::table('usersdetails')->where('userId',$data->userId)->pluck('mdi_patientId')->first();
        $token = getToken();
        $flag=false;
        // ################################################################CASECREATION#############################################################################
        $fileupload = new \CURLFile($_FILES['govtId']['tmp_name'], $_FILES['govtId']['type'], $_FILES['govtId']['name']);

        try {
            DB::transaction(function () use ($data,  $token, $fileupload,$patientId,&$flag) {
                // ****************************Case Api ***********************************
                $question_option = array();
                foreach ($data->intake_data as $key => $value) {
                    if ($value['type'] == 'multiple option' || $value['type'] == 'text' || $value['type'] == 'single option' || $value['type'] == 'date'|| $value['type'] == 'ordering')
                        $type = 'string';
                    else if ($value['type'] == 'numeric' || $value['type'] == 'range')
                        $type = 'number';
                    else
                        $type = 'boolean';
                    if($value['type'] == 'ordering'){
                        $arr = array(
                            'question' => $value['title'],
                            'answer' => json_encode($value['answer']) ?? '',
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
                    }else{
                        $arr = array(
                            'question' => $value['title'],
                            'answer' => $value['answer'] ?? '',
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
                    }
                    array_push($question_option, $arr);
                }
                $case_data_post = [
                    'hold_status' => true,
                    'patient_id' => $patientId,
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
                // dd($case_response,$question_option);
                $apiresponse = checkResponse($case_response);
                if (!$apiresponse['success']) {
                    throw new \Exception('Case Creation error');
                }

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
                    CURLOPT_POSTFIELDS => array('name' => 'CicloCare', 'file' => $fileupload),
                    CURLOPT_HTTPHEADER => array(
                        'Content: multipart/form-data;',
                        'Authorization: Bearer' . ' ' . $token,
                        'Content: multipart/form-data;'
                    ),
                ));

                $responsefile = curl_exec($filecurl);
                curl_close($filecurl);
                $apiresponse = checkResponse($responsefile);
                if (!$apiresponse['success']) {
                    throw new \Exception('File Storage error');
                }
                // dd($responsefile,$apiresponse);
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
                        'userId' => $data->userId,
                        'options' =>$value['options']
                    ]);
                }
                

                $mdiFileResponse=json_decode($responsefile);
                $fileModel = new DocumentUpload;
                // dd($data->file,$data);
                if ($data->hasFile('govtId')) {
                    $uploadedFile = $data->file('govtId');            
                    $fileModel->name = time() . '_' . $uploadedFile->getClientOriginalName();
                    $fileModel->file_path = $mdiFileResponse->path;
                    $fileModel->doc_id = 1;
                    $fileModel->filename = $uploadedFile->getClientOriginalName();
                    $fileModel->mime = $uploadedFile->getMimeType();
                    $fileModel->file_size = $uploadedFile->getSize();
                    $fileModel->uploaded_file = fopen($uploadedFile->getRealPath(), 'r');
                    $fileModel->user_id = $data->userId;
                    $fileModel->updated_at = Carbon::now();
                    $fileModel->created_by = $data->userId;
                    $fileModel->created_at = Carbon::now();
                    $fileModel->mdi_fileId=$mdiFileResponse->file_id;
                    $fileModel->mdi_url= $mdiFileResponse->url;
                    $fileModel->mdi_urlthumbnail=$mdiFileResponse->url_thumbnail;
                    // dd($fileModel);
                    $fileModel->save();
                    return back()
                        ->with('success', 'File has been uploaded.')
                        ->with('file', $uploadedFile->getClientOriginalName());
                }
                $flag=true;
            });
        }catch(\Exception $e){
            return redirect()->route('/');
        }
        return redirect()->route('login');
        
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
