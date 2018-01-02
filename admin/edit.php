<?php
    require_once('../includes/db_connection.php');

    if(isset($_GET['id'])){
        $data = $_GET['id'];
    }

    //"SELECT * from tbl_event WHERE id=".$data
    $query = "call viewDataById('$data')";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

    while($row=mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $event = $row['event'];
        $fname = $row['fname'];
        $org = $row['org'];
        $cnum = $row['cnum'];
        $rdate = $row['rdate'];
        $stime = $row['stime'];
        $etime = $row['etime'];
    }
    $date = date_create($rdate);
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/font-awesome.css" rel="stylesheet">

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />
</head>
<body>
    <div class="container p-5">
        <div class="col-md-8 pt-5 offset-2">
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel">
                        <div class="panel-heading p-3" style="background-color: #333b44;">
                            <p class="offset-5 text-white">Edit Event</p>
                        </div>
                    
                    <form class="form-horizontal p-5 offset-2" action="../includes/config.php?id=<?php echo $id; ?>" method="post">
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input name="id" class="form-control" value="<?php echo $id; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input class="form-control" value="<?php echo date_format($date, "F d, Y"); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="event" type="" class="form-control" placeholder="Event" value="<?php echo $event; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label>Start</label>
                                    <input name="stime" type="time" class="form-control" placeholder="Start" value="<?php echo $stime; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <label>End</label>
                                    <input name="etime" type="time" class="form-control" placeholder="End" value="<?php echo $etime; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <a type="button" class="btn btn-danger col-md-2" href="../includes/eventlist.php" value="Cancel">Cancel</a>

                                    <button type="submit" name="edit" value="Submit" class="btn btn-success col-md-6 offset-1">
                                        Save
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
  mysqli_free_result($result);
?>

<?php
    mysqli_close($connection);
?>