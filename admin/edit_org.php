<?php
    require_once('../includes/db_connection.php');

    if(isset($_GET['idd'])){
        $data = $_GET['idd'];
    }

    //"SELECT * from tbl_event WHERE id=".$data
    $query = "SELECT * from organization WHERE id=$data";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed.");
    }

    while($row=mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $org = $row['org'];
        $ad = $row['ad'];
        $des = $row['description'];
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
                            <p class="offset-5 text-white">Edit Event</p>
                        </div>
                    
                    <form class="form-horizontal p-5 offset-2" action="../includes/config.php?id=<?php echo $id; ?>" method="post">
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input name="id" class="form-control" value="<?php echo $id; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                  <input class="form-control" name="org" value="<?php echo $org; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="ad" type="" class="form-control" value="<?php echo $ad; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <input name="des" type="text" class="form-control" value="<?php echo $des; ?>" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-10">
                                    <a type="button" class="btn btn-danger col-md-2" href="../admin/org.php" value="Cancel">Cancel</a>

                                    <button type="submit" name="edit_org" value="Submit" class="btn btn-success col-md-6 offset-1">
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
    mysqli_close($connection);
?>