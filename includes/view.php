<?php
    require_once('../includes/db_connection.php');

    if(isset($_GET['id'])){
        $data = $_GET['id'];
    }

    if(isset($_GET['date'])){
        $ddate = $_GET['date'];
    }

    $date = date_create($ddate);


    $query = "SELECT * from tbl_event WHERE id=".$data;
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
?>

<?php
  mysqli_free_result($result);
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
    <div class="pt-5 offset-2">
        <a class="p-5" href="#" onclick="history.go(-1)">
            <button class="btn btn-default">Back</button>
        </a>
    </div>
    <div class="container">
        <div class="col-md-8 offset-2">
            <div class="panel-body">
                <div class="panel-group" id="accordion">
                    <div class="panel">
                        <div class="panel-heading p-0 col-md-10" style="background-color: #333b44;">
                            <p class="offset-5 text-white">View Details</p>
                        </div>
                    
                    <form class="form-horizontal offset-2 col-md-10 pt-5" action="" method="">
                        <div class="form-group">
                            <div class="col-md-8">

                                <label>Date: </label>
                                <span class="offset-2 p-4" style="color: teal;"><strong><?php echo date_format($date, "F d, Y"); ?></strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">

                                <label>Event: </label>
                                <span class="offset-2 p-4" style="color: teal;"><strong><?php echo $event; ?></strong></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Name: </label>
                                <span class="offset-2 p-4" style="color: teal;"><strong><?php echo $fname; ?></strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Organization: </label>
                                <span class="offset-1" style="color: teal;"><strong><?php echo $org ?></strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Contact: </label>
                                <span class="offset-1 p-5" style="color: teal;"><strong><?php echo $cnum; ?></strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Start: </label>
                                <span class="offset-2 p-5" style="color: teal;"><strong><?php echo $stime; ?></strong></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">                
                                <label>End: </label>
                                <span class="offset-2 p-5" style="color: teal;"><strong><?php echo $etime; ?></strong></span>
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
    mysqli_close($connection);
?>