<?php
/*
//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('770156081926-nhppbnh6q79g15dcto2kp1f7rqqrvie1.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/photogram/');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
*/

// CONFIGURACION DE GOOGLE
$clientID = '770156081926-nhppbnh6q79g15dcto2kp1f7rqqrvie1.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/photogram/index.php';

// create Client Request to access Google API 
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow 
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    
    // get profile info 
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
    // now you can use this profile info to create account in your website and make user logged in. 
} else {
    print "<a href='".$client->createAuthUrl()."' class='btn btn-danger btn-block'><i class='icon-google'></i>&nbsp; Iniciar Sesión Con Google</a>";
}

?>