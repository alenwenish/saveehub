<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];

$_SESSION['status'] = 1;

$sql = "SELECT * FROM image where username IN (SELECT follower_name FROM followers WHERE account = '$username')";


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
    <!-- <?php include('navigation.php'); ?> -->
    <br>

    <?php foreach($rows as $row) { ?>

    <div class="text-center">
       <h4 class="ps-3"> <i class="fa-regular fa-user"></i> <?php echo $row['username']; ?>  </h4>
       <img src="./uploads/<?php echo $row['post']; ?>"  width="300px" class="p-3 shadow mx-auto" alt="">
       <h4 class="p-1">  <a href="update.php?id=<?php echo $row['id'] ?>" class="text-decoration-none text-danger" > <i class="fa-regular fa-heart"> </i> </a> <?php echo $row['likes']; ?> likes  </h4>
    </div>
    <hr>
   
    <?php } ?>

    

    <br><br>
    <?php include('footer.php'); ?>

    
</body>
</html>