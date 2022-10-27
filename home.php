<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];
$sql = "SELECT * FROM image where username != '$username'";
$res = mysqli_query($conn,$sql);
$rows = array();
while($row = mysqli_fetch_array($res))
    $rows[] = $row;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Page</title>
    <?php include('header.php') ?>
</head>

<body>
    <?php include('navigation.php'); ?>
    <br>

    <?php foreach($rows as $row) { ?>

    <div class="text-center">
       <h4 class="ps-3"> <i class="fa-regular fa-user"></i> <?php echo $row['username']; ?>  </h4>
       <img src="./uploads/<?php echo $row['post']; ?>"  width="300px" class="p-3 shadow mx-auto" alt="">
       <h4 class="p-1"> <i class="fa-regular fa-heart"> </i> <?php echo $row['likes']; ?> likes  </h4>
    </div>
    <hr>
   
    <?php } ?>

    

    <br><br>
    <?php include('footer.php'); ?>
</body>
</html>