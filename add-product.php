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
    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $reward = $_POST['reward'];
    $sql =  "INSERT INTO products (name,price,points_reward) VALUES (?,?,?);";
    $stmtinsert = $conn->prepare($sql);
    $result = $stmtinsert->execute([$pname, $price, $reward]);



    if ($result) {
        // Directory to store product photos
        $target_dir = "files/product/";

        // Get the file name and other information of the uploaded product photo
        $name = $_FILES['product_photo']['name'];
        $size = $_FILES['product_photo']['size'];
        $type = $_FILES['product_photo']['type'];
        $temp = $_FILES['product_photo']['tmp_name'];
        // Generate a unique file name for the product photo (you may want to improve this logic)
        $photo_name = $pname . "_" . $name;

        // Construct the full path to store the product photo
        $target_file = $target_dir . $photo_name;
        // Move the uploaded product photo to the target directory
        if (move_uploaded_file($temp, $target_file)) {
            // SQL query to update the product's photo location in the database
            $sql = "UPDATE products SET photo = ? WHERE name = ?";
            $stmtupdate = $conn->prepare($sql);
            $stmtupdate->execute([$target_file, $pname]);

            $err = "Product Added Successfully";
        } else {
            // Handle file upload error
            $err = "Error uploading product photo.";
        }
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
            <h1>Product Add</h1>
            <div class="addform">
                <form action="./add-product.php" enctype="multipart/form-data" method="post" class="useradd">
                    <table>
                        <tbody>
                            <tr>
                                <td><label for="text">Enter Name of Product</label></td>
                                <td><input type="text" placeholder="Enter Product Name" name="pname" id="pname" required></td>
                            </tr>
                            <tr>
                                <td><label for="price">Enter Price</label></td>
                                <td><input type="text" placeholder="Enter Product Price" name="price" id="price" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Reward Point for Product</label></td>
                                <td><input type="text" placeholder="Enter Value" name="reward" id="reward" required></td>
                            </tr>
                            <tr>
                                <td><label for="psw-repeat">Product Photo</label></td>
                                <td><input type="file" name="product_photo" id="product_photo" required></td>
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