<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/enter_product.css">
    <link rel="stylesheet" type="text/css" href="css/web.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/table_page.css">
    <?php
    if(isset($_SESSION['user']))
    {
    include('connection.php');
    error_reporting(0);
    $id=$_POST["p_id"];
    $name=$_POST["p_name"];
    $price=$_POST["p_price"];
    $sid=$_POST["sup_id"];
    $quan=$_POST['quan'];

    if($_POST['submit'])
    {
        $sql = "SELECT * FROM suppliers WHERE supplier_id='$sid' limit 1;";
        $result=$conn->query($sql);
        if($result->num_rows === 1){
            
            $sql = "INSERT INTO products (product_id,supplier_id,product_name,product_price,stock_quantity) VALUES('$id','$sid','$name','$price','$quan');";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "<script> alert('No Record inserted.Error Occur');window.location='enter_product.php';</script>";        
            }
        }
        else {
            echo "<script> alert('No Record inserted.Error Occur');window.location='enter_product.php';</script>";        
        }
    }
    }
    else
    {
        echo "<script> alert('Please Login 1st');window.location='index.php';</script>";

    }
    ?>

    <title>Entry New Product</title>
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

    <?php
        $sql = "SELECT * FROM products ORDER BY product_id DESC limit 1;";
        $result=$conn->query($sql);
        if($result->num_rows === 1)
        {
            $row=$result->fetch_assoc();
            $id=$row["product_id"];
            echo $id;
        }
    ?>

    <div class="position">
        <h1 class="form__title">New Product</h1>
        <form action="enter_product.php" method="post" class="form_pos">
            <div class="form">
                <div class="form_div">
                    <label>Product Id</label>
                    <input type="text" name="p_id" required="1">
                </div>
                <div class="form_div">
                    <label>Supplier Id</label>                    
                    <input type="text" name="sup_id" required="1">
                </div>
                <div class="form_div">
                    <label>Product Name</label>
                    <input type="text" name="p_name" required="1">
                </div>
                <div class="form_div">
                    <label>Product Price</label>
                    <input type="number" name="p_price" required="1">
                </div>
                <div class="form_div">
                    <label>Stock Quantity</label>
                    <input type="number" name="quan" required="1">
                </div>
                <div></div>
                <input type="submit" name="submit" class ="form__button">
            </div>
        </form>

<!--Available Product-->
        <div class = "table_pos">
            <caption>AVAILABLE PRODUCT DETAILS</caption>
            <table class="content-table">
                <thead>
                <tr>
                    <th align="center">Product ID</th>
                    <th align="center">Suppliers ID</th>
                    <th align="center">Product Name</th>
                    <th align="center">Product Price(Rs.)</th>
                    <th align="center">Stock Quantity(Kg./Pcs.)</th>
                </thead>
                <?php
                $sql ="SELECT * FROM products ORDER BY product_id;";
                $result=$conn->query($sql);
                if($result->num_rows>0)
                {
                    while($row=$result->fetch_assoc())
                    {
                        echo "<tbody><tr><td>".$row["product_id"]."</td><td>".$row["supplier_id"]."</td><td>".$row["product_name"]."</td><td>".$row["product_price"]."</td><td>".$row['stock_quantity']."</td></tr></tbody>";
                        }
                        echo "</table";
                    }
                else
                {
                    echo "0 Products Available";
                }
                ?>
            </table>
        </div> 
    </div>
</body>
</html>