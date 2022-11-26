<?php
session_start();
include('config/connect.php');

$acc =  $_GET['acc'];
$follower = $_GET['follower'];

$query    = "INSERT INTO followers (account,follower_name)
VALUES ('$acc', '$follower')"; 
echo 
$result   = mysqli_query($conn, $query);

$url = "http://localhost/saveehub/friends.php";

header("Location: $url ");

?>