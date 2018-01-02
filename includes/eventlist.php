<?php
    include("../includes/session.php");
    require_once("../includes/db_connection.php");
    include("../includes/function.php");

    $query = "SELECT * FROM tbl_event";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }else{
      $rowcount=mysqli_num_rows($result);
    }
    // echo("<meta http-equiv='refresh' content='3'>");

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

    $query = "SELECT * FROM tbl_event ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }
    ?>

    <?php

    if(isset($_POST['search'])){
        if(isset($_GET['toSearch'])){
            $toSearch = $_GET['toSearch'];
        }else{
            $toSearch = 'event';
        }

        $val = mysqli_real_escape_string($connection, $_POST['valueToSearch']);
        
        $query = "SELECT * FROM tbl_event WHERE $toSearch regexp '$val'";


        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }


    }elseif(isset($_POST['filter'])){
        $dateFrom = mysqli_real_escape_string($connection, $_POST['dateFrom']);
        $dateTo = mysqli_real_escape_string($connection, $_POST['dateTo']);

        $query = "SELECT * FROM tbl_event WHERE rdate BETWEEN '$dateFrom' and '$dateTo'";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }


    }else{
        $query = "SELECT * FROM tbl_event";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }

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

        $query = "SELECT * FROM tbl_event ORDER BY $order $sort";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }
    }
?>



<!DOCTYPE html>
<html>
<head>
    <title>Event</title>

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


        <div class="offset-1 btn-group pt-5" style="margin-top: 50px;">
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../admin/index.php" style="text-decoration: none; float: left;"><i class="fa fa-calendar"> Calendar View</i></a></button>
            <button class="btn btn-default"><a class="text-dark" href="../includes/eventlist.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> List View</i></a></button>

        </div>

        
    <div class="offset-7" style="margin-top: -35px;">
        <form action="../includes/eventlist.php" method="POST">
            <input type="date" name="dateFrom" placeholder="Date from">
            <input type="date" name="dateTo" placeholder="Date to">
            <input class="btn btn-secondary" type="submit" value="Search" name="filter"> 
        </form>
    </div>

    <div class="col-md-12">
        <div class="pt-5" style="float: right; margin-right: 135px;">
            <form action="../includes/eventlist.php?toSearch=org" method="POST">
                <input name="valueToSearch" placeholder="Search by Organization">
                <input type="hidden" name="search"> 
            </form>
        </div>
        <div class="pt-5" style="float: right;">
            <form action="../includes/eventlist.php?toSearch=fname" method="POST">
                <input name="valueToSearch" placeholder="Search by Organizer">
                <input type="hidden" name="search"> 
            </form>
        </div>
        <div class="pt-5" style="float: right;">
            <form action="../includes/eventlist.php?toSearch=event" method="POST">
                <input name="valueToSearch" placeholder="Search by Event">
                <input type="hidden" name="search">
            </form>
        </div>



    <?php
        if (confirm_logged_in()) {
          echo "<div class=\"col-md-3 offset-1 pt-5 px-5\">
            <a href=\"../admin/add_event.php\" class=\"btn btn-primary text-white\"><i class=\"fa fa-plus-circle\"> Add Event</i></a>
        </div>";
        }
    ?>
    </div>

  <div class="container">

    <div class="col-md-12">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel">
                    <div class="panel-heading p-5" style="background-color: #333b44;">
                        <span class="offset-5 text-white">Event List</span>
                    </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>

                                                <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                                <th class="text-center" ><a href="?order=eid&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                                <th class="text-center" ><a href="?order=stime&&sort=<?php echo $sort; ?>" style="text-decoration: none;"><i class="fa fa-clock-o"></i></a></th>
                                                <th class="text-center" ><a href="?order=event&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Event</a></th>
                                                <th class="text-center" ><a href="?order=fname&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organizer</a></th>
                                                <th class="text-center" ><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organization</a></th>
                                                <th class="text-center" ><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Action</a></th>
                                                
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
                                                        echo "<td class=\"\">
                                                            <a href=\"../public/view.php?id=$id&date=$date\" style=\"text-decoration: none; color: teal;\"> View |</a>
                                                            <a href=\"../admin/edit.php?id=$id\" style=\"text-decoration: none; color: green;\" >Edit |</a>
                                                            <a href=\"../includes/config.php?idnum=$id\" style=\"text-decoration: none; color: brown;\"> Delete</a>
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