<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']))
{
    include('connection.php');
}
else
{
    echo "<script> alert('login 1st'); window.location='index.php';</script>";
}
?>
<html>
<head>
    <link rel="stylesheet" href="css/make.css">
    <title>order print</title>
</head>
<body>
<table border="2">
    <tr>
        <td>Order id</td>
        <td>Customer id</td>
        <td>Order Date</td>
        <td>Product id</td>
        <td>Quantity</td>
    </tr>
    <?php
        $sql='SELECT * FROM orders;';
        $result=$conn->query($sql);
        if($result->num_rows>=0)
    {
    while ($row = $result->fetch_assoc())
    {
    ?>
    <tr>
        <td><?php echo $row['order_id'];?></td>
        <td><?php echo $row['customer_id'];?></td>
        <td><?php echo $row['order_date'];?></td>
        <td><?php echo $row['product_id'];?></td>
        <td><?php echo $row['quantity'];?></td>
    </tr>
            <?php
            }
    }
    ?>
</table>
</body>
</html>
