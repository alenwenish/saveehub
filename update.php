<?php


session_start();
include('config/connect.php');

$id = $_GET['id'];
$status =  $_SESSION['status'];

if( $status  % 2 == 1){
$query    = " UPDATE image SET likes = likes+1 WHERE id = '$id'"; 
$result   = mysqli_query($conn, $query);
$_SESSION['status'] += 1;


}else{
$query    = " UPDATE image SET likes = likes-1 WHERE id = '$id'"; 
$result   = mysqli_query($conn, $query);
$_SESSION['status'] += 1;

}

$url = "http://localhost/saveehub/home.php";

header("Location: $url ");


?>