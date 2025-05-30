<?php
SESSION_START();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css\make.css">
    <link rel="stylesheet" type="text/css" href="css/detail.css">

    <?php
    if(isset($_SESSION['user']))
    {
    include('connection.php');
    error_reporting(0);
    $o_id=$_POST["o_id"];
    $c_id=$_POST["cust_id"];
    $date=$_POST["date"];
    $p_id=$_POST["p_id"];
    $p_quan=$_POST["quan"];

    if($_POST['submit'])
    {
        $sql2 = "SELECT * FROM customer WHERE customer_id='$c_id' limit 1;";
        $result2=$conn->query($sql2);
        $v2=$result2->fetch_assoc();

        $sql1 = "SELECT * FROM products WHERE product_id='$p_id' limit 1;";
        $result=$conn->query($sql1);
        $v=$result->fetch_assoc();
        $v1= ($v["stock_quantity"]-$p_quan);

        if($v["product_id"]==$p_id && $v2["customer_id"]==$c_id && $p_quan>0 && $v1>=0)
        {
            $sql = "INSERT INTO orders (order_id,customer_id,order_date,product_id,quantity) VALUES('$o_id','$c_id','$date','$p_id','$p_quan');";
        
            if ($conn->query($sql) === TRUE) 
            {
                $sql2 = "UPDATE products SET stock_quantity='$v1' WHERE product_id='$p_id';";
                $r=$conn->query($sql2);

                echo "New record created successfully ";

            } 
            elseif($conn->query($sql) === false)
            {
                echo "No record created successfully";
            }
        }

        else 
        {
            echo "<script> alert('No Record inserted.Error Occur');window.location='mak_order.php';</script>";
        }

    }
    }
    else
    {
        echo "<script> alert('Please Login 1st');window.location='index.php';</script>";

    }
    ?>

    <title>Make New Order</title>
</head>
<body bgcolor="#98fb98">
    <?php

            
        ?>
<button class="button button5"><a href="home1.php" class="right">Home</a></button>

<br><br><h3><u>Enter New Order Details:</u></h3>
<form action="mak_order.php" method="post">
    Order Id <input type="text" name="o_id" required="1">
    <p>Customer Id <input type="text" name="cust_id" required="1"></p>
    <p>Order Date <input type="date" name="date" required="1"></p>
    <p>Product Id <input type="text" name="p_id" required="1"></p>
    <p>Quantity <input type="number" name="quan" required="1"></p>
    <input type="submit" name="submit"><br>
</form>

<!-- Order Details-->
<table border="5" align="center">
    <caption>AVAILABLE ORDER DETAILS</caption>
    <tr>
        <th align="center">Order ID</th>
        <th align="center">Order Date</th>
        <th align="center">Product Quantity(Kg./Pcs.)</th>
        <th align="center">Product Name</th>
        <th align="center">Product Price(Rs.)</th>
        <th align="center">Customer Name</th>
        <th align="center">Customer Phone No.</th>
        <?php
        $sql ="SELECT orders.order_id,orders.order_date,orders.quantity,products.product_name,products.product_price,customer.customer_name,customer.customer_phone FROM ((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN products ON orders.product_id = products.product_id);";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr><td>".$row["order_id"]."</td><td>".$row["order_date"]."</td><td>".$row["quantity"]."</td><td>".$row["product_name"]."</td><td>".$row["product_price"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_phone"]."</td></tr>";
            }
            echo "</table";
        }
        else
        {
            echo "No Order to Display";
        }
        ?>
</table>

<!--Available Product-->

<table border="5" align="center">
    <caption>AVAILABLE PRODUCT DETAILS</caption>
    <tr>
        <th align="center">Product ID</th>
        <th align="center">Suppliers ID</th>
        <th align="center">Product Name</th>
        <th align="center">Product Price(Rs.)</th>
        <th align="center">Stock Quantity(Kg./Pc.)</th>
        
        <?php
        $sql ="SELECT * FROM products;";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr><td>".$row["product_id"]."</td><td>".$row["supplier_id"]."</td><td>".$row["product_name"]."</td><td>".$row["product_price"]."</td><td>".$row['stock_quantity']."</td></tr>";
            }
            echo "</table";
        }
        else
        {
            echo "0 Products Available";
        }
        ?>
</table>


<!-- Customer Details-->
<table border="5" align="center">
    <caption>AVAILABLE CUSTOMER DETAILS</caption>
    <tr>
        <th align="center">Customer ID</th>
        <th align="center">Customer Name</th>
        <th align="center">Customer Phone No.</th>
        <th align="center">Address</th>
        <?php
        $sql ="SELECT * FROM customer;";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr><td>".$row["customer_id"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_phone"]."</td><td>".$row["address"]."</td></tr>";
            }
            echo "</table";
        }
        else
        {
            echo "0 Customer Available";
        }
        ?>
</table>
</body>
</html>
