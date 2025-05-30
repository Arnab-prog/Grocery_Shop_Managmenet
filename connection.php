<?php

$servername="localhost";
$username="root";
$pass="";
$db="shop";

$conn=new mysqli($servername,$username,$pass,$db);

if($conn->connect_error)
{
    die ("Database is not connected".$conn->connect_error);
}

?>
