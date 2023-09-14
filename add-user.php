<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if ($_SESSION['admin'] != 1) {
    header("Location: ./index.php");
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $passwd = $_POST['psw'];
    $rpasswd = $_POST['psw-repeat'];
    $sql = "SELECT username FROM users WHERE username = '$username';";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        if (strcmp($passwd, $rpasswd) == 0) {
            $password = password_hash($passwd, PASSWORD_DEFAULT);
            $sql =  "INSERT INTO users (username, password) VALUES (?,?);";
            $stmtinsert = $conn->prepare($sql);
            $result = $stmtinsert->execute([$username, $password]);
            $err = "User Added Successfully";
        }else{
            $err = "Password does not match";
        }
    }else{
        $err = "User Already Exist";
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/all.css">
    <title>Add User</title> 
    <style>
        p{
            color: red;
            text-align: center;
            padding: 5px 0;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
</head>
<body>
    <?php require_once('navbar.php');?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('admin-sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <h1>User Registration Form</h1>
            <div class="addform">
                <form action="./add-user.php" method="post" class="useradd">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="email">Enter Username</label></td>
                                <td><input type="text" placeholder="Enter Username" name="username" id="username" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw">Password</label></td>
                                <td><input type="password" placeholder="Enter Password" name="psw" id="psw" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Repeat Password</label></td>
                                <td><input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><?php echo $err; ?></p>
                    <button type="submit" name="submit" class="addbtn">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>