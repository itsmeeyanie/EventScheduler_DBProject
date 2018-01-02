<?php
    require_once('../includes/db_connection.php');

    if(isset($_GET['id'])){
        $data = $_GET['id'];
    }

    if(isset($_GET['date'])){
        $ddate = $_GET['date'];
    }

    $date = date_create($ddate);

    //"SELECT * from tbl_event WHERE id=".$data
    $query = "SELECT * from tbl_event left join client on (tbl_event.o_id = client.id) left join organization on (tbl_event.o_id = organization.id) WHERE eid=$data";

    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

    while($row=mysqli_fetch_assoc($result)){
        $id = $row['eid'];
        $event = $row['event'];
        $fname = $row['fname'];
        $org = $row['org'];
        $o_id = $row['o_id'];
        $rdate = $row['rdate'];
        $stime = $row['stime'];
        $etime = $row['etime'];
        $email = $row['email'];
        $cnum = $row['cnum'];
        $stat = $row['stat'];
        $ad = $row['ad'];
        $description = $row['description'];
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

                                <h5 style="color: brown;"><b>Event Details</b></h5>
                                <label>Date: </label>
                                <span class="offset-2 p-4" style="color: teal;"><strong><?php echo date_format($date, "F d, Y"); ?></strong></span>
                                <br>

                                <label>Event: </label>
                                <span class="offset-2 p-4" style="color: teal;"><strong><?php echo $event; ?></strong></span>

                            <br>
                                <label>Start: </label>
                                <span class="offset-2 p-5" style="color: teal;"><strong><?php echo $stime; ?></strong></span>
                         <br>               
                                <label>End: </label>
                                <span class="offset-2 p-5" style="color: teal;"><strong><?php echo $etime; ?></strong></span>

                                <br>
                                <h5 style="color: brown;"><b>Contact Details</b></h5>
                                <label>Name: </label>
                                <span class="offset-2 p-4" style="color: teal;"><strong><?php echo $fname; ?></strong></span>
                                <br>
                                <label>Status: </label>
                                <span class="offset-2 p-5" style="color: teal;"><strong><?php echo $stat; ?></strong></span>
                                <br>
                                <label>Email: </label>
                                <span class="offset-2 p-5" style="color: teal;"><strong><?php echo $email; ?></strong></span>
                         <br>               
                                <label>Contact Number: </label>
                                <span class="offset-1 " style="color: teal;"><strong><?php echo $cnum; ?></strong></span>
                            <br>
                                <h5 style="color: brown;"><b>Organization</b></h5>
                                <label>Organization: </label>
                                <span class="offset-1" style="color: teal;"><strong><?php echo $org; ?></strong></span>
                                <br>
                                <label>Address: </label>
                                <span class="offset-1" style="color: teal;"><strong><?php echo $ad; ?></strong></span>
                                <br>
                                <label>Description: </label>
                                <span class="offset-1" style="color: teal;"><strong><?php echo $description; ?></strong></span>
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