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
                  <img id="LeftStopper" src="Images/LogoParts/LeftStopper.svg" alt="LeftStopper" height="50" width="50">
                  <img id="RightStopper" src="Images/LogoParts/RightStopper.svg" alt="RightStopper" height="50" width="50">
                  <img id="LogoArmShort" src="Images/LogoParts/LogoArm.svg" alt="LogoArm" height="50" width="50">
                  <img id="LogoArmLong" src="Images/LogoParts/LogoArm2.svg" alt="LogoArmLong" height="75" width="80">
                  <img id="Head" src="Images/LogoParts/Head.svg" alt="Head" height="60" width="60">
                  <img id="TopBody" src="Images/LogoParts/TopBody.svg" alt="TopBody" height="60" width="60">
                  <img id="RightLeg" src="Images/LogoParts/RightLeg.svg" alt="RightLeg" height="55" width="55">
                  <img id="LeftLeg" src="Images/LogoParts/LeftLeg.svg" alt="LeftLeg" height="55" width="55">
                </div>

              </div>
              <div class="services-section-title">
                  <img id="LogoName" src="Images/LogoParts/IFITName.svg" alt="ring" height="120" width="200">
              </div>
              <div class="col-md-offset-3 col-md-6">

              </div>
            </div>
            <hr>




            <div class="text-center">
                <a href="Recreation.php">
                    <button type="button" class="btn btn-primary">Google Log In</button>
                </a>
            </div>
          </div>

          <div class="col-sm-2 sidenav">
          </div>

        </div>
      </div>
    </div>
  </body>
</html>
