<?php
    include('connection.php');
    error_reporting(0);
    $user1=$_POST["user"];
    $pass1=$_POST["date"];
    $pass2=$_POST["npass"];


    if($_POST['submit'])
    {
        $sql = "SELECT * FROM login WHERE User='$user1' and date_of_birth='$pass1' limit 1;";
        $result=$conn->query($sql);
        if ($result->num_rows===1)
        {
            $sql1 = "UPDATE login SET Pass='$pass2' WHERE User='$user1';";

            if ($conn->query($sql1) === TRUE) {
                echo "<script> alert('Password updated successfully');window.location='index.php';</script>";
            }
        }
        else
        {
            echo "<script> alert('Invalid UserName or Date Of Birth');window.location='reset.html';</script>";
        }
    }
?>