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
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/Main.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/logo-animation.js"></script>
  </head>

  <body onload="animationStart()">

    <div class="vertical-center">
      <div class="container text-center">
        <div class="row content">

          <div class="col-sm-2 sidenav">
          </div>

          <div id="container" class="col-sm-8 text-left">

            <div class="services-section">
              <div class="col-md-offset-3 col-md-6">

                <div id="logoArea">
                  <div id="LogoOuterRing"></div>
                  <div id="LogoTopStopper"></div>
                  <img id="LeftStopper" src="Icons/LogoParts/LeftStopper.svg" alt="LeftStopper" height="50" width="50">
                  <img id="RightStopper" src="Icons/LogoParts/RightStopper.svg" alt="RightStopper" height="50" width="50">
                  <img id="LogoArmShort" src="Icons/LogoParts/LogoArm.svg" alt="LogoArm" height="50" width="50">
                  <img id="LogoArmLong" src="Icons/LogoParts/LogoArm2.svg" alt="LogoArmLong" height="75" width="80">
                  <img id="Head" src="Icons/LogoParts/Head.svg" alt="Head" height="60" width="60">
                  <img id="TopBody" src="Icons/LogoParts/TopBody.svg" alt="TopBody" height="60" width="60">
                  <img id="RightLeg" src="Icons/LogoParts/RightLeg.svg" alt="RightLeg" height="55" width="55">
                  <img id="LeftLeg" src="Icons/LogoParts/LeftLeg.svg" alt="LeftLeg" height="55" width="55">
                </div>

              </div>
              <div class="services-section-title">
                  <img id="LogoName" src="Icons/LogoParts/IFITName.svg" alt="ring" height="120" width="200">
              </div>
              <div class="col-md-offset-3 col-md-6">

              </div>
            </div>
            <hr>




            <div class="text-center">

                    <div id="googleSignInButton"><?php echo $output; ?></div>
s
            </div>
          </div>

          <div class="col-sm-2 sidenav">
          </div>

        </div>
      </div>
    </div>
  </body>
</html>
