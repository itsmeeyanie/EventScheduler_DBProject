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

    $query = "SELECT * FROM tbl_event ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

  ?>



<!DOCTYPE html>
<html>
<head>
    <title>Function here</title>

    <!-- Bootstrap core CSS -->
     <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />

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
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../admin/index.php" style="text-decoration: none; float: left;"><i class="fa fa-calendar"> Calendar View</i></a></button>
            <button class="btn btn-default"><a class="text-dark" href="../includes/eventlist.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> List View</i></a></button>
        </div>
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
                                                <th class="text-center" ><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
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
                                                        <td>".$fname."</td>  
                                                        <td>".$org."</td> ";

                                                    if (confirm_logged_in()) {
                                                        echo "<td class=\"\">
                                                            <a href=\"\" style=\"text-decoration: none; color: teal;\"> View |</a>
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
                                        echo "<span style=\"font-size: 16px;\"><b>No schedule.</b></span>";
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