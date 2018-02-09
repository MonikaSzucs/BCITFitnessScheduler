<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
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
      <a class="navbar-brand" href="index.php">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="Recreation.php">Recreation</a></li>
        <li><a href="Schedule.php">Schedule</a></li>
		<li><a href="#">Logout</a></li>
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
      <div class="col-sm-4 text-center" id="subIcons">
          <a href="Class.php">
            <img src="Images/Tai_Chi.svg" class="center-block" alt="Tai_Chi" height="150" width="150">
            <span >Tai Chi</span>
          </a>
      </div>
      <div class="col-sm-4 text-center">
        <div class="text-center">
          <a href="Class.php">
            <img src="Images/study_stretch.svg" class="center-block" alt="Tai_Chi" height="150" width="150">
            <span>Study Stretch</span>
          </a>
        </div>
      </div>
      <div class="col-sm-4 text-center">
        <a href="Class.php">
          <img src="Images/weekend_recovery_yoga.svg" class="center-block" alt="Tai_Chi" height="150" width="150">
          <span>Weekend Recovery Yoga</span>
        </a>
      </div>
    </div>


    <div class="row content">
      <div class="col-sm-4 text-center" id="subIcons">
        <a href="Class.php">
          <img src="Images/CTC.svg" class="center-block" alt="Tai_Chi" height="150" width="150">
          <span >CTC</span>
        </a>
      </div>
      <div class="col-sm-4 text-center">
        <div class="text-center">
          <a href="Class.php">
            <img src="Images/Mui_Tai_Kickboxing.svg" class="center-block" alt="Tai_Chi" height="150" width="150">
            <span>Mui Tai Kickboxing</span>
          </a>
        </div>
      </div>
      <div class="col-sm-4 text-center">
        <a href="Class.php">
          <img src="Images/Ladies_Who_Life.svg" class="center-block" alt="Tai_Chi" height="150" width="150">
          <span>Ladies Who Life</span>
        </a>
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

</body>
</html>
