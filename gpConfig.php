<?php
session_start();

//Include Google client library
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '24016751283-msrk4r5snv195albekta8mct2mn8tued.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'RNRoFvfKSQBJJUT-tBUwF55D'; //Google client secret
$redirectURL = 'http://localhost/IfitFeb12/BCITFitnessScheduler/index.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
