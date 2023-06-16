<?php
function makeFacebookApiCall($endpoint,$params){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $endpoint . '?' . http_build_query($params) );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);

    $fbResponse = curl_exec($ch);
    $fbResponse = json_decode($fbResponse, TRUE);
    curl_close($ch);

    return array(
        'endpoint' => $endpoint,
        'params' => $params,
        'has_errors' => isset($fbResponse['error']) ? TRUE : FALSE,
        'error_message' => isset($fbResponse['error']) ? $fbResponse['error']['message'] : '',
        'fb_response' => $fbResponse
    );
}
function getFacebookLoginUrl(){
    $endpoint = 'https://www.facebook.com' . FB_GRAPH_VERSION . '/dialog/oauth';
    $params = array(
        'client_id' => FB_APP_ID,
        'redirect_uri' => FB_REDIRECT_URI,
        'state' => FB_APP_STATE,
        'scope' => 'email',
        'auth_type' => 'rerequest'
    );
    return $endpoint . '?' . http_build_query($params);
}

function getAccessTokenWithCode($code){
    $endpoint = 'https://graph.facebook.com' . FB_GRAPH_VERSION . '/oauth/access_token';
    $params = array(
        'client_id' => FB_APP_ID,
        'client_secret' => FB_APP_SECRET,
        'redirect_uri' => FB_REDIRECT_URI,
        'code' => $code
    );
    return makeFacebookApiCall($endpoint,$params);
}