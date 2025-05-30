<?php
session_start();
if(isset($_SESSION['user']))
{
ob_start();
include('connection.php');
error_reporting(0);
        $key = $_POST['chdelete'];
        $sql = "DELETE FROM orders WHERE order_id='$key';";
        if ($conn->query($sql) === TRUE ) {
            echo "Record deleted successfully";
            header("location:delete.php");
            ob_end_flush();
        }
        else {
            echo "<script> alert('Error deleting record:');window.location='delete.php';</script>";
        }
}
else
{
    echo "<script> alert('Please Login 1st');window.location='index.php';</script>";

}
?>