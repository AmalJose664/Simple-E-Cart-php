<?php
session_start();
//echo "page";
if (array_key_exists('user_name', $_SESSION) && !empty($_SESSION['user_name'])) {
    if($_SESSION['user_role']=="user"){
        //echo "Not admin";
        header("Location: ../utils/forbiden.php");
    }elseif($_SESSION['user_role'] == "admin"){
        //echo "is admin ";
    }
}else{
    header("Location: ../account/login.html?admin=yes");
}
?>