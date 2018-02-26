<?php
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
    // Print the next 10 events on the user's calendar.
    $calendarId = 'primary';
    $optParams = array(
      'maxResults' => 10,
      'orderBy' => 'startTime',
      'singleEvents' => TRUE,
      'timeMin' => date('c'),
    );
    $results = $service->events->listEvents($calendarId, $optParams);

    if (count($results->getItems()) == 0) {
      print "No upcoming events found.\n";
    } else {
    
        $allTheEvents = array();
      print "Upcoming events:<br/><br/>";
      foreach ($results->getItems() as $event) {
          
          // grab the start and end dates.  
        $start = $event->start->dateTime;
        $end = $event->end->dateTime;
          
          // split the DATE with TIME.
        $newStart = substr($start, 0, 10);
        $newEnd = substr($end, 0, 10);
        $newStartTime = substr($start, 11, 5);
        $newEndTime = substr($end, 11, 5);
          
          // save the users organized event details
          // into an array for display use.
        $newEvent = array(
            'id' => $event->id,
            'iCalUID' => $event->iCalUID,
            'sumy' => $event->getSummary(),
            'sDate' => $newStart,
            'eDate' => $newEnd,
            'sTime' => $newStartTime,
            'eTime' => $newEndTime
        );
        array_push($allTheEvents, $newEvent);
          
        if (empty($start)) {
          $start = $event->start->date;
        }
        printf("Summary: <strong>%s</strong><br/> Start Date: %s<br/>End Date: %s<br/> Start Time: %s<br/>End Time: %s<br/><br/>", $event->getSummary(), $newStart, $newEnd, $newStartTime, $newEndTime);
          
        // TESTING GETDATE
        // Converts date to useful information!!!!!
          echo "UNIX timestamp: " . strtotime($newStart) . "<br/>";
          foreach (getdate(strtotime($newStart)) as $key => $data) {
              echo "[$key] => $data <br/>";
          }
          echo "<br/>";
      }
        
        // test $allTheEvents
        echo "<br/>";
        foreach ($allTheEvents as $key => $anEvent) {
            echo "[$key]<br/>";
            // must loop here too.
            foreach ($anEvent as $sKey => $data) {
                echo "[$sKey] => $data <br/>";
            }
        }
    }
    
} else {
  $newURL = "index.php";
  header('Location: '.$newURL);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="css/Main.css"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: calc(100vh - 100px);
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: transparent;
      color: #000;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }

	#container{
		min-height: calc(100vh - 100px);
	}

	 h1, h2, h3, h4, h5, h6 {
        text-align: center;
    }

  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="Recreation.php">Recreation</a></li>
        <li><a href="Schedule.php">Schedule</a></li>
		<li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-2">
    </div>
    <div id="container" class="col-sm-8 text-left">
      <div class="text-center">
        <h1>Schedule</h1>
    </div>
        <!--   ***** Daren Table addition *********   -->
        <table border='1'>
            <tr>
                <th></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
            </tr>
            <?php
                // insert 17 time rows.
                $theHour = 5;
                $timetable = '';
            
                for ($i = 0; $i < 17; $i++) {
                    $newRow = '<tr>';
                    $theTime = $theHour . ':00';
                    for ($j = 0; $j < 6; $j++) {
                        // this space will create one cell!
                        // j coincidentally is the week day!
                        
                        if ($j == 0) {
                            $newRow .= "<td>$theTime</td>";
                            continue;
                        } 
                        
                        // loop through events
                        // to check if it matchs:
                        //      - day of the week
                        //      - time of row
                        
                        foreach ($allTheEvents as $anEvent) {
                            $temp = strtotime($anEvent['sDate']);
                            $dateHolder = getdate($temp);
                            
                            if ($dateHolder['wday'] == $j) {
                                if ($anEvent['sTime'] == $theTime) {
                                    // MATCH ***
                                    // Display event in this cell!
                                    $sumy = $anEvent['sumy'];
                                    $newRow .= "<td style='background-color: yellow;'>
                                                    $sumy
                                                </td>";
                                    continue;
                                }
                            }
                        }
                        
                        $newRow .= '<td></td>';
                    }
                    $newRow .= '</tr>';
                    $theHour++;
                    $timetable .= $newRow;
                }
            
                echo $timetable;
            ?>
        </table>
    </div>
    <div class="col-sm-2 ">
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
