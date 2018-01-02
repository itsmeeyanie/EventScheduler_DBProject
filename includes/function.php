<?php  
    function redirect_to($new_location) {
        header("Location: ". $new_location);
        exit;
    }
    function confirm_logged_in() {
        if (isset($_SESSION['user'])) {
            return true;
        }else{
            return false;
        }
    }

    function filterTable($query){
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    }
?>