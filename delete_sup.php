<?php
session_start();
if(isset($_SESSION['user']))
{

    include('connection.php');
    if(isset($_POST['delete']))
{
    error_reporting(0);
    $key = $_POST['chdelete'];
    $sql = "DELETE FROM suppliers WHERE supplier_id='$key';";
    if ($conn->query($sql) === TRUE)
    {
        echo "Record deleted successfully";

    }
    else {
        echo "<script> alert('Error deleting record:');window.location='delete_sup.php';</script>";
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
    <caption>AVAILABLE SUPPLIERS DETAILS</caption>
    <tr>
        <th align="center">Suppliers ID</th>
        <th align="center">Suppliers Name</th>
        <th align="center">Suppliers Phone No.</th>
        <th align="center">Select</th>
        <th align="center">Delete It</th>
    </tr>
    <?php
    $sql ="SELECT * FROM suppliers;";
    $result=$conn->query($sql);
    if($result->num_rows>0) {
        while ($row = $result->fetch_assoc()) {

            ?>
            <tr>
                <form action="delete_sup.php" method="post">
                <td><?php echo $row["supplier_id"]?></td>
                <td><?php echo $row["supplier_name"]?></td>
                <td><?php echo $row["supplier_phone"]?></td>
                <td>
                    <input type="checkbox" name="chdelete" value="<?php echo $row["supplier_id"];?>" required="1">
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