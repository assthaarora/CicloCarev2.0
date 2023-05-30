<?php

namespace App\Handler;
use \Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use Auth;
use DB;
use Carbon\Carbon;

class WebhookHandler extends ProcessWebhookJob{

    public function handle(){ 
        dd($this->webhookCall);
        $payload = $this->webhookCall->payload;
        
        $timestamp=$payload['timestamp'];
        $timestamp = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        $eventtype=$payload['event_type'];
        $caseId=$payload['case_id'];
        //Save payload to DB
        if($eventtype!='patient_modified' || $eventtype!='new_case_message'){
            DB::transaction(function ()  use ($timestamp, $eventtype)  {
                $data = [
                    'name' => $eventtype,
                    'updated_at' =>$timestamp,
                    'reason' => '',
                    'userId' => 2,
                    'patient_case_id'  => 1
                 ];
                DB::table('patient_case_status')->insert($data);
            });
        }
        
        if($eventtype=='prescription_submitted'){
            //#################################### Place order API 
            //Creating Patient 
            $dataPatientPost = [
                'external_id' => 'ChangeThis123456',
                'first_name' => 'Aastha456',
                'last_name' => 'Arora456',
                'birth_date' => '1996-05-20'
            ];
    
            $jsonPatient = json_encode($dataPatientPost);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.precisioncompoundingpharmacy.net/patients/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $jsonPatient,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'account-id: b09da42c-4abb-4c4f-aebd-4b8a7b140119',
                'secret: 8d47487912bbdf44bdee4542f054d561' 
            ),
            ));
            $responseCreatePatient = curl_exec($curl);
            curl_close($curl);
            //Create Prescription
            $dataPrescriptionPost = [
                'external_id' => "ChangeThisToo123566",
                'patient_id' => "",
                'external_patient_id' => "ChangeThis123456",
                'shipping_address1' => "123 First",
                'shipping_address2' => "",
                'shipping_city' => "City",
                'shipping_state' => "ST",
                'shipping_zip_code' => "12345",
                'doctor_npi' => "555",
                'doctor_first_name' => "TEST",
                'doctor_last_name' => "TEST",
                'medications' => "Take this 06/13"
            ];
    
            $jsonPrescription = json_encode($dataPrescriptionPost);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.precisioncompoundingpharmacy.net/prescriptions/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $jsonPrescription,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'account-id: b09da42c-4abb-4c4f-aebd-4b8a7b140119',
                'secret: 8d47487912bbdf44bdee4542f054d561' 
            ),
            ));
            $responsePrescription = curl_exec($curl);
            curl_close($curl);
            //create Refill to place order
            $dataRefillPost = [
                'patient_id' =>  "",
                'external_patient_id' =>  "ChangeThis123456",
                'prescription_external_id' =>  "ChangeThisToo123566",
                'prescription_reference_id' =>  "Changethis4565666",
                'prescription_rx_number' =>  "",
                'refill_rx_number' =>  "",
                'refill_external_id' =>  "",
                'refill_reference_id' =>  "TEST116"
            ];
    
            $jsonRefill = json_encode($dataRefillPost);
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.precisioncompoundingpharmacy.net/refills/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => $jsonRefill,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'account-id: b09da42c-4abb-4c4f-aebd-4b8a7b140119',
                'secret: 8d47487912bbdf44bdee4542f054d561' 
            ),
            ));
            $responseRefill = curl_exec($curl);
            curl_close($curl);
            dd($responseCreatePatient,$responsePrescription,$responseRefill);


        }
        
        echo "<script> handleWebhook(); </script>";
    }
}