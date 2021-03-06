
<?php
include("../includes/session.php");
require_once("../includes/db_connection.php");
include("../includes/function.php");

// Set your timezone!!
date_default_timezone_set('Asia/Manila');
 
// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

if(isset($_POST['filter'])){
    $ym = $_POST['det'];
}else{
    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        // This month
        $ym = date('Y-m');
    }
}
 
// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $timestamp = time();
}
 
// Today
$today = date('Y-m-j', time());
 
// For H3 title
$html_title = date('F Y', $timestamp);

$dt = date('M j, Y', $timestamp);
 
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
 
// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
 
 
// Create Calendar!!
$weeks = array();
$week = '';
 
// Add empty cell
$week .= str_repeat('<td></td>', $str);

 
for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym.'-'.$day;

    //$search = array('$day' => $ym );

    // query SELECT rdate from tbl_event where rdate='$date' "call selectByDate('$date')"
    $query = "SELECT rdate from tbl_event where rdate='$date'";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die("Database query failed.");
    }else{
      $rowcount=mysqli_num_rows($result);
    }
     
    if ($today == $date) {
        $week .= '<td class="today"><a href="../public/event.php?date='.$date.'" style="text-decoration: none; height: 75px; color: #2a7c43;">'.$day;

    }elseif ($rowcount > 0){
        $week .= '<td><a href="../public/event.php?date='.$date.'" style="text-decoration: none; height: 75px; color: #2a7c43;">'.$day.'<span><br><br><i class="fa fa-check-square-o" style="color: #0ad397; font-size: 30px;"></span>';
    } else {
        $week .= '<td><a href="../public/event.php?date='.$date.'" style="text-decoration: none; height: 75px; color: #2a7c43;">'.$day;
    }
    $week .= '</a></td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {
         
        if($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
         
        $weeks[] = '<tr>'.$week.'</tr>';
         
        // Prepare for new week
        $week = '';
         
    }
 
}
      


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Event Calendar</title>
<!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../style.css">

    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
    
    <link rel="stylesheet" type="text/css" href="fonts/TheLightFont.ttf">
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
            <button class="btn btn-default"><a class="offset-1 text-dark" href="../public/calendar.php" style="text-decoration: none; float: left;"><i class="fa fa-calendar"> Calendar View</i></a></button>
            <button class="btn btn-default"><a class="text-dark" href="../includes/eventlist.php" style="text-decoration: none; float: left; margin-left: 20px;"><i class="fa fa-table"> List View</i></a></button>
        </div>

        <div class="col-md-3 p-2" style="float: right; margin-top: 80px;">
            <form action="../admin/index.php" method="post">
                <input name="det" type="month" value="<?php echo $ym; ?>">
                <button class="btn btn-default" name="filter">Filter</button>
            </form>
        </div>
    </div>

    <!-- CALENDAR -->
    <div class="container">
        <div class="panel pt-3">
            <div class="panel-heading text-white p-4" style="background-color: #353c47;">
                <h3 class="text-center">
                    <div class="col-1" style="float: left;">
                        <a class="text-white" style="text-decoration: none;" href="?ym=<?php echo $prev; ?>">&#10094;</a>
                    </div>
                        <?php echo $html_title; ?> 
                    <div class="col-1" style="float: right;">
                        <a class="text-white" style="text-decoration: none;" href="?ym=<?php echo $next; ?>">&#10095;</a>
                    </div>
                    
                </h3>
            </div>
            
            <table class="table table-bordered">
                <tr>
                    <thead style="background-color: #e8ebef;">
                        <th class="text-center">SUN</th>
                        <th class="text-center">MON</th>
                        <th class="text-center">TUE</th>
                        <th class="text-center">WED</th>
                        <th class="text-center">THU</th>
                        <th class="text-center">FRI</th>
                        <th class="text-center">SAT</th>
                    </thead>
                </tr>
                <tr>
                    <tbody>
                    <?php
                        foreach ($weeks as $week) {
                            echo $week;
                        }   
                    ?>
                    </tbody>
                </tr>
            </table>
        </div>
    </div>
    </div> 

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
