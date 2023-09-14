<?php
require "config.php";
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit;
}
if (isset($_POST['submit'])) {
    $uid = $_SESSION['uid'];
    $oldpasswd = $_POST['old-psw'];
    $newpasswd = $_POST['new-psw'];
    if($oldpasswd==$newpasswd){
        $err = "New Password and Old Password cannot be same";
    }
    else{
        $rpasswd = $_POST['psw-repeat'];
        $sql = "SELECT password FROM users WHERE id = '$uid';";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();  
            if (password_verify($oldpasswd, $row['password'])){
                if (strcmp($newpasswd, $rpasswd) == 0) {
                    $newpasswd = password_hash($newpasswd, PASSWORD_DEFAULT);
                    $sql =  "UPDATE users SET password = '$newpasswd' WHERE id = '$uid';";
                    $stmtinsert = $conn->prepare($sql);
                    $result = $stmtinsert->execute();
                    $err = "Password Updated Successfully !";
                }else{
                    $err = "Something went wrong";
                }
            }else{
                $err = "Invalid Credentials";    
            }
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Change Password</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <style>
        p{
            color: red;
            text-align: center;
            padding: 5px 0;
        }
    </style>
</head>

<body>
    <?php require_once('navbar.php'); ?>
    <div class="row1">
        <div class="columnz left">
            <?php require_once('sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <h1>Password Change Form</h1>
            <div class="addform">
                <form action="./password-change.php" method="post" class="useradd">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="old-psw">Old Password</label></td>
                                <td><input type="password" placeholder="Enter Old Password" name="old-psw" id="old-psw" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw">New Password</label></td>
                                <td><input type="password" placeholder="Enter New Password" name="new-psw" id="new-psw" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Repeat New Password</label></td>
                                <td><input type="password" placeholder="Repeat New Password" name="psw-repeat" id="psw-repeat" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <p><?php echo $err; ?></p>
                    <button type="submit" name="submit" class="addbtn">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>