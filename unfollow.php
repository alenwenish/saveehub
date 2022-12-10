<?php


session_start();
include('config/connect.php');

$follower_name = $_GET['follower_name'];
$account =  $_GET['account'];


$query    = "DELETE FROM followers WHERE follower_name = '$follower_name' and account = '$account'";

$result   = mysqli_query($conn, $query);
header("Location: viewprofile.php ");


?>