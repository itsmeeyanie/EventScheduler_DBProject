<?php
include("../includes/session.php");
include("../includes/function.php"); 

require_once("../includes/db_connection.php");

    // if (isset($_GET['idd'])) {
    //     $idd = $_GET['idd'];
    // }

    $query = "SELECT * FROM organization";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
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

    $query = "SELECT * FROM organization ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed."  . mysqli_error($connection));
    }

  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Calendar</title>
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
            <button class="btn btn-default"><a class="text-dark" href="../admin/client_records.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> Record</i></a></button>
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../admin/client_form.php" style="text-decoration: none; float: left;"><i class="fa fa-pencil-square-o"> Form</i></a></button>
        </div>
    </div>

    <div class="col-md-10 offset-1">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading p-4 bg-dark">
                        <p class="offset-5 text-white">Organization Details</p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                        <th class="text-center" width="5%"><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                        <th class="text-center" width="25%"><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organization</a></th>
                                        <th class="text-center" width="30%"><a href="?order=description&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Description</a></th>
                                        <th class="text-center" width="30%"><a href="?order=ad&&sort=<?php echo $sort; ?>" style="text-decoration: none;" >Address</a></th>
                                        <th class="text-center" width="10%"><a href="" style="text-decoration: none;">Action</a></th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center"> 
                                        <?php
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id = $row['id'];
                                                $org = $row['org'];
                                                $ad = $row['ad'];
                                                $des = $row['description'];
                                        echo "<tr>
                                                <td>".$id."</td>
                                                <td>".$org."</td>
                                                <td>".$des."</td>   
                                                <td>".$ad."</td> 
                                                <td class=\"\">
                                                    <a href=\"../admin/edit_org.php?idd=$id\" style=\"text-decoration: none; color: green;\" >Edit |</a>
                                                    <a href=\"../includes/config.php?idnu=$id\" style=\"text-decoration: none; color: brown;\"> Delete</a>
                                                </td>
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