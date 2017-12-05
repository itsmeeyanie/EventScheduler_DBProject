<?php
// Set your timezone!!
date_default_timezone_set('Asia/Manila');
 
// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}
 
// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $timestamp = time();
}
 
// Today
$today = date('Y-m-j', time());
 
// For H3 title
$html_title = date('Y / F', $timestamp);
 
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
     
    if ($today == $date) {
        $week .= '<td class="today">'.$day;
    } else {
        $week .= '<td>'.$day;
    }
    $week .= '</td>';
     
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
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>Event Scheduler</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/bootstrap/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
     
</head>
<body>
    <!-- CALENDAR -->
    <div class="container">
        <div class="panel">
            <div class="panel-heading text-white p-3" style="background-color: #17a2b8">
       
                <h3 class="text-center">
                    <div class="col-1" style="float: left;">
                        <a class="text-white" style="text-decoration: none;"s href="?ym=<?php echo $prev; ?>">&lt;</a>
                    </div>
                        <?php echo $html_title; ?> 
                    <div class="col-1" style="float: right;">
                        <a class="text-white" style="text-decoration: none;" href="?ym=<?php echo $next; ?>">&gt;</a>
                    </div>
                    
                </h3>
            </div>
            
            <table class="table table-bordered calendar">
                <tr>
                    <thead>
                        <th>SUN</th>
                        <th>MON</th>
                        <th>TUE</th>
                        <th>WED</th>
                        <th>THU</th>
                        <th>FRI</th>
                        <th>SAT</th>
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
</body>
</html>