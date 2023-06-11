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
    if ($response != '' && $response !== null) {
        // dd( json_decode($response)[0]->city);
        $req = array(
            'city_id' => json_decode($response)[0]->city->city_id,
            'city' => json_decode($response)[0]->city->name,
            'state' => json_decode($response)[0]->city->state->abbreviation,
        );
        return json_encode($req);
    }else{
        return json_encode(0);
    }
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

function checkResponse($json)
{
    $response = json_decode($json, true);

    if (isset($response['error'])) {
        // If 'error' field exists, return the detailed error message with flag set to false
        return ['success' => false, 'message' => $response['message']];
    }

    if (isset($response['code'])) {
        // Check error codes and return the appropriate string message with flag set to false
        switch ($response['code']) {
            case 400:
                return ['success' => false, 'message' => 'Bad request'];
            case 401:
                return ['success' => false, 'message' => 'Unauthorized. This can happen if the access token is invalid, expired, or has been revoked'];
            case 403:
                return ['success' => false, 'message' => "The access token doesn't have access to perform the requested action"];
            case 404:
                return ['success' => false, 'message' => 'Resource not found'];
            case 418:
                return ['success' => false, 'message' => 'API under maintenance'];
            case 500:
            case 501:
            case 502:
            case 503:
            case 504:
                return ['success' => false, 'message' => 'An error occurred on the MD Integrations servers. Check MD Integrations Status API for more details or contact the support team'];
        }
    }

    // if (isset($response['message'])) {
    //     // If 'message' field exists, return the friendly error message with flag set to false
    //     return ['success' => false, 'message' => $response['message']];
    // }

    // If none of the expected fields exist, return a generic error message with flag set to false
    return ['success' => true, 'message' => 'true'];
}
