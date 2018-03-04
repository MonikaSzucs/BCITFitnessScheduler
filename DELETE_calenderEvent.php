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

    // With Google Service Calendar
    // DELETE the intended event.
    $service = new Google_Service_Calendar($gClient);
    
    
    // Example of deleting an event
    // ************
    // $service->events->delete('primary', 'eventId');
    
    // grab eventId from database;
    try {
        // Config setup
        $servername = 'localhost';
        $dbname = 'googlelogin';
        $dblogin = 'root';
        $password = 'root';

        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dblogin, $password);

        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Query for appropriate class.
        // ** TO BE USED IN CALENDAR EVENT DELETING ********
        $theClass = $_POST['class'];
        switch ($theClass) {
            case 'tai_chi':
                $theRow = 1;
                break;
            case 'study_stretch':
                $theRow = 2;
                break;
            case 'weekend_recovery':
                $theRow = 3;
                break;
            case 'ctc':
                $theRow = 4;
                break;
            case 'mui_tai_kickboxing':
                $theRow = 5;
                break;
            case 'ladies_who_lift':
                $theRow = 6;
                break;
        }
        
        // 1st join right here.
        $sql = "
                SELECT rec_IDs.event_ID, recreations.name
                FROM rec_IDs
                INNER JOIN recreations
                ON rec_IDs.ID = $theRow;
                ";
        $statement = $conn->prepare($sql);
        $statement->execute();
        
        // Row saved on 
        // $container[0]['event_ID']
        // and
        // $container[0]['name']
        $container = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        
    } catch(PDOException $e) {
        $error = $e->getMessage();
        echo "Error: $e";
    }
    
    // ********** deletion occurs here. **********
    // ********** deletion occurs here. **********
    // ********** deletion occurs here. **********
    // ********** deletion occurs here. **********
    $eveID = $container[0]['event_ID'];
    $service->events->delete('primary', "$eveID");
    
    // delete appropriate user_recreation row.
    $sql = "
            DELETE FROM user_recreation
            WHERE recreation_id = $theRow;
            ";
    $statement = $conn->prepare($sql);
    $statement->execute();
    
    echo 'EVENT REMOVED!';
    
} else {
      $newURL = "index.php";
      header('Location: '.$newURL);
    }

?>