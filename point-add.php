<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $pid = $_POST['product_id'];
    $point = $_POST['point'];
    $uid = $_SESSION['uid'];
    $sql = "SELECT * FROM users WHERE id = '$uid';";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $new = $row['points'] + $point;
        $sql =  "UPDATE users SET points = '$new' WHERE id = '$uid';";
        $stmtinsert = $conn->prepare($sql);
        $result = $stmtinsert->execute();
        $sql =  "INSERT INTO transactions (user_id,product_id,points_earned) VALUES (?,?,?);";
        $stmtinsert = $conn->prepare($sql);
        $result = $stmtinsert->execute([$uid, $pid, $point]);
        $err = "Transaction Successful";
    }
}
?>