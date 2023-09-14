<?php
session_start();
if($_SESSION['admin'] == 1){
    $x = 1;
} else {
    $x = 0;
}
session_unset();
session_destroy();
if($x==1){
    header("Location: login-admin.php");
}else{
    header("Location: login.php");
}
exit;
?>