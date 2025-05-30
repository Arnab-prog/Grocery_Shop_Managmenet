<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" type="text/css" href="css/orders_details.css">
    <link rel="stylesheet" type="text/css" href="css/web.css"> 
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/table_page.css">
    <title>Order Details</title>
    <?php
    if(isset($_SESSION['user']))
    {
    include('connection.php');
    error_reporting(0);
    $option=$_POST["option"];
    $data=$_POST["input"];
    $result=0;
    $v=$v1=0;
    if($_POST['submit'])
        {  
            $v1=1;
            $sql ="SELECT orders.order_id,customer.customer_id,orders.order_date,orders.quantity,products.product_name,products.product_price,customer.customer_name,customer.customer_phone FROM ((orders INNER JOIN customer ON orders.customer_id = customer.customer_id) INNER JOIN products ON orders.product_id = products.product_id);";
            $result=$conn->query($sql);
            
            $sql1 = "SELECT * FROM orders WHERE order_id='$data';";
            $result1=$conn->query($sql1);
            
            $sql2 = "SELECT * FROM customer WHERE customer_id='$data';";
            $result2=$conn->query($sql2);

            $sql3 = "SELECT * FROM customer WHERE customer_phone='$data';";
            $result3=$conn->query($sql3);

            if($result1->num_rows>0 || $result2->num_rows>0 || $result3->num_rows>0){
                $v=1;
            }
        }
    }
    else
    {
        echo "<script> alert('Please Login 1st');window.location='index.php';</script>";

    }
    ?>

</head>
<body>
    <header>
        <label class="web_name">A2Z Grocery</label>
         <ul>
            <li><a href="home1.php" class="active">Home</a></li>
            <li>
               <a href="#">Entry
               <i class="fas fa-caret-down"></i>
               </a>
               <ul>
                  <li><a href="create_customer.php">New Customer</a></li>
                  <li><a href="new_supplier.php">New Suppplier</a></li>
                  <li><a href="enter_product.php">New Product</a></li>
               </ul>
            </li>
            <li>
               <a href="#">Order
               <i class="fas fa-caret-down"></i>
               </a>
               <ul>
                  <li><a href="mak_order.php">New Order</a></li>
                  <li><a href="orders_details.php">Check Orders</a></</li>
                  <li><a href="update.php">Update Orders</a></li>
                  <li><a href="delete.php">Delete Orders</a></li>
               </ul>
            </li>
            <li><a href="logout.php">Log Out</a></li>
         </ul>
    </header>
    <div class="position">
        <form action="orders_details.php" method="post" class="form_pos_od">
        <div></div>
        <div class="form_od">
            <select name="option" class="select">
                    <option value="default">-- Select --</option>
                    <option value="c_id">Customer ID</option>
                    <option value="o_id">Order ID</option>
                    <option value="number">Phone Number</option>
            </select>
            <input type="text" name="input" class="input" placeholder=" Input......" required="1">
            <input type="submit" name="submit" value="Search" class ="form_button">
        </div>
        </form>
        <div class = "table_pos">
            <table class="content-table">     
            <?php
            if($v1==1){
                if($v==1)
                {
                        ?>
                    <thead>
                    <tr>
                        <th align="center">Order ID</th>
                        <th align="center">Order Date</th>
                        <th align="center">Product Quantity</th>
                        <th align="center">Product Name</th>
                        <th align="center">Product Price</th>
                        <th align="center">Customer ID</th>
                        <th align="center">Customer Name</th>
                        <th align="center">Customer Phone No.</th>
                        <th align="center">Select</th>
                        <th align="center">Print</th>
                        </tr>
                    </thead>

                <tr>
                <?php
                if($option==c_id)
                {
                    if($result->num_rows>0)
                    {
                    while ($row = $result->fetch_assoc())
                    {
                        if($row["customer_phone"]==$data)
                        {
                        ?>
                        <form action="print.php" method="post">
                        <tbody><td><?php echo $row["order_id"]; ?></td>
                        <td><?php echo $row["order_date"]; ?></td>
                        <td><?php echo $row["quantity"]; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["product_price"]; ?></td>
                        <td><?php echo $row["customer_id"]; ?></td>
                        <td><?php echo $row["customer_name"]; ?></td>
                        <td><?php echo $row["customer_phone"]; ?></td>

                        <td>
                            <input type="checkbox" name="print" value="<?php echo $row["customer_id"];?>" required="1">
                        </td>
                        <td>
                            <input type="submit" name="seprint">
                        </td></tbody>
                        </form>
                </tr>  
                <?php
                        }
                    }
                    }
                    }$v=0;

                if($option==o_id)
                {
                    if($result->num_rows>0)
                    {
                    while ($row = $result->fetch_assoc())
                    {
                        if($row["order_id"]==$data)
                        {
                        ?>
                        <form action="print.php" method="post">
                        <tbody><td><?php echo $row["order_id"]; ?></td>
                        <td><?php echo $row["order_date"]; ?></td>
                        <td><?php echo $row["quantity"]; ?></td>
                        <td><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["product_price"]; ?></td>
                        <td><?php echo $row["customer_id"]; ?></td>
                        <td><?php echo $row["customer_name"]; ?></td>
                        <td><?php echo $row["customer_phone"]; ?></td>

                        <td>
                            <input type="checkbox" name="print" value="<?php echo $row["customer_id"];?>" required="1">
                        </td>
                        <td>
                            <input type="submit" name="seprint">
                        </td></tbody>
                        </form>
                </tr>  
                <?php
                        }
                    }
                    }
                    }$v=0;

                    if($option==number)
                    {
                        if($result->num_rows>0)
                        {
                        while ($row = $result->fetch_assoc())
                        {
                            if($row["customer_phone"]==$data)
                            {
                            ?>
                            <form action="print.php" method="post">
                            <tbody><td><?php echo $row["order_id"]; ?></td>
                            <td><?php echo $row["order_date"]; ?></td>
                            <td><?php echo $row["quantity"]; ?></td>
                            <td><?php echo $row["product_name"]; ?></td>
                            <td><?php echo $row["product_price"]; ?></td>
                            <td><?php echo $row["customer_id"]; ?></td>
                            <td><?php echo $row["customer_name"]; ?></td>
                            <td><?php echo $row["customer_phone"]; ?></td>
    
                            <td>
                                <input type="checkbox" name="print" value="<?php echo $row["customer_id"];?>" required="1">
                            </td>
                            <td>
                                <input type="submit" name="seprint">
                            </td></tbody>
                            </form>
                    </tr>  
                    <?php
                            }
                        }
                        }
                        }$v=0;
                }
                else
                {
                    echo "No Record to Display";
                }
            }
                ?>
        </table>
    </body>
</html>