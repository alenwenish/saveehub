<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];

$status_of_comment = $_GET['comment_status'];
$id = $_GET['id'];
$owner = $_GET['owner'];

$comment = '';
if (isset($_POST['post'])) {
    $comment = stripslashes($_REQUEST['comment']);
    $comment = mysqli_real_escape_string($conn, $comment);

    if ($status_of_comment == 0) {

        $query    = "INSERT INTO image_comments (image_id,commenter,owner,comments)
    VALUES ('$id', '$username', '$owner' , '$comment')";

        $result   = mysqli_query($conn, $query);
    } else if ($status_of_comment == 1) {
        $query    = "INSERT INTO club_pics_comments (image_id,commenter,owner,comments)
    VALUES ('$id', '$username', '$owner' , '$comment')";

        $result   = mysqli_query($conn, $query);
    }
}

$rows = array();
$row_of_pic = array();

if ($status_of_comment == 0) {
    $sql = "SELECT * FROM image_comments where image_id = '$id'";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($res))
        $rows[] = $row;

    $query = "SELECT * from image where id = '$id'";
    $result = mysqli_query($conn, $query);

    while ($r = mysqli_fetch_array($result))
        $row_of_pic[] = $r;
} else if ($status_of_comment == 1) {
    $sql = "SELECT * FROM club_pics_comments where image_id = '$id'";
    $res = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($res))
        $rows[] = $row;


    $query = "SELECT * from club_pics where id = '$id'";
    $result = mysqli_query($conn, $query);

    while ($r = mysqli_fetch_array($result))
        $row_of_pic[] = $r;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Comments</title>
    <?php include('header.php') ?>
    <style>
        .friends_pic {
            width: 40px;
            height: 40px;
            border-radius: 80px;
        }
    </style>
</head>

<body class="container">
    <?php include('navigation.php'); ?>


    <?php if ($status_of_comment == 0) { ?>

        <div class="justify-content-center text-center m-2">

            <a href="javascript:history.go(-1)" class="text-dark text-decoration-none fs-3 ms-5 float-start"><i class="fa-solid fa-arrow-left"></i> </a>

            <h4 class="ps-3 ">
                <?php
                $picture = '';
                $name = $row_of_pic[0]['username'];
                $sql = "SELECT pic FROM login where username = '$name'";
                $res = mysqli_query($conn, $sql);
                $picture = $res->fetch_array()['pic'];
                if ($picture == '') { ?>
                    <i class="fa-regular fa-user"></i>
                <?php } else { ?>
                    <img src="./profile_pics/<?php echo $picture; ?>" alt="" class="friends_pic">
                <?php } ?>
                <?php echo $row_of_pic[0]['username']; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <span>
                    <i class="fa-solid fa-ellipsis-vertical btn" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Save Post">
                    </i>
                </span>
            </h4>


            <img src="./uploads/<?php echo $row_of_pic[0]['post']; ?>" width="400px" class="p-3 shadow mx-auto" alt="">

            <br>
            <br>
            <h4 class="p-1">
                <a href="update.php?id=<?php echo $row_of_pic[0]['id'] ?>&pic=1" class="text-decoration-none text-danger">
                    <i class="fa-regular fa-heart"> </i>
                </a>
                <?php echo $row_of_pic[0]['likes']; ?> likes
                &nbsp;
                <i class="fa-regular fa-comment text-primary"></i>
                <a href="comments.php?id=<?php echo $row_of_pic[0]['id'] ?>&owner=<?php echo $row_of_pic[0]['username']; ?>&comment_status=0" class="text-decoration-none text-secondary"><span>
                        <?php
                        $image_id = $row_of_pic[0]['id'];
                        $comment_query = "SELECT COUNT(comments)as count from image_comments where image_id='$image_id'";
                        $res = mysqli_query($conn, $comment_query);

                        echo $res->fetch_array()['count'];


                        ?> Comments</span></a>

            </h4>

            <?php if ($row_of_pic[0]['caption'] != '') {  ?>
                <div class="text-start fs-5 fw-light mx-auto" style="width: 300px; height:auto;">
                    <span class="fw-bold"> <?php echo $row_of_pic[0]['username']; ?>:</span> <?php echo $row_of_pic[0]['caption'] ?>
                </div>
            <?php } ?>

            <div class="text-start text-secondary mx-auto" style="width: 300px; height:auto;">
                <span class="fs-6">
                    <?php
                    $dt = strtotime($row_of_pic[0]['created_at']);
                    echo date("d", $dt);
                    echo " ";
                    echo date("M", $dt);
                    echo " ";
                    echo date("Y", $dt);
                    ?>
                </span>
            </div>


            <br>


            <form action="" method="POST" class="d-flex justify-content-center">
                <label for="comment" class="form-label">
                    <?php if ($pic == '') {  ?>
                        <i class="fs-3 fa-regular fa-user"></i>
                    <?php } else { ?>
                        <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
                    <?php } ?>
                </label> &nbsp;
                <input type="text" class="form-control w-25" name="comment" id="comment" placeholder="Add a comment..."> &nbsp;
                <button type="submit" class="btn btn-secondary" name="post" id="post">Post</button>
            </form>

        </div>


        <?php foreach ($rows as $row) { ?>

            <div class="mx-auto w-50  card border border-1 border-secondary d-flex p-2 shadow ">
                <div class="">
                    <div class="float-start">

                        <?php
                        $comment_pic = '';
                        $name = $row['commenter'];

                        $sql = "SELECT pic FROM login where username = '$name'";
                        $res = mysqli_query($conn, $sql);
                        $c = mysqli_num_rows($res);
                        if ($c == 1)
                            $comment_pic = $res->fetch_array()['pic'];

                        $sql = "SELECT pic FROM club where club_name = '$name'";
                        $res = mysqli_query($conn, $sql);
                        $c = mysqli_num_rows($res);
                        if ($c == 1)
                            $comment_pic = $res->fetch_array()['pic'];

                        if ($comment_pic == '') { ?>
                            <i class="fs-3 fa-regular fa-user"></i>
                        <?php } else { ?>
                            <img src="./profile_pics/<?php echo $comment_pic; ?>" alt="" class="friends_pic">
                        <?php } ?>


                        <span class="fs-5 fw-normal px-1"><?php echo $row['commenter'] ?></span>
                    </div>

                    <div class="float-end">
                        <span class="fs-6 ">
                            <?php
                            $dt = strtotime($row['created_at']);
                            echo date("d", $dt);
                            echo " ";
                            echo date("M", $dt);
                            echo " ";
                            echo date("Y", $dt);
                            ?>
                        </span>

                        <?php if ($username == $row['commenter'] || $username == $row_of_pic[0]['username']) { ?>

                            <!-- <form action="" method="POST"> -->
                                <button type="submit" class="btn" name="delete_comment_user_<?php echo $row['comment_id'] ?>">
                                    <i class="fa-solid fa-trash fs-6 text-danger"></i>
                                </button>
                            <!-- </form> -->

                            <!-- <?php

                            $variable = 'delete_comment_user_'.$row['comment_id'];
                            if (isset($_POST[$variable])) {
                                echo $row['commenter'];
                            }
                            ?> -->



                        <?php } ?>
                    </div>
                </div>
                <div class="px-5">
                    <span class="fs-5 text-secondary"><?php echo $row['comments'] ?></span>
                </div>
            </div>

            <br>

        <?php } ?>

    <?php } else if ($status_of_comment == 1) { ?>

        <div class="justify-content-center text-center m-2">


            <a href="javascript:history.go(-1)" class="text-dark text-decoration-none fs-3 ms-5 float-start"><i class="fa-solid fa-arrow-left"></i> </a>

            <h4 class="ps-3 ">
                <?php
                $picture = '';
                $name = $row_of_pic[0]['username'];
                $sql = "SELECT pic FROM club where club_name = '$name'";
                $res = mysqli_query($conn, $sql);
                $picture = $res->fetch_array()['pic'];
                if ($picture == '') { ?>
                    <i class="fa-regular fa-user"></i>
                <?php } else { ?>
                    <img src="./profile_pics/<?php echo $picture; ?>" alt="" class="friends_pic">
                <?php } ?>
                <?php echo $row_of_pic[0]['username']; ?>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <span>
                    <i class="fa-solid fa-ellipsis-vertical btn" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="Save Post">
                    </i>
                </span>
            </h4>


            <img src="./club_pics/<?php echo $row_of_pic[0]['post']; ?>" width="400px" class="p-3 shadow mx-auto" alt="">

            <br>
            <br>
            <h4 class="p-1">
                <a href="update.php?id=<?php echo $row_of_pic[0]['id'] ?>&pic=1" class="text-decoration-none text-danger">
                    <i class="fa-regular fa-heart"> </i>
                </a>
                <?php echo $row_of_pic[0]['likes']; ?> likes
                &nbsp;
                <i class="fa-regular fa-comment text-primary"></i>
                <a href="comments.php?id=<?php echo $row_of_pic[0]['id'] ?>&owner=<?php echo $row_of_pic[0]['username']; ?>&comment_status=1" class="text-decoration-none text-secondary"><span>
                        <?php
                        $image_id = $row_of_pic[0]['id'];
                        $comment_query = "SELECT COUNT(comments)as count from club_pics_comments where image_id='$image_id'";
                        $res = mysqli_query($conn, $comment_query);

                        echo $res->fetch_array()['count'];


                        ?> Comments</span></a>

            </h4>

            <?php if ($row_of_pic[0]['caption'] != '') {  ?>
                <div class="text-start fs-5 fw-light mx-auto" style="width: 300px; height:auto;">
                    <span class="fw-bold"> <?php echo $row_of_pic[0]['username']; ?>:</span> <?php echo $row_of_pic[0]['caption'] ?>
                </div>
            <?php } ?>

            <div class="text-start text-secondary mx-auto" style="width: 300px; height:auto;">
                <span class="fs-6">
                    <?php
                    $dt = strtotime($row_of_pic[0]['created_at']);
                    echo date("d", $dt);
                    echo " ";
                    echo date("M", $dt);
                    echo " ";
                    echo date("Y", $dt);
                    ?>
                </span>
            </div>


            <br>


            <form action="" method="POST" class="d-flex justify-content-center">
                <label for="comment" class="form-label">
                    <?php if ($pic == '') {  ?>
                        <i class="fs-3 fa-regular fa-user"></i>
                    <?php } else { ?>
                        <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
                    <?php } ?>
                </label> &nbsp;
                <input type="text" class="form-control w-25" name="comment" id="comment" placeholder="Add a comment..."> &nbsp;
                <button type="submit" class="btn btn-secondary" name="post" id="post">Post</button>
            </form>

        </div>


        <?php foreach ($rows as $row) { ?>

            <div class="mx-auto w-50  card border border-1 border-secondary d-flex p-2 shadow ">
                <div class="">
                    <div class="float-start">

                        <?php
                        $comment_pic = '';
                        $name = $row['commenter'];

                        $sql = "SELECT pic FROM login where username = '$name'";
                        $res = mysqli_query($conn, $sql);
                        $c = mysqli_num_rows($res);
                        if ($c == 1)
                            $comment_pic = $res->fetch_array()['pic'];

                        $sql = "SELECT pic FROM club where club_name = '$name'";
                        $res = mysqli_query($conn, $sql);
                        $c = mysqli_num_rows($res);
                        if ($c == 1)
                            $comment_pic = $res->fetch_array()['pic'];

                        if ($comment_pic == '') { ?>
                            <i class="fs-3 fa-regular fa-user"></i>
                        <?php } else { ?>
                            <img src="./profile_pics/<?php echo $comment_pic; ?>" alt="" class="friends_pic">
                        <?php } ?>


                        <span class="fs-5 fw-normal px-1"><?php echo $row['commenter'] ?></span>
                    </div>

                    <div class="float-end">
                        <span class="fs-6 ">
                            <?php
                            $dt = strtotime($row['created_at']);
                            echo date("d", $dt);
                            echo " ";
                            echo date("M", $dt);
                            echo " ";
                            echo date("Y", $dt);
                            ?>
                        </span>

                        <?php if ($username == $row['commenter']  || $username == $row_of_pic[0]['username']) { ?>
                            <button type="submit" class="btn" name="delete_comment_club">
                                <i class="fa-solid fa-trash fs-6 text-danger"></i>
                            </button>
                        <?php } ?>

                    </div>
                </div>
                <div class="px-5">
                    <span class="fs-5"><?php echo $row['comments'] ?></span>
                </div>
            </div>

            <br>

        <?php } ?>


    <?php } ?>






    <br><br>


</body>

</html>