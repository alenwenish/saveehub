<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];
$status = $_SESSION['is_club'];


$sql = "SELECT * FROM image where username IN (SELECT follower_name FROM followers WHERE account = '$username') ORDER BY created_at DESC LIMIT 10";


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
    <title>Home - Page</title>
    <?php include('header.php') ?>

    <style>
        .friends_pic {
            width: 40px;
            height: 40px;
            border-radius: 80px;
        }

        .loader-wrapper {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            background-color: #242f3f;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            display: inline-block;
            width: 30px;
            height: 30px;
            position: relative;
            border: 4px solid #Fff;
            animation: loader 2s infinite ease;
        }

        .loader-inner {
            vertical-align: top;
            display: inline-block;
            width: 100%;
            background-color: #fff;
            animation: loader-inner 2s infinite ease-in;
        }

        @keyframes loader {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(180deg);
            }

            50% {
                transform: rotate(180deg);
            }

            75% {
                transform: rotate(360deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes loader-inner {
            0% {
                height: 0%;
            }

            25% {
                height: 0%;
            }

            50% {
                height: 100%;
            }

            75% {
                height: 100%;
            }

            100% {
                height: 0%;
            }
        }

        .swirl-in-fwd {
            -webkit-animation: swirl-in-fwd 1.2s ease-out both;
            animation: swirl-in-fwd 1.2s ease-out both;
        }

        @-webkit-keyframes swirl-in-fwd {
            0% {
                -webkit-transform: rotate(-540deg) scale(0);
                transform: rotate(-540deg) scale(0);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotate(0) scale(1);
                transform: rotate(0) scale(1);
                opacity: 1;
            }
        }

        @keyframes swirl-in-fwd {
            0% {
                -webkit-transform: rotate(-540deg) scale(0);
                transform: rotate(-540deg) scale(0);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotate(0) scale(1);
                transform: rotate(0) scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>


    <?php include('navigation.php'); ?>



    <?php foreach ($rows as $row) { ?>

        <div class="text-center ">


            <h4 class="ps-3 ">
                <?php
                $picture = '';
                $name = $row['username'];
                $sql = "SELECT pic FROM login where username = '$name'";
                $res = mysqli_query($conn, $sql);
                $picture = $res->fetch_array()['pic'];
                if ($picture == '') { ?>
                    <i class="fa-regular fa-user"></i>
                <?php } else { ?>
                    <img src="./profile_pics/<?php echo $picture; ?>" alt="" class="friends_pic">
                <?php } ?>
                <?php echo $row['username']; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <span>
                    <i class="fa-solid fa-ellipsis-vertical btn" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Save Post">
                    </i>
                </span>
            </h4>


            <img src="./uploads/<?php echo $row['post']; ?>" width="300px" class="swirl-in-fwd p-3 shadow mx-auto" alt="">


            <h4 class="p-1">
                <a href="update.php?id=<?php echo $row['id'] ?>&pic=1" class="text-decoration-none text-danger">
                    <i class="fa-regular fa-heart"> </i>
                </a>
                <?php echo $row['likes']; ?> likes
                &nbsp;
                <i class="fa-regular fa-comment text-primary"></i>
                <a href="comments.php?id=<?php echo $row['id'] ?>&owner=<?php echo $row['username']; ?>&comment_status=0" class="text-decoration-none text-secondary"><span>

                        <?php
                        $image_id = $row['id'];
                        $comment_query = "SELECT COUNT(comments)as count from image_comments where image_id='$image_id'";
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
    <?php include('footer.php'); ?>

    <script>
        $(window).on("load", function() {
            $(".loader-wrapper").delay(1000).fadeOut("slow");
        });


        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>


</body>

</html>