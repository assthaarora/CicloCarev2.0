<?php

// use Illuminate\Support\Facades\DB;

function pincode($pincode)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.mdintegrations.xyz/v1/partner/metadata/zipcodes?search='.$pincode,
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
            'Authorization: Bearer' . ' ' . getToken()
        )
    ));
    $response = curl_exec($curl);
    $req = array(
        'city_id' => json_decode($response)[0]->city->id,
        'city' => json_decode($response)[0]->city->name,
        'state' => json_decode($response)[0]->city->state->name,
    );
    return json_encode($req);
}

function getToken()
{
    $dynamic_token_body = [
        'grant_type'=> 'client_credentials',
        'client_id'=> env('STRIPE_SECRET_ID'),
        'client_secret'=> env('STRIPE_SECRET_KEY'),
        'scope'=> '*'
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
    $token = json_decode($response_token)->access_token;
    return $token;
}
