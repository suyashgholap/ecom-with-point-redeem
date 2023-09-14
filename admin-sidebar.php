<?php
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['uid'] != 1) {
    header("Location: ./index.php");
}
function activeadminside($currect_page)
{
    $url_array =  explode('/', $_SERVER['REQUEST_URI']);
    $url = end($url_array);
    if ($currect_page == $url) {
        echo 'active'; //class name in css 
    }
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="sidebar">
    <a href="./admin-control.php" class="<?php activeadminside('admin-control.php'); ?>"> Admin Home</a>
    <a href="./add-user.php" class="<?php activeadminside('add-user.php'); ?>">Add User</a>
    <a href="./change-user-password.php" class="<?php activeadminside('change-user-password.php'); ?>">Change User Password</a>
    <a href="./add-product.php" class="<?php activeadminside('add-product.php'); ?>">Add Product</a>
</div>