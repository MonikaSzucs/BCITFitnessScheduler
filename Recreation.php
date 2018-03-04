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
	<link rel="stylesheet" href="css/Main.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 150px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: transparent;
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
    background:transparent;
    )
	}

	 h1, h2, h3, h4, h5, h6 {
        text-align: center;
    }

  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header" id="largerHeading">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="Icons/IFitLogo.svg" class="center-block" alt="Study_Stretch" height="75" width="75"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

      </ul>
      <ul class="nav navbar-nav navbar-right tabStyle" >
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
        <h1>Recreation</h1>
    </div>



    <div class="row content">
      <div class="col-sm-4 text-center top-buffer" id="subIcons">
				<form action="Class.php" method="get" class="category_form">
					<input type="hidden" name="recreation" value='TaiChi'/>
					<input id="TaiChi" type="image" name="btn_opentextbox" src="Icons/Tai_Chi.svg" value="Submit" />
					<span class="textStyle">Tai Chi</span>
				</form>
      </div>


      <div class="col-sm-4 text-center top-buffer">
					<form action="Class.php" method="get" class="category_form">

						<input type="hidden" name="recreation" value='StudyStretch'/>
						<input id="StudyStretch" type="image" name="btn_opentextbox" src="Icons/study_stretch.svg" value="Submit" />
						<span class="textStyle">Study Stretch</span>
					</form>
      </div>


      <div class="col-sm-4 text-center top-buffer">
				<form action="Class.php" method="get" class="category_form">
					<input type="hidden" name="recreation" value='WeekendRecovery'/>
					<input id="WeekendRecovery" type="image" name="btn_opentextbox" src="Icons/weekend_recovery_yoga.svg" value="Submit" />
					<span class="textStyle">Weekend Recovery</span>
				</form>
      </div>
    </div>


    <div class="row content">
      <div class="col-sm-4 text-center top-buffer" id="subIcons">
				<form action="Class.php" method="get" class="category_form">
					<input type="hidden" name="recreation" value='CTC'/>
					<input id="CTC" type="image" name="btn_opentextbox" src="Icons/CTC.svg" value="Submit" />
					<span class="textStyle">CTC</span>
				</form>
    </div>


      <div class="col-sm-4 text-center top-buffer">
				<form action="Class.php" method="get" class="category_form">
					<input type="hidden" name="recreation" value='MuiTaiKickboxing'/>
					<input id="MuiTaiKickboxing" type="image" name="btn_opentextbox" src="Icons/Mui_Tai_Kickboxing.svg" value="Submit" />
					<span class="textStyle">Mui Tai Kickboxing</span>
				</form>
      </div>


      <div class="col-sm-4 text-center top-buffer">
				<form action="Class.php" method="get" class="category_form">
					<input type="hidden" name="recreation" value='LadiesWhoLift'/>
					<input id="LadiesWhoLift" type="image" name="btn_opentextbox" src="Icons/Ladies_Who_Life.svg" value="Submit" />
					<span class="textStyle">Ladies Who Lift</span>
				</form>
      </div>
    </div>





    </div>
    <div class="col-sm-2">

    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>IFit © 2018</p>
</footer>

</body>
</html>
