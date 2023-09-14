<?php
function activeside($currect_page)
{
  $url_array =  explode('/', $_SERVER['REQUEST_URI']);
  $url = end($url_array);
  if ($currect_page == $url) {
    echo 'active'; //class name in css 
  }
}
?>
<div class="sidebar">
  <a class="<?php activeside('index.php'); ?>" href="./index.php"> Products</a>
  <a class="<?php activeside('points_earned.php'); ?>" href="./points_earned.php"> Points Earned</a>
</div>