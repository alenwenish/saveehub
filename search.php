<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];
$status = $_SESSION['is_club'];





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search - Page</title>
    <?php include('header.php') ?>

    
</head>

<body>
    <?php include('navigation.php'); ?>

    <div class="text-center text-secondary">

    <br>

    Search Page <br> <br>
    Coming Soon <i class="fa-solid fa-hourglass-end"></i>  <br>
    Phase 2


    </div>
    
    <?php include('footer.php'); ?>

   

</body>

</html>