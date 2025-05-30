<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/create_customer.css">
    <link rel="stylesheet" type="text/css" href="css/web.css">
    <link rel="stylesheet" type="text/css" href="css/table.css">
    <link rel="stylesheet" type="text/css" href="css/table_page.css">
    <title>Entry New Customer</title>
    <?php

    if(isset($_SESSION['user'])) {
        include('connection.php');
        error_reporting(0);
        $id = $_POST["cust_id"];
        $name = $_POST["cust_name"];
        $ph = $_POST["ph"];
        $add = $_POST["add"];
        $check=0;

        if ($_POST['submit']) {
            $sql1 = "SELECT * FROM customer WHERE customer_phone='$ph' limit 1";
            $result=$conn->query($sql1);
            $res=$result->fetch_assoc();
            $number= $res["customer_phone"];
            if($number!=$ph)
            {
                $sql = "INSERT INTO customer(customer_id,customer_name,customer_phone,address) VALUES('$id','$name','$ph','$add')";
                $check=$conn->query($sql);
                if ($check === FALSE) {
                    echo "<script> alert('No Record inserted.Error Occur');window.location='create_customer.php';</script>";
                }
            }
            else {
                $check=1;
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
        <h1 class="form__title">New Customer</h1>
        <form action="create_customer.php" method="post" class="form_pos">
            <div class="form">
                <div class="form_div">
                    <label>Customer Id</label>
                    <input type="text" name="cust_id" required="1">
                </div>
                <div class="form_div">
                    <label>Customer Name</label>
                    <input type="text" name="cust_name" required="1">
                </div>
                <div class="form_div">
                    <label>Customer Phone</label>
                    <input type="number" name="ph" required="1">
                </div>
                <div class="form_div">
                <label>Address</label>
                    <input type="text" name="add" required="1">
                    
                </div>
                <input type="submit" name="submit" class ="form__button">
            </div>
        </form>
        <div class = "table_pos">
                <?php
                $sql ="SELECT * FROM customer;";
                $result=$conn->query($sql);
                if($result->num_rows>0)
                {
                    if($check===TRUE)
                    {
                        echo "New record created successfully";
                        echo"<table class='content-table'>
                        <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Customer Phone No.</th>
                            <th>Address</th>
                        </tr>
                        </thead>";
                        $sql ="SELECT * FROM customer WHERE customer_phone ='$ph';";
                        $result=$conn->query($sql);
                        while($row=$result->fetch_assoc())
                        {
                            echo "<tbody><tr><td>".$row["customer_id"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_phone"]."</td><td>".$row["address"]."</td></tr></tbody>";
                        }
                        echo "</table>";
                    }
                    elseif ($check==1) {
                        echo "The user already exist";
                        echo"<table class='content-table'>
                        <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Customer Phone No.</th>
                            <th>Address</th>
                        </tr>
                        </thead>";
                        $sql ="SELECT * FROM customer WHERE customer_phone ='$ph';";
                        $result=$conn->query($sql);
                        while($row=$result->fetch_assoc())
                        {
                            echo "<tbody><tr><td>".$row["customer_id"]."</td><td>".$row["customer_name"]."</td><td>".$row["customer_phone"]."</td><td>".$row["address"]."</td></tr></tbody>";
                        }
                        echo "</table>";
                    }
                }
                else
                {
                    echo "0 Customer Available";
                }
                ?>
            </table>
        </div> 
    </div>
</body>
</html>
