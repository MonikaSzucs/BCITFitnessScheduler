<?php
//Include GP config file && User class
include_once 'gpConfig.php';
include_once 'User.php';
$output = "";
if(isset($_GET['code'])){
	$gClient->authenticate($_GET['code']);
	$_SESSION['token'] = $gClient->getAccessToken();
	header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
	$newURL = "http://localhost/IFitFeb13/BCITFitnessScheduler/Recreation.php";
	header('Location: '.$newURL);
} else {
	$authUrl = $gClient->createAuthUrl();
	$output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>IFit | Fitness Scheduler</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      
      <link rel="stylesheet" type='text/css' href="./css/newFile_style.css" />
    <link rel="stylesheet" href="css/bootstrap.css">

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/logo-animation.js"></script>
  </head>

  <body >

    <div class="vertical-center">
      <div class="container text-center">
        <div class="row content">

          <div class="col-sm-2 sidenav">
          </div>

          <div id="container" class="col-sm-8 text-left">

            <div class="services-section">
              <div class="col-md-offset-3 col-md-6">

                <div id="logoArea">

									<img id="LeftWB" src="Icons/LogoParts/LeftWB.svg" alt="LeftWB" height="230" width="230">
									<img id="RightWB" src="Icons/LogoParts/RightWB.svg" alt="LeftWB" height="230" width="230">

                  <div id="LogoOuterRing"></div>
                  <div id="LogoTopStopper"></div>
                  <img id="LeftStopper" src="Icons/LogoParts/LeftStopper.svg" alt="LeftStopper" height="50" width="50">
                  <img id="RightStopper" src="Icons/LogoParts/RightStopper.svg" alt="RightStopper" height="50" width="50">
                  <img id="OuterRingAll" src="Icons/LogoParts/OuterTimer.svg" alt="LogoArm" height="300" width="300">


                  <img id="LogoArmShort" src="Icons/LogoParts/LogoArm.svg" alt="LogoArm" height="50" width="50">
                  <img id="LogoArmLong1" src="Icons/LogoParts/LogoArm2.svg" alt="LogoArmLong" height="75" width="80">

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
								<div id="loginButton"><?php echo $output; ?></div>
            </div>
          </div>

          <div class="col-sm-2 sidenav">
          </div>

        </div>
      </div>
    </div>
  </body>
</html>
