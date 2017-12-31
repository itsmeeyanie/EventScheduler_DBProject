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

	if(isset($_POST['addclient'])) { 
		$fname = mysqli_real_escape_string($connection, $_POST['fname']);
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$cnum = mysqli_real_escape_string($connection, $_POST['cnum']);
		$stat = mysqli_real_escape_string($connection, $_POST['stat']);
		$org = mysqli_real_escape_string($connection, $_POST['org']);
		$add = mysqli_real_escape_string($connection, $_POST['add']);
		$des = mysqli_real_escape_string($connection, $_POST['des']);
		
		$query = "INSERT INTO client(fname, email, cnum, stat) values ('{$fname}', '{$email}', '{$cnum}', '{$stat}')";
	    $result = mysqli_query($connection, $query);
	    if($result) {
	        redirect_to("../admin/client_form.php");
	    }else{
	        die("Database query failed. " . mysqli_error($connection));
	    }

	    $squery = "INSERT INTO organization(org, ad, description) values ('{$org}', '{$add}', '{$des}')";
	    $sresult = mysqli_query($connection, $squery);
	    if($sresult) {
	    	redirect_to("../admin/client_form.php");
	    	echo "lol";
	    }else{
	        die("Database query failed. " . mysqli_error($connection));
	    }
	}

	    if(isset($_POST['edit']) ) { 
        $id = mysqli_real_escape_string($connection, $_GET['id']);
        $event = mysqli_real_escape_string($connection, $_POST['event']);
        $stime = mysqli_real_escape_string($connection, $_POST['stime']);
        $etime = mysqli_real_escape_string($connection, $_POST['etime']);



        $query = "UPDATE tbl_event SET event='$event', stime='$stime', etime='$etime' WHERE id='$id'";
        $result = mysqli_query($connection, $query);

        if($result) {
          echo "<script type='text/javascript'> alert('success!')</script>";
          echo("<meta http-equiv='refresh' content='1'>");
          redirect_to("../includes/eventlist.php?id=$id");
        }else{
          die("Database query failed. " . mysqli_error($connection));
        }
    }

    if(isset($_GET['idnum'])) { 
                $id = mysqli_real_escape_string($connection, $_GET['idnum']);
                $query = "DELETE FROM tbl_event WHERE id=".$id;
                $result = mysqli_query($connection, $query);
                if($result) {
                    redirect_to("../includes/eventlist.php");
                }else{
                    die("Database query failed. " . mysqli_error($connection));
                }
            }
?>