<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/datatable.css">
    <link rel="stylesheet" href="css/all.css">
    <title>Student Data System</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">

</head>

<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <?php
            $uid = $_SESSION['uid'];
            $sql = "SELECT points FROM users WHERE id=$uid ";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                echo "Points Earned : ". $row['points'];
            }
            ?>
            
  
        </div>
        <?php $conn->close(); ?>
    </div>

</body>

</html>