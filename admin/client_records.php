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

    $query = "SELECT * FROM client ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed."  . mysqli_error($connection));
    }

?>

<?php

    if(isset($_POST['search'])){
        if(isset($_GET['toSearch'])){
            $toSearch = $_GET['toSearch'];
        }else{
            $toSearch = 'fname';
        }

        $val = mysqli_real_escape_string($connection, $_POST['val']);
        
        $query = "SELECT * FROM client WHERE $toSearch regexp '$val'";


        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }


    }else{
        $query = "SELECT * FROM client";
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
       

        $query = "SELECT * FROM client ORDER BY $order $sort";
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

    <div class="col-md-12">
        <div class="offset-1 pt-5 btn-group" style="margin-top: 50px;">
            <button class="btn btn-default"><a class="text-dark" href="../admin/client_records.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> Record</i></a></button>
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../admin/client_form.php" style="text-decoration: none; float: left;"><i class="fa fa-pencil-square-o"> Form</i></a></button>
        </div>
        <div >
            <div class="" style="float: right; margin-right: 135px; margin-top: -25px;">
                <form action="../admin/client_records.php?toSearch=org" method="POST">
                    <input name="val" placeholder="Search by Organization">
                    <input type="hidden" name="search">
                </form>
            </div>

            <div class="" style="float: right;  margin-top: -25px;">
                <form action="../admin/client_records.php?toSearch=stat" method="POST">
                    <input name="val" placeholder="Search by Status">
                    <input type="hidden" name="search"> 
                </form>
            </div>

            <div class="" style="float: right;  margin-top: -25px;">
                <form action="../admin/client_records.php?toSearch=fname" method="POST">
                    <input name="val" placeholder="Search by Name">
                    <input type="hidden" name="search"> 
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-10 offset-1">
        <div class="panel-body">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading p-4 bg-dark">
                        <p class="offset-5 text-white">Client's Personal Information</p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <?php $sort == 'DESC' ? $sort = 'ASC' : $sort = 'DESC'; ?>
                                        <th class="text-center" width="3%"><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                        <th class="text-center" width="15%"><a href="?order=fname&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organizer</a></th>
                                        <th class="text-center" width="15%"><a href="?order=email&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Email</a></th>
                                        <th class="text-center" width="12%"><a href="?order=cnum&&sort=<?php echo $sort; ?>" style="text-decoration: none;" >Contact</a></th>
                                        <th class="text-center" width="22%"><a href="?order=stat&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Status/Position</a></th>
                                        <th class="text-center" width="23%"><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Organization</a></th>
                                        <th class="text-center" width="10%"><a href="" style="text-decoration: none;">Action</a></th>
                                    </tr>
                                </thead>
                                    <tbody class="text-center"> 
                                        <?php
                                            while($row=mysqli_fetch_assoc($result)){
                                                $id = $row['id'];
                                                $fname = $row['fname'];
                                                $email = $row['email'];
                                                $cnum = $row['cnum'];
                                                $stat = $row['stat'];
                                                $org = $row['org'];
                                        echo "<tr>
                                                <td>".$id."</td>
                                                <td>".$fname."</td>  
                                                <td>".$email."</td> 
                                                <td>".$cnum."</td>  
                                                <td>".$stat."</td> 
                                                <td><a href=\"../admin/org.php?idd=$id\" style=\"text-decoration: none; color: orange;\" >".$org."</a></td> 
                                                
                                                <td class=\"\">
                                                    <a href=\"../admin/client_edit.php?id=$id\" style=\"text-decoration: none; color: green;\" >Edit |</a>
                                                    <a href=\"../includes/config.php?idn=$id\" style=\"text-decoration: none; color: brown;\"> Delete</a>
                                                </td>
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