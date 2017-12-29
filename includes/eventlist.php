<?php
  require_once('../includes/db_connection.php');

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

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="../assets/css/custom-styles.css" rel="stylesheet" />

</head>
<body>
  <div class="container navbar-default p-5" style="margin-top: 30px;">
        <h5>
            <a class="offset-1" href="../calendar.php" style="text-decoration: none; float: left; font-size: 20px; color: teal;"><i class="fa fa-calendar"> CALENDAR</i></a>
        </h5>

    
    <div class="col-md-12">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel">
                    <div class="panel-heading p-5" style="background-color: #333b44;">
                        <span class="col-md-8 offset-5 text-white">Event List</span>
                    </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="myTable">
                                        <thead>
                                            <tr>
                                                <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                                <th class="text-center" width="5%"><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                                <th class="text-center" width="20%"><a href="?order=stime&&sort=<?php echo $sort; ?>" style="text-decoration: none;"><i class="fa fa-clock-o"></i></a></th>
                                                <th class="text-center" width="35%"><a href="?order=event&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Event</a></th>
                                                <th class="text-center" width="20%"><a href="?order=fname&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organizer</a></th>
                                                <th class="text-center" width="20%"><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organization</a></th>
                                                
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
                                                        <td>".$org."</td> 
                                                        
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


</body>
</html>

  <?php
    mysqli_free_result($result);
  ?>

<?php
  mysqli_close($connection);
?>