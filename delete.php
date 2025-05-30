<?php
session_start();
if(isset($_SESSION['user']))
{
    include('connection.php');
}
else
{
    echo "<script> alert('Please Login 1st');window.location='index.php';</script>";

}
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css\make.css">
    <link rel="stylesheet" type="text/css" href="css/detail.css">

    <title>Order Details</title>
</head>
<body bgcolor="#a9a9a9">
<button class="button button5"><a href="home1.php" class="right">Home</a></button>

<br><br>
    <table border="5" align="center">
    <caption>ORDER DETAILS</caption>
    <tr>
        <th align="center">Order ID</th>
        <th align="center">Order Date</th>
        <th align="center">Customer Id</th>
        <th align="center">Order Details</th>
        <th align="center">Product ID</th>
        <th align="center">Quantity</th>
        <th align="center">Select</th>
        <th align="center">Delete It</th>
    </tr>
    <?php
        $sql ="SELECT * FROM orders INNER JOIN products ON orders.product_id = products.product_id;";
        $result=$conn->query($sql);
    if($result->num_rows>0)
    {
        while ($row = $result->fetch_assoc())
        {
            ?>
            <tr>
                <form action="delete1.php" method="post">
                    <td><?php echo $row["order_id"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                    <td><?php echo $row["customer_id"]; ?></td>
                    <td><?php echo $row["product_name"]; ?></td>
                    <td><?php echo $row["product_id"]; ?></td>
                    <td><?php echo $row["quantity"]; ?></td>
                    <td>
                        <input type="checkbox" name="chdelete" value="<?php echo $row["order_id"];?>" required="1">
                    </td>
                    <td>
                        <input type="submit" name="delete">
                    </td>
                </form>
            </tr>
        <?php
        }
    }
    else
    {
        echo "<script> alert('No Record to Display');window.location='home1.php';</script>";
    }
    ?>
    </table>
</body>
</html>