<?php 
	include("../includes/session.php");
    require_once("../includes/db_connection.php");
    include("../includes/function.php");

    $query = "SELECT DISTINCT * FROM client";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

    $query1 = "SELECT DISTINCT * FROM organization";
    $result1 = mysqli_query($connection, $query1);
    if(!$result1) {
      die("Database query failed.");
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Function here</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />

</head>
<body>
	<div class="container col-md-8">
        <div class="panel" style="margin-top: 50px; margin-left: 500px;">
            <div class="panel-body navbar-default">
                <div class="panel-heading" style="background-color: #343a40; color: white;">
                    <h4 class="panel-title text-center text-white">Add New Event</h4>
                </div>
                <br>
                <div class="panel-body">
                    <form class="form-horizontal" action="" method="post">
                            <div class="form-group">
                                <div class="">
                                    <input name="event" type="" class="form-control" placeholder="Event" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6"><label>Organizer</label>
                                    <select name="fname" type="text" class="form-control" placeholder="Organizer" value="" required="">
                                    	<option value selected ></option>
                                    	<?php 
                                    		while($row=mysqli_fetch_assoc($result)){
										    	$id = $row['id'];
										    	$fname = $row['fname'];

										    	echo "<option value=\"$fname|$id\">$fname</option>";
										    }
                                    	?>
			                        </select>
			                    </div>
			                <div>
			                <div class="form-group">
                                <div class="col-md-6"><label>Organization</label>
                                    <select name="org" type="text" class="form-control" placeholder="Organizer" value="" required="">
                                    	<option value selected ></option>
                                    	<?php 
                                    		while($row=mysqli_fetch_assoc($result1)){
										    	$id = $row['id'];
										    	$org = $row['org'];

										    	echo "<option value=".$org.">$org</option>";
										    }
                                    	?>
			                      </select>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <div class="col-md-12"><label>[SCHEDULE]</label><br>
                                	<label>Date</label>
                                    <input name="date" type="date" class="form-control" placeholder="Date" value="" required="">
                                </div>
                                <div class="col-sm-6 pt-4"><label>Start</label>
                                    <input name="stime" type="time" class="form-control" placeholder="Start" value="12:00" required=""></div>

                                    
                                    <div class="col-sm-6 pt-4"><label>End</label>
                                    <input name="etime" type="time" class="form-control" placeholder="End" value="12:00" required=""></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 btn-group">
                                    <a href="../includes/eventlist.php" type="button" class="btn btn-danger col-md-4 ">Cancel</a> 
                                
                                    <button type="search" name="add" value="Submit" class="btn btn-primary col-md-8 bg-dark">
                                        Submit
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

<!-- add --> 
<?php

  if(isset($_POST['add']) ) { 
    $event = mysqli_real_escape_string($connection, $_POST['event']);
    $org = mysqli_real_escape_string($connection, $_POST['org']);
    $fname1 = mysqli_real_escape_string($connection, $_POST['fname']);
    $name_explode = explode('|', $fname1);
    $fname = $name_explode[0];
    $o_id = $name_explode[1];
    $rdate = mysqli_real_escape_string($connection, $_POST['date']);
    $stime = mysqli_real_escape_string($connection, $_POST['stime']);
    $etime = mysqli_real_escape_string($connection, $_POST['etime']);

    $query = "INSERT INTO tbl_event(event, fname, o_id, org, rdate, stime, etime) values ('{$event}', '{$fname}', '{$o_id}', '{$org}',  '{$rdate}', '{$stime}', '{$etime}')";
    $result = mysqli_query($connection, $query);
    if($result) {
        echo("<meta http-equiv='refresh' content='1'>");
    }else{
        die("Database query failed. " . mysqli_error($connection));
    }
  }
?>