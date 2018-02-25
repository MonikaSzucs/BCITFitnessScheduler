<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

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
    
    <!-- *** Jessie's Map styling ***  -->
    <link href="./css/map.css" type="text/css" rel="stylesheet">
    
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
        <h1 id='title'>Study Stretch</h1>
        <a href='Recreation.php'>
            <p> < back</p>
        </a>
      </div>

      <div class="row content">
        <div class="col-sm-5 text-center" id="subIcons">
          <h3>Course Outline</h3>
            <p>
                Ready to shape various aspects of your lives? This class will motivate, build confidence, develop competence and self-esteem, knowledge and understanding of the importance of physical activity in maintaining health and enhance the quality of life!
            </p>
        </div>
        <div class="col-sm-2 text-center" id="subIcons">
        </div>

        <div class="col-sm-5 text-center" id="subIcons">
          <!--     ******     Video here   -->
            <iframe id='vid' width="300" height="215" src="" frameborder="0" allowfullscreen></iframe>
          <p id='vidDesc' style="margin-top: 30px;">Video Description</p>
        </div>
      </div>

      <div class="row content">
        <div class="col-sm-3 text-center" id="subIcons">
            <strong>When:</strong>
            <br/>
            February 27, 2018
            <br/>
            11:00am - 12:00pm
        </div>
        <div class="col-sm-3 text-center">
          <div class="text-center">
            <strong>Location</strong>
            <br/>
          </div>
            <!--     **** DISPLAY MAP HERE       -->
            <div id='map'></div>
        </div>
        <div class="col-sm-6 text-center">
            <!--      **** Change to POST .php file *** to add calender event from our database **** TODO **********************************     -->
            <!--      **** Need to utilize javascript ****      -->
            <button onClick='addStudyStretch()'>Join</button>
            <button>Leave</button>
        </div>
      </div>

    </div>
    <div class="col-sm-2">

    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>
    
<!-- adding script to handle POSTING an event -->
<script src='./js/class_script.js'></script>

<!--  Add scripts for map API -->
<script src="./js/map.js" type="text/javascript"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjP-dp52vvMK45w1rHQjczdPfm7YtvvLk&callback=initMap">
</script>
    
<!-- *** ADD script for YouTube API -->
<script src='./js/youtube_script.js'></script>    
    
</body>
</html>
