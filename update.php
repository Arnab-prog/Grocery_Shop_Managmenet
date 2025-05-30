<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css\make.css">
    <link rel="stylesheet" type="text/css" href="css/detail.css">

    <?php
    session_start();
    if(isset($_SESSION['user']))
    {
        include('connection.php');
        error_reporting(0);
        $o_id = $_POST["o_id"];
        $c_id = $_POST["cust_id"];
        $p_id = $_POST["p_id"];
        $p_quan = $_POST["quan"];

        if ($_POST['submit']) {
            $sql = "SELECT * FROM orders WHERE order_id='$o_id' limit 1;";
            $result = $conn->query($sql);
            $v=$result->fetch_assoc();
            
            $sql1 = "SELECT * FROM products WHERE product_id='$p_id' limit 1;";
            $result1=$conn->query($sql1);
            $v1=$result1->fetch_assoc();
            
            $sql2 = "SELECT * FROM customer WHERE customer_id='$c_id' limit 1;";
            $result2=$conn->query($sql2);
            $v2=$result2->fetch_assoc();
            
            $v3= ($v1["stock_quantity"]+($v["quantity"]-$p_quan));
            if( $result1->num_rows === 1 && $v1["stock_quantity"]==0)
            {
                echo "<script> alert('the product is not avalable');window.location='update.php';</script>";
            }
            if ($result->num_rows === 1 && $v3>=0 && $p_quan>0 && $v1["product_id"]==$p_id && $v2["customer_id"]==$c_id) 
            {
                $sql1 = "UPDATE orders SET order_id='$o_id',customer_id='$c_id',product_id='$p_id',quantity='$p_quan' WHERE order_id='$o_id';";
                if ($conn->query($sql1) === TRUE) 
                {
                    $sql2 = "UPDATE products SET stock_quantity='$v3' WHERE product_id='$p_id';";
                    $r=$conn->query($sql2);
                    echo "<script> alert('Record updated successfully');window.location='update.php';</script>";
                }
            } 
            else 
            {
                echo "<script> alert('No record updated');window.location='update.php';</script>";
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
<button class="button button5"><a href="home1.php" class="right">Home</a></button>

<br><br>
<form action="update.php" method="post">
    Order Id <input type="text" name="o_id" required="1">
    <p>Customer Id <input type="text" name="cust_id" required="1"></p>
    <p>Product Id <input type="text" name="p_id" required="1"></p>
    <p>Quantity <input type="number" name="quan" required="1"></p>
    <input type="submit" name="submit"><br>
</form>
    <div class="danger">
        <p><strong>NOTE:</strong>Please Fill Same Data Which Not Changed</p>
    </div>
<!-- Order Details-->
<table border="5" align="center">
    <caption>AVAILABLE ORDER DETAILS</caption>
    <tr>
        <th align="center">Order ID</th>
        <th align="center">Order Date</th>
        <th align="center">Product Quantity</th>
        <th align="center">Product Id</th>
        <th align="center">Product Name</th>
        <th align="center">Product Price</th>
        <th align="center">Customer Id</th>
        <th align="center">Customer Name</th>
        <th align="center">Customer Phone No.</th>
        <?php
        $sql ="SELECT orders.order_id,orders.order_date,orders.quantity,products.product_id,products.product_name,products.product_price,customer.customer_id,customer.customer_name,customer.customer_phone FROM ((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN products ON orders.product_id = products.product_id);";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tr><td>".$row["order_id"]."</td><td>".$row["order_date"]."</td><td>".$row["quantity"]."</td><td>".$row["product_id"]."</td><td>".$row["product_name"]."</td><td>".$row["product_price"]."</td><td>".$row["customer_id"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_phone"]."</td></tr>";
            }
            echo "</table";
        }
        else
        {
            echo "<script> alert('No Record to Display');window.location='home1.php';</script>";
        }

        ?>
</table>

<!-- Available Customer Details-->
<table border="5" align="center">
    <caption>AVAILABLE CUSTOMER DETAILS</caption>
    <tr>
        <th align="center">Customer ID</th>
        <th align="center">Customer Name</th>
        <th align="center">Customer Phone No.</th>
        <th align="center">Address</th>
        <?php
            $sql = "SELECT * FROM customer;";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["customer_id"] . "</td><td>" . $row["customer_name"] . "</td><td>" . $row["customer_phone"] . "</td><td>" . $row["address"] . "</td></tr>";
                }
                echo "</table";
            } else {
                echo "0 Customer Available";
            }

        ?>
</table>


</body>
</html>
