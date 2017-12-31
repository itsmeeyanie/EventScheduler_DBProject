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

    <div class="col-md-12">
        <div class="offset-1 pt-5 btn-group" style="margin-top: 50px;">
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../admin/client_form.php" style="text-decoration: none; float: left;"><i class="fa fa-pencil-square-o"> Form</i></a></button>
            <button class="btn btn-default"><a class="text-dark" href="../admin/client_records.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> Record</i></a></button>
        </div>
    </div>
    <div class="container navbar-default">
        <div class="col-md-8 offset-2">
            <div class="panel-body">
                <div class="panel-group">
                        <div class="panel-heading p-3" >
                            <p style="font-weight: bolder; color: brown;">Fill up the form.</p>
                        </div>
                    
                    <form class="form-horizontal" action="../includes/config.php" method="post">
                      <label>Personal Information</label>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="text" name="fname" class="form-control" placeholder="Fullname" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="email" name="email" class="form-control" placeholder="Email Address" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="number" name="cnum" class="form-control" placeholder="Contact Number" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="text" name="stat" class="form-control" placeholder="Status/Position" value="" required>
                                </div>
                            </div>
                            <label>Organization Details</label>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="text" name="org" class="form-control" placeholder="Organization" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="text" name="add" class="form-control" placeholder="Address" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                  <input type="text" name="des" class="form-control" placeholder="Description" value="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" name="addclient" value="Submit" class="btn btn-success col-md-12">
                                        Save
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
        </div>
    </div>
</div>

</body>
</html>