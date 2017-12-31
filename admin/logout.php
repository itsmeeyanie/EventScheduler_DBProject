
<?php
	include("../includes/session.php");
?>


<?php  
	session_destroy();
	$_SESSION['user'] = null;
	echo "<script type='text/javascript'> alert('Logged out!')</script>";

	redirect_to("../public/index.php");


    function redirect_to($new_location) {
        header("Location: ". $new_location);
        exit;
    }
    function confirm_logged_in() {
        if (isset($_SESSION['user'])) {
            return true;
        }else{
            return false;
        }
    }
?>
