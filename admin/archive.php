<?php
include("../includes/session.php");
include("../includes/function.php"); 

require_once("../includes/db_connection.php");



    if(isset($_GET['order'])){
        $order = $_GET['order'];
    }else{
        $order = 'id';
    }

    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
    }else{
        $sort = 'ASC';
    }

    $query = "SELECT * FROM tbl_logs ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed."  . mysqli_error($connection));
    }

?>

<?php

    if(isset($_POST['filter'])){
        $dateFrom = mysqli_real_escape_string($connection, $_POST['dateFrom']);
        $dateTo = mysqli_real_escape_string($connection, $_POST['dateTo']);

        $query = "SELECT * FROM tbl_logs WHERE on_date BETWEEN '$dateFrom' and '$dateTo'";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }


    }else{
        $query = "SELECT * FROM tbl_logs ORDER BY on_date DESC";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }

        if(isset($_GET['order'])){
            $order = $_GET['order'];
        }else{
            $order = 'on_date';
        }

        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
        }else{
            $sort = 'ASC';
        }
        

        $query = "SELECT * FROM tbl_logs ORDER BY $order $sort";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed."  . mysqli_error($connection));
        }
    }
?>




<!DOCTYPE html>
<html>
<head>
	<title>Event Calendar</title>
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

    <div class="offset-7" style="margin-top: 80px;">
        <form action="archive.php" method="POST">
            <input type="date" name="dateFrom" placeholder="Date from">
            <input type="date" name="dateTo" placeholder="Date to">
            <input class="btn btn-secondary" type="submit" value="Search" name="filter"> 
        </form>
    </div>

    <div class="col-md-10 offset-1">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading p-4 bg-dark">
                        <p class="offset-5 text-white">Logs</p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                        <th class="text-center"><a href="?order=action&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Action</a></th>
                                        <th class="text-center"><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Data ID</a></th>
                                        <th class="text-center"><a href="?order=data&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Data</a></th>
                                        <th class="text-center"><a href="?order=tbl_name&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Table Name</a></th>
                                        <th class="text-center"><a href="?order=on_date&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Date</a></th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center"> 
                                        <?php
                                            while($row=mysqli_fetch_assoc($result)){
                                                $action = $row['action'];
                                                $id = $row['id'];
                                                $data = $row['data'];
                                                $tbl_name = $row['tbl_name'];
                                                $date = $row['on_date'];
                                                $tdate = date_create($date);
                                        echo "<tr>
                                                <td>".$action."</td>
                                                <td>".$id."</td>  
                                                <td>".$data."</td> 
                                                <td>".$tbl_name."</td>  
                                                <td>".date_format($tdate, "F d, Y")."</td>
                                            <tr>";

                                            }   
                                        ?>
                                                
                                </tbody>
                            </table> 
                            <?php
                                    if($rowcount==0){
                                        echo "<span style=\"font-size: 16px;\"><b>No result.</b></span>";
                                        // echo("<meta http-equiv='refresh' content='1'>");
                                    }
                                ?> 
                        </div>
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