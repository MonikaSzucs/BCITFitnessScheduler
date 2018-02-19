<?php
session_start();

//Include Google client library

// ***** Daren: Pathing re-arranged to work with calender API.
//              Removed your Google_Client and
//              cleaned up pathing, or at least
//              I think so!

// ******* Deprecated
//include_once 'src/Google_Client.php';
//include_once 'src/contrib/Google_Oauth2Service.php';

// *** Daren: I actually don't know the difference between include and require??
include_once './src/google-api-php-client/vendor/autoload.php';
require_once './src/google-api-php-client/src/Google/Client.php';

/*
 * Configuration and setup Google API
 */
// *** Daren: I used my keys, feeel free to swap
$clientId = '563792370353-rt8ebr930h5ug6o1pqtgktgn2j5upm9a.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'lf_EArd8sKiQ9L08x4et9X2J'; //Google client secret
$redirectURL = 'http://localhost/IFitFeb13/BCITFitnessScheduler/Recreation.php'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

// ********* daren:  adding scope, Deprecated ./src/config.php
$gClient->addScope('https://www.googleapis.com/auth/userinfo.profile');
$gClient->addScope('https://www.googleapis.com/auth/userinfo.email');
$gClient->addScope('https://www.googleapis.com/auth/calendar');
$gClient->addScope('https://www.googleapis.com/auth/calendar.readonly');

// ****** Daren: Changed authentication. It's essentiall the same as your Oauth file
//                  only this way the pathing works!
$google_oauthV2 = new Google_Service_Oauth2($gClient);

/*
echo "<pre>";

print_r($google_oauthV2);

echo "</pre>";
*/
?>
