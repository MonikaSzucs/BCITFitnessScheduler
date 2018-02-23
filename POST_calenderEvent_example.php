<?php
    // Refer to the PHP quickstart on how to setup the environment:
    // https://developers.google.com/google-apps/calendar/quickstart/php
    // Change the scope to Google_Service_Calendar::CALENDAR and delete any stored
    // credentials.
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';


// Need the appropriate class for Google_Service_Calendar
//require_once './src/google-api-php-client/src/Google/Client.php';
//require_once './src/vendor/autoload.php';
//require_once './src/google-api-php-client/vendor/autoload.php';
//require_once './src/google-api-php-client/src/Google/Client.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

// Use the token to access Calendar info????
// ************************************************
if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	//Get user profile data from google
	$gpUserProfile = $google_oauthV2->userinfo->get();

	//Initialize User class
	$user = new User();

	//Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );

//		echo "<pre>";
//		print_r($gpUserData);
//		echo "</pre>";

    $userData = $user->checkUser($gpUserData);

	//Storing user data into session
	$_SESSION['userData'] = $userData;

	//Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>';
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
    
    // WITH THE ACCESS TOKEN DISPLAY THE CALENDAR
    // YOU CAN DO IT!!! (done!)
    // ******** Daren's Work ********
    
    // ****** NEEDS WORK:
    //          - Need to correctly display events
    
    // create a service object.
    $service = new Google_Service_Calendar($gClient);
    // ***** SETUP ADDING AN EVENT *****
    $event = new Google_Service_Calendar_Event(array(
        'summary' => 'Tai Chi',
        'location' => '3700 Willingdon Ave, Burnaby, BC V5G 3H2',
        'description' => 'an internal Chinese martial art practiced for both its defense training and its health benefits. The term taiji refers to a philosophy of the forces of yin and yang, related to the moves. Though originally conceived as a martial art, it is also typically practiced for a variety of other personal reasons: competitive wrestling in the format of pushing hands , demonstration competitions, and achieving greater longevity. As a result, a multitude of training forms exist, both traditional and modern, which correspond to those aims with differing emphasis. Some training forms of are especially known for being practiced with relatively slow movements.',
        'start' => array(
        'dateTime' => '2018-02-26T13:00:00-08:00',
        'timeZone' => 'America/Vancouver',
      ),
      'end' => array(
        'dateTime' => '2018-02-26T14:00:00-08:00',
        'timeZone' => 'America/Vancouver',
      ),
      'attendees' => array(
        array('email' => 'darencapacio@gmail.com')
      ),
      'reminders' => array(
        'useDefault' => FALSE,
        'overrides' => array(
          array('method' => 'email', 'minutes' => 24 * 60),
          array('method' => 'popup', 'minutes' => 10),
        ),
      ),
    ));

    $calendarId = 'primary';
    $event = $service->events->insert($calendarId, $event);
    
    echo 'EVENT ADDED';
    
    } else {
      $newURL = "index.php";
      header('Location: '.$newURL);
    }

?>