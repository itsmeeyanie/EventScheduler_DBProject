<?php
    require_once('../includes/db_connection.php');

    if(isset($_GET['date'])){
        $ddate = $_GET['date'];
    }

    $today = date_create($ddate);

    //"SELECT * FROM tbl_event  WHERE rdate='$ddate'"
    $query = "call viewDataByDate('$ddate')";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }else{
      $rowcount=mysqli_num_rows($result);
    }
    
  ?>

  <?php
    if(isset($_GET['id'])){
        $data = $_GET['id'];
    }
  ?>

<!DOCTYPE html>
<html>
<head>
    <title>Function here</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />

</head>
<body>

    <div class="container navbar-default p-5" style="margin-top: 30px;">
        <a class="offset-2" href="../calendar.php" style="text-decoration: none; float: left; font-size: 20px; color: teal;"><i class="fa fa-calendar"> CALENDAR</i></a>
        <div class="col-md-3 offset-2" style="float: right;">
            <button class="btn btn-primary" data-toggle="modal" data-target="#popUpWindow">+ Add Event</button>
        </div>


        <!-- Add Event Modal -->
    <div class="modal fade" id="popUpWindow">
        <div class="modal-dialog pt-5" style="margin-top: 150px;">
            <div class="modal-content">
                <div class="panel-heading modal-header bg-primary">
                    <h4 class="modal-title text-center">Add New Event</h4>
                </div>
                <br>
                <div class="modal-body">
                    <form class="form-horizontal" action="" method="post">
                            <label>Event Information</label>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input class="form-control" value="<?php echo date_format($today, "F d, Y"); ?>" readonly="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="event" type="" class="form-control" placeholder="Event" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="fname" type="text" class="form-control" placeholder="Organizer" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="org" type="text" class="form-control" placeholder="Organization" value="" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="cnum" type="number" class="form-control" placeholder="Contact Number" value="" required="">
                                </div>
                            </div>
                                
                            <label>[SCHEDULE]</label>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label>Start</label>
                                    <input name="stime" type="time" class="form-control" placeholder="Start" value="12:00" required="">

                                    <label>End</label>
                                    <input name="etime" type="time" class="form-control" placeholder="End" value="12:00" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 offset-4">
                                    <button type="submit" name="add" value="Submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-10 offset-1">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel">
                    <div class="panel-heading p-5" style="background-color: #333b44;">
                        <span class="col-md-8 offset-5 text-white"><?php echo date_format($today, "F d, Y"); ?></span>
                    </div>

                    <div class="panel-body">
                        <div class="panel panel-default">
                         <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                            <tr>
                                                <th class="text-center" width="5%">#</th>
                                                <th class="text-center" width="25%"><i class="fa fa-clock-o"></th>
                                                <th class="text-center" width="40%">Event</th>
                                                <th class="text-center" width="25%">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"> 
                                            <?php
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $id = $row['id'];
                                                    $event = $row['event'];
                                                    $fname = $row['fname'];
                                                    $org = $row['org'];
                                                    $cnum = $row['cnum'];
                                                    $date = $row['rdate'];
                                                    $stime = $row['stime'];
                                                    $etime = $row['etime'];
                                                    
                                                    echo "<tr>
                                                        <td>".$id."</td>
                                                        <td>".$stime ." - " . $etime."</td>  
                                                        <td>".$event."</td> 
                                                        <td class=\"text-white\">
                                                            <a href=\"../includes/view.php?id=$id&date=$ddate\" class=\"btn btn-circle btn-primary\" type=\"button\" style=\"text-decoration: none;\">View</a>
                                                            <a href=\"../includes/edit.php?id=$id&date=$ddate\" class=\"btn btn-circle btn-success\" type=\"button\" style=\"text-decoration: none;\" >Edit</a>
                                                            <a href=\"?idnum=$id&date=$ddate\" class=\"btn btn-circle btn-danger\" type=\"button\" style=\"text-decoration: none;\" name=\"delete\">Delete</a>
                                                    </td>   
                                                        
                                                    <tr>";

                                                }   
                                        ?>
                                                
                                        </tbody>
                            </table> 

                                <?php
                                    if($rowcount==0){
                                        echo "<span style=\"font-size: 16px;\"><b>No schedule.</b></span>";
                                    }
                                ?>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
  </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
  mysqli_free_result($result);
?>

<!-- add -->
<?php

  if(isset($_POST['add']) ) { 
    $event = mysqli_real_escape_string($connection, $_POST['event']);
    $org = mysqli_real_escape_string($connection, $_POST['org']);
    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $cnum = mysqli_real_escape_string($connection, $_POST['cnum']);
    $rdate = mysqli_real_escape_string($connection, $_GET['date']);
    $stime = mysqli_real_escape_string($connection, $_POST['stime']);
    $etime = mysqli_real_escape_string($connection, $_POST['etime']);

    //"INSERT INTO tbl_event(event, fname, org, cnum, rdate, stime, etime) values ('{$event}', '{$fname}', '{$org}', '{$cnum}', '{$rdate}', '{$stime}', '{$etime}')"
    //"call add_event('$event', '$fname', '$org'. '$cnum', '$rdate', '$stime', '$etime')"
    $query = "INSERT INTO tbl_event(event, fname, org, cnum, rdate, stime, etime) values ('{$event}', '{$fname}', '{$org}', '{$cnum}', '{$rdate}', '{$stime}', '{$etime}')";
    $result = mysqli_query($connection, $query);
    if($result) {
        echo("<meta http-equiv='refresh' content='1'>");
    }else{
        die("Database query failed. " . mysqli_error($connection));
    }
  }
?>

<!-- Edit -->
<?php
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
        }else{
          die("Database query failed. " . mysqli_error($connection));
        }
    }
?>

<!-- Delete -->
<?php

            if(isset($_GET['idnum'])) { 
                $id = mysqli_real_escape_string($connection, $_GET['idnum']);
                $query = "DELETE FROM tbl_event WHERE id=".$id;
                $result = mysqli_query($connection, $query);
                if($result) {
                    // echo "<script type='text/javascript'> alert('success!')</script>";
                    // header('Location: ../includes/event.php');
                    // echo("<meta http-equiv='refresh' content='1'>");
                }else{
                    die("Database query failed. " . mysqli_error($connection));
                }
            }
        ?>

<?php
    mysqli_close($connection);
?>