<?php
session_start();
if(isset($_SESSION['user']))
{

    include('connection.php');
    if(isset($_POST['delete']))
    {
        error_reporting(0);
        $key = $_POST['chdelete'];
        $sql1 = "DELETE FROM customer WHERE customer_id='$key';";
        if ($conn->query($sql1) === TRUE)
        {
            echo "Record deleted successfully";

        }
        else {
            echo "<script> alert('Error deleting record:');window.location='delete_customer.php';</script>";
        }
    }
}
else
{
    echo "<script> alert('Please Login 1st');window.location='index.php';</script>";

}
?>
<!doctype html>
<html>
<home>
    <link type="text/css" rel="stylesheet" href="css/make.css">
    <link type="text/css" rel="stylesheet" href="css/detail.css">


    <title>
        delete supplier
    </title>
</home>
<body bgcolor="#a9a9a9">
<button class="button button5"><a href="home1.php" class="right">Home</a></button>
<br><br>

<table border="5" align="center">
    <caption>AVAILABLE CUSTOMER DETAILS</caption>
    <tr>
        <th align="center">Customer ID</th>
        <th align="center">Customer Name</th>
        <th align="center">Customer Phone No.</th>
        <th align="center">Address</th>
        <th align="center">Select</th>
        <th align="center">Delete It</th>
    </tr>
    <?php
    $sql ="SELECT * FROM customer;";
    $result=$conn->query($sql);
    if($result->num_rows>0) {
        while ($row = $result->fetch_assoc()) {

            ?>
            <tr>
                <form action="delete_customer.php" method="post">
                    <td><?php echo $row["customer_id"];?></td>
                    <td><?php echo $row["customer_name"];?></td>
                    <td><?php echo $row["customer_phone"];?></td>
                    <td><?php echo $row["address"];?></td>
                    <td>
                        <input type="checkbox" name="chdelete" value="<?php echo $row["customer_id"];?>" required="1">
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