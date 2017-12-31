
<?php
	include("../includes/session.php");
	require_once('../includes/db_connection.php');
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

    <style>
		body{
			width: 500px;
	    margin: 0;
	    overflow-y: hidden;
	    overflow-x: hidden;
			margin-left: 4.5in;
			margin-top: 2in;
			background-color: #353c47;
		}
		form {
			border: 3px solid #f1f1f1;
			text-align: center;
			background-color: brown;
		}

		input[type=text], input[type=password] {
		    width: 100%;
		    padding: 12px 20px;
		    margin: 8px 0;
		    display: inline-block;
		    border: 1px solid #ccc;
		    box-sizing: border-box;
		}

		button {
		    background-color: gray;
		    color: white;
		    padding: 14px 20px;
		    margin: 8px 0;
		    border: none;
		    cursor: pointer;
		    width: 100%;
		}

		button:hover {
		    opacity: 0.8;

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

<form action="config.php" method="POST">
    <h3 class="text-white">Welcome back!</h3>

  <div class="container col-md-12">
    <input type="text" placeholder="Username" name="username" required>
    <input type="password" placeholder="Password" name="password" required>
        
    <button type="submit" name="submit">Login</button>
  </div>

</form>

    <div class="p-5 navbar-fixed-bottom" style="background-color: white;">
        
    </div>

</body>
</html>
