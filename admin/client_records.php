<?php
include("../includes/session.php");
include("../includes/function.php"); 

require_once("../includes/db_connection.php");


    $qu = "SELECT * FROM client";
    $res = mysqli_query($connection, $qu);
    if(!$res) {
      die("Database query failed.");
    }else{
      $rowcount=mysqli_num_rows($res);
    }

    $squery = "SELECT * FROM organization";
    $sresult = mysqli_query($connection, $squery);
    if(!$sresult) {
      die("Database query failed.");
    }else{
      $srowcount=mysqli_num_rows($sresult);
    }

    while($srow=mysqli_fetch_assoc($sresult)){
        $sid = $srow['id'];
        $org = $srow['org'];
        $ad = $srow['ad'];
        $des = $srow['description'];
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

    $query = "SELECT * FROM client ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed." . mysqli_error($connection));
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Calendar</title>
	<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../style.css">

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
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../admin/client_form.php" style="text-decoration: none; float: left;"><i class="fa fa-pencil-square-o"> Form</i></a></button>
            <button class="btn btn-default"><a class="text-dark" href="../admin/client_records.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> Record</i></a></button>
        </div>
    </div>

    <div class="col-md-10 offset-1">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading p-5 bg-dark">
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                        <th class="text-center"><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                        <th class="text-center"><a href="?order=fname&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organizer</a></th>
                                        <th class="text-center"><a href="?order=email&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Email</a></th>
                                        <th class="text-center"><a href="?order=cnum&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Contact</a></th>
                                        <th class="text-center"><a href="?order=stat&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Status/Position</a></th>
                                        <th class="text-center"><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organization</a></th>
                                        <th class="text-center" width="20%"><a href="" style="text-decoration: none;">Action</a></th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center"> 
                                        <?php
                                            while($row=mysqli_fetch_assoc($res)){
                                                $id = $row['id'];
                                                $fname = $row['fname'];
                                                $email = $row['email'];
                                                $cnum = $row['cnum'];
                                                $stat = $row['stat'];
                                        echo "<tr>
                                                <td>".$id."</td>
                                                <td>".$fname."</td>  
                                                <td>".$email."</td> 
                                                <td>".$cnum."</td>  
                                                <td>".$stat."</td> 
                                                <td>".$org."</td> 
                                            <tr>";

                                            }   
                                        ?>
                                                
                                </tbody>
                            </table> 

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