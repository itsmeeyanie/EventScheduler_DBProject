<?php 
	
	include("../includes/session.php");
	require_once('../includes/db_connection.php');
	include("../includes/function.php");

	if(isset($_POST['submit'])) { 
		$username = mysqli_real_escape_string($connection, $_POST['username']);
		$password = mysqli_real_escape_string($connection, $_POST['password']);

			$query = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($connection, $query);

			if (mysqli_num_rows($results) == 1) { 
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {
					$_SESSION['user'] = $logged_in_user;
					redirect_to("../admin/index.php");		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					
				}
			}else {
				echo "<script type='text/javascript'> alert('Wrong username/password combination')</script>";
			}
	}
?>