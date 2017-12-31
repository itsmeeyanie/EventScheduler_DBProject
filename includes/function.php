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
?>