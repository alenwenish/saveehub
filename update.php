<?php


session_start();
include('config/connect.php');

$id = $_GET['id'];
$status =  $_GET['pic'];

if( $status == 1){
$query    = " UPDATE image SET likes = likes+1 WHERE id = '$id'"; 
$result   = mysqli_query($conn, $query);
$url = "http://localhost/saveehub/home.php";
header("Location: $url ");


}else if($status == 0){
$query    = " UPDATE club_pics SET likes = likes+1 WHERE id = '$id'"; 
$result   = mysqli_query($conn, $query);
$url = "http://localhost/saveehub/events.php";
header("Location: $url ");

}




?>