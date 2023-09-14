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
    $newpasswd = $_POST['new-psw'];
    $rpasswd = $_POST['psw-repeat'];
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    if (strcmp($newpasswd, $rpasswd) == 0) {
        $passwd = password_hash($newpasswd, PASSWORD_DEFAULT);
        $sql =  "UPDATE users SET password = '$passwd' WHERE id = '$userid';";
        $stmtinsert = $conn->prepare($sql);
        $result = $stmtinsert->execute();
        $err = "User Password Updated !";
    }
}
?>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/form.css">
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
            <?php require_once('admin-sidebar.php'); ?>
        </div>
        <div class="columnz right">
            <h1>Password Change Form</h1>
            <div class="addform">
                <form action="./change-user-password.php" method="post" class="useradd">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="psw-repeat">Select User</label></td>
                                <td>
                                    <select class="select" name="userid" id="preve">
                                        <?php
                                            $sql = "SELECT id,username FROM users;";
                                            $result = $conn->query($sql);
                                        ?>                                        
                                        <?php if ($result->num_rows > 0) : ?>
                                            <?php while ($row = $result->fetch_assoc()) : ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                                            <?php endwhile; ?>                                            
                                        <?php endif; ?>
                                    </select>
                                </td>
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