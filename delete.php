<?php



session_start();
include('config/connect.php');

$id = $_GET['id'];
$category =  $_GET['category'];
$post = $_GET['post'];

if ($category == 0) {


    $query    = "DELETE FROM image WHERE id = '$id'";
    $result   = mysqli_query($conn, $query);

    $folder = './uploads/' . $post;
    $status = unlink($folder);
    if ($status) {
        header("Location: viewprofile.php ");
    }
} else if ($category == 1) {

    $query    = "DELETE FROM club_pics WHERE id = '$id'";
    $result   = mysqli_query($conn, $query);

    $folder = './club_pics/' . $post;
    $status = unlink($folder);
    if ($status) {
        header("Location: viewprofile.php ");
    }
}
