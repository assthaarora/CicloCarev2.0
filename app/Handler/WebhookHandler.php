<?php

namespace App\Handler;
use \Spatie\WebhookClient\Jobs\ProcessWebhookJob;

use DB;
use Carbon\Carbon;

use App\Models\PrescriptionDetail;
use App\Models\PrescriptionMedicationDetail;
use App\Models\OrderDetail;

class WebhookHandler extends ProcessWebhookJob{

    public function handle(){
        //dd("default handler",$this->webhookCall->name);
        if($this->webhookCall->name == 'webhookOrder'){

        }else if($this->webhookCall->name == 'webhookMDI'){
            
            $payload = $this->webhookCall->payload;
            $timestamp=$payload['timestamp'];
            $timestamp = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
            $eventtype=$payload['event_type'];
            $caseId=$payload['case_id'];

            $patientDetails=DB::table('patient_case')
            ->where('case_id', '=', $caseId)
            ->select('userId')->first();
            if (isset($patientDetails)) {
                //Save payload to DB
                if($eventtype!='patient_modified' || $eventtype!='new_case_message'){
                    DB::transaction(function ()  use ($timestamp, $eventtype,$caseId,$patientDetails)  {
                        $data = [
                            'name' => $eventtype,
                            'updated_at' =>$timestamp,
                            'reason' => '',
                            'caseId'  => $caseId,
                            'userId' => $patientDetails->userId
                        ];
                        DB::table('patient_case_status')->insert($data);
                    });
                }
                dd($patientDetails->userId);
                if($eventtype=='prescription_submitted'){

                    //saving prescription in DB 
                    DB::transaction(function ()  use ($timestamp, $eventtype, $payload)  {
                        foreach ($payload['prescriptions'] as $value) {
                            $prescriptionData = new PrescriptionDetail;
                                $prescriptionData->case_id = $payload['case_id'];
                                $prescriptionData->dosespot_prescription_id = $value['dosespot_prescription_id'];
                                $prescriptionData->refills = $value['refills'];
                                $prescriptionData->quantity = $value['quantity'];
                                $prescriptionData->days_supply = $value['days_supply'];
                                $prescriptionData->directions = $value['directions'];
                                $prescriptionData->dosespot_prescription_sync_status = $value['dosespot_prescription_sync_status'];
                                $prescriptionData->dosespot_sent_pharmacy_sync_status = $value['dosespot_sent_pharmacy_sync_status'];
                                $prescriptionData->no_substitutions = $value['no_substitutions'];
                                $prescriptionData->pharmacy_notes = $value['pharmacy_notes'];
                                $prescriptionData->dosespot_confirmation_status = $value['dosespot_confirmation_status'];
                                $prescriptionData->dosespot_confirmation_status_details = $value['dosespot_confirmation_status_details'];
                                $prescriptionData->thank_you_note = $value['thank_you_note'];
                                $prescriptionData->clinical_note = $value['clinical_note'];
                                $prescriptionData->dispense_unit_id = $value['dispense_unit_id'];
                                $prescriptionData->pharmacy_id = $value['pharmacy_id'];
                                $prescriptionData->partner_compound = $value['partner_compound'];
                            $prescriptionData->save();
                            
                            $medicationData = new PrescriptionMedicationDetail;
                                $medicationData->prescription_id = $prescriptionData->id;
                                $medicationData->dosespot_medication_id = $value['medication']['dosespot_medication_id'];
                                $medicationData->dispense_unit_id = $value['medication']['dispense_unit_id'];
                                $medicationData->dose_form = $value['medication']['dose_form'];
                                $medicationData->route = $value['medication']['route'];
                                $medicationData->strength = $value['medication']['strength'];
                                $medicationData->generic_product_name = $value['medication']['generic_product_name'];
                                $medicationData->lexi_gen_product_id = $value['medication']['lexi_gen_product_id'];
                                $medicationData->lexi_drug_syn_id = $value['medication']['lexi_drug_syn_id'];
                                $medicationData->lexi_synonym_type_id = $value['medication']['lexi_synonym_type_id'];
                                $medicationData->lexi_gen_drug_id = $value['medication']['lexi_gen_drug_id'];
                                $medicationData->rx_cui = $value['medication']['rx_cui'];
                                $medicationData->otc = $value['medication']['otc'];
                                $medicationData->ndc = $value['medication']['ndc'];
                                $medicationData->schedule = $value['medication']['schedule'];
                                $medicationData->display_name = $value['medication']['display_name'];
                                $medicationData->monograph_path = $value['medication']['monograph_path'];
                                $medicationData->drug_classification = $value['medication']['drug_classification'];
                                $medicationData->metadata = $value['medication']['metadata'];
                                $medicationData->partner_medication_id  = $value['medication']['partner_medication_id'];
                            $medicationData->save();

                            $orderData = new OrderDetail;
                                $orderData->patient_id = 1;
                                $orderData->external_patient_id = 'external_patient_id';
                                $orderData->businessman_id = 1;
                                $orderData->external_businessman_id = 'external_businessman_id';
                                $orderData->prescription_id = 1;
                                $orderData->external_prescription_id = 'external_prescription_id';
                                $orderData->medication_id = 1;
                                $orderData->external_medication_id = 'external_medication_id';
                                $orderData->subscription_id = 1;
                                $orderData->external_subscription_id = 'external_subscription_id';
                            $orderData->save();
                        }
                    });

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

                    
                    dd($payload, $responsePrescription, $jsonPrescription, $responseCreatePatient, $responseRefill);
                }
            }else{
                dd("Patient Not found");
            }

            echo "<script> handleWebhook(); </script>";
        }
    }
}
