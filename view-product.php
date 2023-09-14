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
        $err = "Transaction Successful you can check points earned in Profile";
        
    }
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/datatable.css">
    <title>View Student Information</title>
    <link rel="icon" type="image/x-icon" href="./assets/education.png">
    <style>
        .msg{
            text-align: center;
            margin-top: 50px;
            color: red;
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
            <?php
                $grn =  $_GET['id'];
                $sql = "SELECT * FROM products WHERE id = '$grn';";
                $result = $conn->query($sql);
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                }
            ?>
            <div class="testedit"><h1>Product Information</h1></div>
            <?php if( $grn!=""): ?>
            <table class="show1">
                <tbody>
                    <tr>
                        <td>Product ID</td>
                        <td><?php echo $row['id']; ?></td>
                        <td rowspan="7" colspan="2"><div class="imgs"><img src="<?php echo $row['photo']; ?>"></div></td>
                    </tr>
                    <tr>
                        <td>Product Name</td>
                        <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                        <td>Price </td>
                        <td><?php echo $row['price']; ?></td>                     
                    </tr>
                    <tr>
                        <td>Points can Earned</td>
                        <td><?php echo $row['points_reward']; ?></td>                      
                    </tr>
                    <tr>
                        <td rowspan="3" colspan="2">
                            <form action="view-product.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="point" value="<?php echo $row['points_reward']; ?>">
                                <input type="submit" name="submit" class="btn" value="Buy Now">
                            </form>
                        </td>                       
                    </tr>                   
                </tbody>
            </table>
            <?php endif ?>
            <div class="msg">
                <h2><?php echo $err; ?></h2>
            </div>
        </div>
    </div>
</body>

</html>