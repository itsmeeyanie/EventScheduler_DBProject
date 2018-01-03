<?php
    include("../includes/session.php");
    require_once("../includes/db_connection.php");
    include("../includes/function.php");

    $query = "SELECT * FROM admin";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed." . mysqli_error($connection));
    }else{
      $rowcount=mysqli_num_rows($result);
    }
    // echo("<meta http-equiv='refresh' content='3'>");

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

    $query = "SELECT * FROM admin ORDER BY $order $sort";
    $result = mysqli_query($connection, $query);
    if(!$result) {
      die("Database query failed." . mysqli_error($connection));
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
        
        $query = "SELECT * FROM admin WHERE $toSearch regexp '$val'";


        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }


    }elseif(isset($_POST['filter'])){
        $dateFrom = mysqli_real_escape_string($connection, $_POST['dateFrom']);
        $dateTo = mysqli_real_escape_string($connection, $_POST['dateTo']);

        $query = "SELECT * FROM admin WHERE rdate BETWEEN '$dateFrom' and '$dateTo'";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }else{
          $rowcount=mysqli_num_rows($result);
        }


    }else{
        $query = "SELECT * FROM admin";
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

        $query = "SELECT * FROM admin ORDER BY $order $sort";
        $result = mysqli_query($connection, $query);
        if(!$result) {
          die("Database query failed.");
        }
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

    <style>
        body{
            width: 500px;
        
        }


        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .btton {
            background-color: gray;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }


    </style>
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

    <div class="offset-3" style="float: left; margin-top: 150px">
        <form action="" method="POST">

          <div class="container col-md-12">
            <input type="text" placeholder="Full Name" name="fname" required>
            <input type="text" placeholder="Username" name="username" required>
            <input type="password" placeholder="Password" name="password" required>
                
            <button class="btton" type="submit" name="login">REGISTER</button>
          </div>
        </form>
    </div>

  <div class="container">

    <div class="col-md-8" style="float: right; margin-top: 100px; margin-right: -170px;">
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
                                                <th class="text-center"  width="5%"><a href="?order=id&&sort=<?php echo $sort; ?>" style="text-decoration: none;">#</a></th>
                                                <th class="text-center" width="40%" ><a href="?order=username&&sort=<?php echo $sort; ?>" style="text-decoration: none;"><i class="fa fa-user" width="40%"></i>Name</a></th>
                                                <th class="text-center" width="40%" ><a href="?order=flname&&sort=<?php echo $sort; ?>" style="text-decoration: none;" width="40%">Username</a></th>
                                                <th class="text-center"  width="15%"><a href="?order=org&&sort=<?php echo $sort; ?>" style="text-decoration: none;">Action</a></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="text-center"> 
                                            <?php
                                                while($row=mysqli_fetch_assoc($result)){
                                                    $id = $row['id'];
                                                    $uname = $row['username'];
                                                    $utype = $row['flname'];
                                                    
                                                    echo "<tr>
                                                        <td>".$id."</td>
                                                        <td>".$utype."</td>
                                                        <td>".$uname."</td>";

                                                    if (confirm_logged_in()) {
                                                        echo "<td class=\"\">
                                                            <a href=\"?edit=$id\" style=\"text-decoration: none; color: green;\" name=\"edit\">Edit |</a>
                                                            <a href=\"../admin/admin.php?idnum=$id\" style=\"text-decoration: none; color: brown;\" name=\"delete\"> Delete</a>
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

  <?php 
    if(isset($_POST['login'])){
        $fname = mysqli_real_escape_string($connection, $_POST['fname']);
        $uname = mysqli_real_escape_string($connection, $_POST['username']);
        $pword = md5(mysqli_real_escape_string($connection, $_POST['password']));

        $query = "INSERT INTO admin (username, pword, flname) values ('{$uname}', '{$pword}', '{$fname}')";
            $result = mysqli_query($connection, $query);
            if($result) {
                
                echo("<meta http-equiv='refresh' content='1'>");
                    
            }else{
                die("Database query failed. " . mysqli_error($connection));
            }
    }
  ?>

  <!-- Edit -->
<?php
        if(isset($_POST['edit']) ) { 
        $id = mysqli_real_escape_string($connection, $_GET['edit']);
        $uname = mysqli_real_escape_string($connection, $_POST['username']);
        $pword = mysqli_real_escape_string($connection, $_POST['password']);
        $fname = mysqli_real_escape_string($connection, $_POST['fname']);



        // $query = "UPDATE admin SET event='$event', stime='$stime', etime='$etime' WHERE id='$id'";
        // $result = mysqli_query($connection, $query);

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
                $query = "DELETE FROM admin WHERE id=$id";
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