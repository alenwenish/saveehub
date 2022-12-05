<?php

session_start();
include('config/connect.php');



$username = $_SESSION['name'];

$sql = "SELECT * FROM club_pics where username IN (SELECT follower_name FROM followers WHERE account = '$username')";


$res = mysqli_query($conn, $sql);
$rows = array();
while ($row = mysqli_fetch_array($res))
    $rows[] = $row;



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <?php include('header.php') ?>
</head>

<body>
    <?php include('navigation.php'); ?>

    <br>

    <?php foreach ($rows as $row) { ?>

        <div class="text-center">
            <h4 class="ps-3">
                <i class="fa-regular fa-user"></i> <?php echo $row['username']; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <span>
                    <i class="fa-solid fa-ellipsis-vertical btn" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Save Post">
                    </i>
                </span>
            </h4>
            <img src="./club_pics/<?php echo $row['post']; ?>" width="300px" class="p-3 shadow mx-auto" alt="">
            <h4 class="p-1">
                <a href="update.php?id=<?php echo $row['id'] ?>&pic=0" class="text-decoration-none text-danger">
                    <i class="fa-regular fa-heart"> </i>
                </a>
                <?php echo $row['likes']; ?> likes
                &nbsp;
                <i class="fa-regular fa-comment text-primary"></i>
                <span> 0 Comments</span>
            </h4>
        </div>
        <hr>

    <?php } ?>

    <br><br>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>




    <?php include('footer.php'); ?>
</body>

</html>