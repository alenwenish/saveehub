<?php

session_start();
include('config/connect.php');



$username = $_SESSION['name'];

$sql = "SELECT * FROM club_pics where username IN (SELECT follower_name FROM followers WHERE account = '$username') ORDER BY created_at DESC LIMIT 10";


$rows = array();
$res = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($res))
    $rows[] = $row;


if (isset($_POST['savepost'])) {
    $id = stripslashes($_REQUEST['savepost']);
    $query    = "INSERT INTO saved_clubpics (clubpost_id,username)VALUES ('$id', '$username')";
    $result   = mysqli_query($conn, $query);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <?php include('header.php') ?>
    <style>
        .club_pic {
            width: 40px;
            height: 40px;
            border-radius: 80px;
        }

        .roll-in-left {
            -webkit-animation: roll-in-left 1s ease-out both;
            animation: roll-in-left 1s ease-out both;
        }

        @-webkit-keyframes roll-in-left {
            0% {
                -webkit-transform: translateX(-800px) rotate(-540deg);
                transform: translateX(-800px) rotate(-540deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: translateX(0) rotate(0deg);
                transform: translateX(0) rotate(0deg);
                opacity: 1;
            }
        }

        @keyframes roll-in-left {
            0% {
                -webkit-transform: translateX(-800px) rotate(-540deg);
                transform: translateX(-800px) rotate(-540deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: translateX(0) rotate(0deg);
                transform: translateX(0) rotate(0deg);
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <?php include('navigation.php'); ?>



    <?php foreach ($rows as $row) { ?>

        <div class="text-center">
            <h4 class="ps-3">
                <?php
                $pic = '';
                $name = $row['username'];
                $sql = "SELECT pic FROM club where club_name = '$name'";
                $res = mysqli_query($conn, $sql);

                $pic = $res->fetch_array()['pic'];
                if ($pic == '') { ?>
                    <i class="fa-regular fa-user"></i>
                <?php } else { ?>
                    <img src="./profile_pics/<?php echo $pic; ?>" alt="" class="club_pic">
                <?php } ?>


                <?php echo $row['username']; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <span>
                    <i class="fa-solid fa-ellipsis-vertical btn" data-bs-toggle="modal" data-bs-target="#I<?php echo  $row['id']; ?>">
                    </i>
                </span>

                <div class="modal fade " id="I<?php echo  $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog ">
                        <div class="modal-content ">
                            <div class="modal-body d-flex justify-content-between bg-secondary">

                                <form method="POST">
                                    <button class="btn text-start text-light" type="submit" value=<?php echo  $row['id']; ?> name="savepost">
                                        <i class="fs-4 fa-regular fa-bookmark"></i>
                                    </button>
                                </form>

                                <h3 class="text-secondary fs-4 float-end pt-1 text-light pe-3">Save Post</h3>

                            </div>
                        </div>
                    </div>
                </div>

            </h4>
            <img src="./club_pics/<?php echo $row['post']; ?>" width="300px" class="roll-in-left p-3 shadow mx-auto" alt="">
            <h4 class="p-1">
                <a href="update.php?id=<?php echo $row['id'] ?>&pic=0" class="text-decoration-none text-danger">
                    <i class="fa-regular fa-heart"> </i>
                </a>
                <?php echo $row['likes']; ?> likes
                &nbsp;
                <i class="fa-regular fa-comment text-primary"></i>
                <a href="comments.php?id=<?php echo $row['id'] ?>&owner=<?php echo $row['username']; ?>&comment_status=1" class="text-decoration-none text-secondary"><span>

                        <?php
                        $image_id = $row['id'];
                        $comment_query = "SELECT COUNT(comments)as count from club_pics_comments where image_id='$image_id'";
                        $res = mysqli_query($conn, $comment_query);

                        echo $res->fetch_array()['count'];


                        ?>

                        Comments</span></a>
            </h4>

            <?php if ($row['caption'] != '') {  ?>


                <div class="text-start fs-5 fw-light mx-auto" style="width: 300px; height:auto;">
                    <span class="fw-bold"> <?php echo $row['username']; ?>:</span> <?php echo $row['caption'] ?>
                </div>

            <?php } ?>

            <div class="text-start text-secondary mx-auto" style="width: 300px; height:auto;">
                <span class="fs-6">
                    <?php
                    $dt = strtotime($row['created_at']);
                    echo date("d", $dt);
                    echo " ";
                    echo date("M", $dt);
                    echo " ";
                    echo date("Y", $dt);
                    ?>
                </span>
            </div>

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