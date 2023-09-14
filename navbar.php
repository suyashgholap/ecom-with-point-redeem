<?php
function active($currect_page)
{
  $url_array =  explode('/', $_SERVER['REQUEST_URI']);
  $url = end($url_array);
  if ($currect_page == $url) {
    echo 'active'; //class name in css 
  }
}
$arr = explode(' ', trim($_SESSION['name']));
$arr = $arr[0];
?>
<link rel="stylesheet" href="css/navbar.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  img {
    float: left;
    width: 40px;
  }
</style>
<div class="navbar">
  <div class="row">
    <div class="column">
      <img src="./assets/education.png" alt="">
      <a class="<?php active('index.php'); ?>" href="./index.php"><i class="fa fa-fw fa-home"></i> Home</a>
      <a class="<?php active('password-change.php'); ?>" href="./password-change.php"><i class="fa fa-fw fa-edit"></i> Change Password</a>
      <?php if ($_SESSION['admin'] == 1) : ?>
        <a class="<?php active('admin-control.php'); ?>" href="./admin-control.php"><i class="fa fa-id-badge"></i> Admin Control</a>
      <?php endif; ?>
    </div>
    <div class="column1">
      <a class="<?php active('logout.php'); ?>" href="./logout.php"><i class="fa fa-fw fa-sign-out"></i> Logout</a>
      <a href="#"><i class="fa fa-fw fa-user"></i><?php echo "  Hello " . $arr; ?></a>
    </div>
  </div>
</div>