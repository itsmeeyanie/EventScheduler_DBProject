<?php
    include("../includes/session.php");
    require_once("../includes/db_connection.php");
    include("../includes/function.php");

    if(isset($_GET['date'])){
        $ddate = $_GET['date'];
    }

    $today = date_create($ddate);

    //"call viewDataByDate('$ddate')"
    $query = "SELECT * FROM tbl_event  WHERE rdate='$ddate'";
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

  <?php
    if(isset($_GET['order'])){
        $order = $_GET['order'];
    }else{
        $order = 'eid';
    }

    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
    }else{
        $sort = 'ASC';
    }

    $query = "SELECT * FROM tbl_event WHERE rdate='$ddate' ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

  ?>

  <?php 
    $query2 = "SELECT DISTINCT * FROM client";
    $result2 = mysqli_query($connection, $query2);
    if(!$result2) {
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />

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

    <div class="container p-5" style="margin-top: 70px;">
        
        

        <?php
        if (confirm_logged_in()) {
          echo "<div class=\"col-md-3 offset-2\" style=\"float: right;\">
            <button class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#popUpWindow\"><i class=\"fa fa-plus-circle\"> Add Event</i></button>
        </div>";
        }
    ?>
    
    <div class="col-md-12">
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
                                <table class="table table-striped table-bordered table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                                <th class="text-center" width="5%"><a href="?date=<?php echo $ddate; ?>&&order=eid&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                                <th class="text-center" width="17%"><a href="?date=<?php echo $ddate; ?>&&order=stime&&sort=<?php echo $sort; ?>" style="text-decoration: none;"><i class="fa fa-clock-o"></i></a></th>
                                                <th class="text-center" width="28%"><a href="?date=<?php echo $ddate; ?>&&order=event&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Event</a></th>
                                                <th class="text-center" width="15"><a href="?date=<?php echo $ddate; ?>&&order=fname&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organizer</a></th>
                                                <th class="text-center" width="15%"><a href="?date=<?php echo $ddate; ?>&&order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organization</a></th>


                                                <th class="text-center" width="20%"><a href="" style="text-decoration: none;">Action</a></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"> 
                                            <?php
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $id = $row['eid'];
                                                    $event = $row['event'];
                                                    $fname = $row['fname'];
                                                    $org = $row['org'];
                                                    $o_id = $row['o_id'];
                                                    $date = $row['rdate'];
                                                    $stime = $row['stime'];
                                                    $etime = $row['etime'];
       
                                                    echo "<tr>
                                                        <td>".$id."</td>
                                                        <td>".$stime ." - " . $etime."</td>  
                                                        <td>".$event."</td> 
                                                        <td>".$fname."</td>  
                                                        <td>".$org."</td> ";
                                                     if (confirm_logged_in()) {
                                                        echo "<td class=\"text-white\">
                                                            <a href=\"../public/view.php?id=$id&date=$ddate\" class=\"btn btn-circle btn-primary\" type=\"button\" style=\"text-decoration: none;\">View</a>
                                                            <a href=\"../public/edit.php?id=$id&date=$ddate\" class=\"btn btn-circle btn-success\" type=\"button\" style=\"text-decoration: none;\" >Edit</a>
                                                            <a href=\"?idnum=$id&date=$ddate\" class=\"btn btn-circle btn-danger\" type=\"button\" style=\"text-decoration: none;\" name=\"delete\">Delete</a>
                                                            </td>";
                                                    }else{
                                                        echo "<td>N/A</td>";
                                                    }
                                                                                    
                                                        
                                                   echo "<tr>";

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

          <!-- Add Event Modal -->
    <div class="modal fade" id="popUpWindow">
        <div class="modal-dialog pt-5" style="margin-top: 150px;">
            <div class="modal-content">
                <div class="panel-heading modal-header bg-primary">
                    <h4 class="modal-title text-center">Add New Event</h4>
                </div>
                <br>
                <div class="modal-body col-md-10 offset-1">
                    <form class="form-horizontal" action="" method="post">
                            <label>Event Information</label>
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
                                            while($row=mysqli_fetch_assoc($result2)){
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

                                                echo "<option value=\"$org\">$org</option>";
                                            }
                                        ?>
                                  </select>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <div class="col-md-12"><label>[SCHEDULE]</label><br>
                                    <label>Date</label>
                                    <input name="date" class="form-control" value="<?php echo date_format($today, "F d, Y"); ?>" readonly="">
                                </div>
                                <div class="col-sm-6 pt-4"><label>Start</label>
                                    <input name="stime" type="time" class="form-control" placeholder="Start" value="12:00" required=""></div>

                                    
                                    <div class="col-sm-6 pt-4"><label>End</label>
                                    <input name="etime" type="time" class="form-control" placeholder="End" value="12:00" required=""></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 offset-4">
                                    <button type="search" name="add" value="Submit" class="btn btn-primary">
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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
  mysqli_free_result($result);
?>

<?php 

?>

<!-- add --> 
<?php

  if(isset($_POST['add']) ) { 
    $event = mysqli_real_escape_string($connection, $_POST['event']);
    $org = mysqli_real_escape_string($connection, $_POST['org']);
    $fname1 = mysqli_real_escape_string($connection, $_POST['fname']);
    $name_explode = explode('|', $fname1);
    $fname = $name_explode[0];
    $o_id = $name_explode[1];
    $rdate = mysqli_real_escape_string($connection, $_GET['date']);
    $stime = mysqli_real_escape_string($connection, $_POST['stime']);
    $etime = mysqli_real_escape_string($connection, $_POST['etime']);

    $query = "INSERT INTO tbl_event(event, fname, o_id, org, rdate, stime, etime) values ('{$event}', '{$fname}', '{$o_id}', '{$org}', '{$rdate}', '{$stime}', '{$etime}')";
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
                    echo "SUCCESS";
                }else{
                    die("Database query failed. " . mysqli_error($connection));
                }
            }
        ?>

<?php
    mysqli_close($connection);
?>