<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];
$status = $_SESSION['is_club'];

$savedclub_pics = array();
$saved_pics = array();


$sql = "SELECT post FROM club_pics WHERE id IN (SELECT clubpost_id FROM saved_clubpics WHERE username = '$username');";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res))
    $savedclub_pics[] = $row;


$sql = "SELECT post FROM image WHERE id IN (SELECT post_id FROM saved_pics WHERE username = '$username');";
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res))
    $saved_pics[] = $row;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <?php include('header.php') ?>

    <style>
        #save_pics{
            /* display: none; */
        }
    </style>
</head>

<body class="container">


    <div class="mx-auto w-75 mt-5">
        <ul class="list-group ">
            <li class="list-group-item d-flex justify-content-between fs-3 align-items-center ">
                <i class="fa-solid fa-bookmark"></i> Saved posts
                <span class="badge text-primary  fs-4 rounded-pill"> <i class="fa-solid fa-angle-down" id="saved_post"></i>
                </span>
            </li>

            <div class="p-2 border border-light shadow m-3 " id="save_pics">
                <?php foreach ($saved_pics as $data) { ?>
                    <img src="./uploads/<?php echo $data['post']; ?>" width="30%" height="30%" alt="" class="p-2">
                <?php } ?>
                <?php foreach ($savedclub_pics as $data) { ?>
                    <img src="./club_pics/<?php echo $data['post']; ?>" width="30%" height="30%" alt="" class="p-2">
                <?php } ?>
            </div>

            <li class="list-group-item d-flex justify-content-between fs-3 align-items-center">

                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <a class="nav-link text-black float-end text-warning fs-3" href="logout.php"> Logout </a>
                <span class="badge text-primary fs-4 rounded-pill">

            </li>
        </ul>
    </div>



    <br><br>
    <?php include('footer.php'); ?>

    




</body>

<script>
    $(document).ready(function() {
      $("#saved_post").click(function() {
        $("#save_pics").slideToggle("slow");
      });
    });

</script>

</html>