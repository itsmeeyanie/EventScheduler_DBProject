<?php
    require_once('../includes/db_connection.php');
    include("../includes/function.php");

    if(isset($_GET['id'])){
        $data = $_GET['id'];
    }

    //"SELECT * from tbl_event WHERE id=".$data
    $query = "SELECT * from client WHERE id=$data";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

    while($row=mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $fname = $row['fname'];
        $email = $row['email'];
        $cnum = $row['cnum'];
        $status = $row['stat'];
        $org = $row['org'];
    }
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
                            <p class="offset-5 text-white">Edit Details</p>
                        </div>
                    
                    <form class="form-horizontal p-5 offset-2" method="post">
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input name="id" class="form-control" value="<?php echo $id; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input name="fname" class="form-control" value="<?php echo $fname; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="email" type="" class="form-control" value="<?php echo $email; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input name="cnum" class="form-control" value="<?php echo $cnum; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="stat" type="" class="form-control" value="<?php echo $status; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="org" type="" class="form-control" value="<?php echo $org; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <a type="button" class="btn btn-danger col-md-2 text-white" onclick="history.go(-1)" value="Cancel">Cancel</a>

                                    <button type="submit" name="update" value="Submit" class="btn btn-success col-md-6 offset-1">
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
    if(isset($_POST['update']) ) { 
        $id = mysqli_real_escape_string($connection, $_GET['id']);
        $fname = mysqli_real_escape_string($connection, $_POST['fname']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $cnum = mysqli_real_escape_string($connection, $_POST['cnum']);
        $stat = mysqli_real_escape_string($connection, $_POST['stat']);
        $org = mysqli_real_escape_string($connection, $_POST['org']);


        $query = "UPDATE client SET fname='$fname', email='$email', cnum='$cnum', stat='$stat', org='$org' WHERE id='$id'";
        $result = mysqli_query($connection, $query);

        if($result) {
          echo "<script type='text/javascript'> alert('success!')</script>";
          redirect_to("../admin/client_records.php?id=$id");
        }else{
          die("Database query failed. " . mysqli_error($connection));
        }
    }
?>

<?php
    mysqli_close($connection);
?>