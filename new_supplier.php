<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/new_supplier.css">
    <link rel="stylesheet" type="text/css" href="css/web.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/table_page.css">
    <?php
    if(isset($_SESSION['user']))
    {
    include('connection.php');
    error_reporting(0);
    $id=$_POST["s_id"];
    $name=$_POST["sup_name"];
    $ph=$_POST["s_ph"];

    if($_POST['submit'])
    {
        $sql = "INSERT INTO suppliers (supplier_id,supplier_name,supplier_phone) VALUES('$id','$name','$ph');";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "<script> alert('No Record inserted.Error Occur');window.location='new_supplier.php';</script>";
        }

    }
    }
    else
    {
        echo "<script> alert('Please Login 1st');window.location='Login.html';</script>";

    }
    ?>

    <title>Entry New Supplier</title>
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
        <h1 class="form__title">New Supplier</h1>
        <form action="new_supplier.php" method="post" class="form_pos">
            <div class="form">
                <div class="form_div">
                    <label>Supplier Id</label>
                    <input type="text" name="s_id">
                </div>
                <div class="form_div">
                    <label>Supplier Name</label>
                    <input type="text" name="sup_name">
                </div>
                <div class="form_div">
                <label>Supplier Phone</label>
                    <input type="number" name="s_ph">
                </div>
                <div></div>
                <input type="submit" name="submit" class ="form__button">
            </div>
        </form>
    </div>


<!-- Available Suppliers Details-->
<div class = "table_pos">
    <caption>AVAILABLE SUPPLIERS DETAILS</caption>
    <table class="content-table">
    <thead>
        <tr>
            <th align="center">Suppliers ID</th>
            <th align="center">Suppliers Name</th>
            <th align="center">Suppliers Phone No.</th>
        </tr>
        </thead>
        <?php
        $sql ="SELECT * FROM suppliers;";
        $result=$conn->query($sql);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo "<tbody><tr><td>".$row["supplier_id"]."</td><td>".$row["supplier_name"]."</td><td>".$row["supplier_phone"]."</td></tr></tbody>";

            }
            echo "</table";
        }
        else
        {
            echo "0 Customer Available";
        }
        ?>
    </table>
    </div>
    <div class="footer">
        footer
    </div>
    </div>
<button class="button button5"><a href="delete_sup.php" class="right">Delete</a></button>
</body>
</html>