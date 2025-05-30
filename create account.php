<?php
    include('connection.php');
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    $pass1=$_POST['pass1'];
    $dob=$_POST['dob'];
    if($_POST['submit'])
    {
        if($pass===$pass1)
        {
            $sql = "INSERT INTO login(USER,Pass,date_of_birth) VALUES('$user','$pass','$dob');";
            $result = $conn->query($sql);
            if ($result === TRUE) {
                echo "<script> alert('Account Created Succesfully');window.location='index.php' </script>";
            } else {
                echo "<script> alert('Username already exist');window.location='createaccount.html' </script>";
            }
        }
        else
        {
            echo "<script> alert('Both Password Not Matched');window.location='createaccount.html' </script>";
        }
    }
?>
