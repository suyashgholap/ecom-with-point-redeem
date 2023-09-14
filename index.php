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
                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);
                ?>
            <table id="studentdata" class="show">
                <thead>
                    <?php $idx = 1; ?>
                    <tr>
                        <th>Sr.No</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Points</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['points_reward']; ?></td>
                                <td><img src="<?php echo $row['photo']; ?>" style="width:150px;" alt="" srcset=""> </td>
                                <td>
                                    <a class="viewst" href="./view-product.php?id=<?php echo $row['id']; ?>"><i class="fa fa-fw fa-lg fa-eye"></i>View</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php $conn->close(); ?>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/datatables.js"></script>
    <script>
    $(document).ready(function() {
        $('#studentdata').DataTable({
            pagingType: 'full_numbers',
        });
    });
</script>
</body>

</html>