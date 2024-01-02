<?php
//dataconnection.php
$connect=mysqli_connect("localhost","root","","fyp2");
//1.server name 2.username 3.password 4.database name

if($connect)
{
    error_log("Connect successfully");
}
else
{
    die("Could not connect: " . mysqli_error($connect));
}

?>