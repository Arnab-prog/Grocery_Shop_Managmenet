<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="600; url=logout.php">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/web.css">
    <link rel="stylesheet" href="css/web_body.css">
    <?php
    session_start();
    if(isset($_SESSION['user']))
    {

    }
    else{
        echo "<script> alert('Please Login 1st');window.location='index.php';</script>";
    }
    ?>
<title>A2Z Grocery</title>
</head>
<body background="image/shop9.jpg">
<header>
         <label class="web_name">A2Z Grocery</label>
         <ul>
            <li><a class="active">Home</a></li>
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

</body>
</html>
