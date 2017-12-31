<?php
include("../includes/session.php");
include("../includes/function.php"); 

?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Calendar</title>
	<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../style.css">

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    <style type="text/css">
        .wrapper {
		    background-color: #353c47;
		    height: 720px;
		    width: auto;
		    text-align: center;
		}

.booknow_button {
	width: 12rem;
	height: 4rem;
  	margin-top: 30rem;
  	font-weight: bolder;
  	border: 2px solid #f8f4f4;
	box-shadow:0 0 1px #fff;
	border-radius: 20px;
}
    </style>
</head>
<body>
<!-- Navigation -->
    <?php
        if (confirm_logged_in()) {
          include("../includes/nav-login.php");
        }else{
          include("../includes/nav.php");
        }
    ?>

    <div class="wrapper">
    	<p class="text-white p-5" style="margin-top: 200px; font-size: 70px;">Brand Name</p>
      <p class="text-white" style="margin-top: -20px; font-size: 30px;">The intelligent way to plan.</p>
    	<div class="card-img-overlay" style="margin-top: 70px;">
                <div class="container text-center pt-5">
                  <a href="../includes/login.php">
                    <button class="btn booknow_button btn-danger" type="button">Get Started</button>
                  </a>
              </div>
    </div>

    <div class="p-5 navbar-fixed-bottom" style="background-color: white;">
        
    </div>
</body>
</html>