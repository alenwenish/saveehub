<?php

session_start();
include('config/connect.php');
$status = '';

$search_name = '';
$search_msg = 'No Results !';

$name = $bio = $link = $pic =  $count = '';

if (isset($_POST['search'])) {

    $search_name = stripslashes($_REQUEST['search_name']);
    $search_name = mysqli_real_escape_string($conn, $search_name);

    $username = $search_name;

    $testname = '';

    $sql = "SELECT username  FROM login WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)){
        $testname = $res->fetch_array()['username'];
        $status = 0;
    }
    
    $sql = "SELECT club_name  FROM club WHERE club_name = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res)){
        $testname = $res->fetch_array()['club_name'];
        $status = 1;
    }
    
    $sql = "SELECT count(follower_name) as following FROM followers WHERE account = '$username'";
    $res = mysqli_query($conn, $sql);
    $following = $res->fetch_array()['following'];

    $sql = "SELECT count(follower_name) as follower FROM followers WHERE follower_name = '$username'";
    $res = mysqli_query($conn, $sql);
    $follower = $res->fetch_array()['follower'];


    if($status == 0){
    $sql = "SELECT name  FROM login WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $name = $res->fetch_array()['name'];
        
    $sql = "SELECT bio  FROM login WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $bio = $res->fetch_array()['bio'];

    $sql = "SELECT link FROM login WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $link = $res->fetch_array()['link'];

    $sql = "SELECT pic FROM login where username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $pic = $res->fetch_array()['pic'];

    $sql = "SELECT COUNT(post) as count FROM image where username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $count = $res->fetch_array()['count'];
    }else if($status == 1){
    $sql = "SELECT name  FROM club WHERE club_name = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $name = $res->fetch_array()['name'];

    $sql = "SELECT bio  FROM club WHERE club_name = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $bio = $res->fetch_array()['bio'];


    $sql = "SELECT link FROM club WHERE club_name = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $link = $res->fetch_array()['link'];

    $sql = "SELECT pic FROM club where club_name = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $pic = $res->fetch_array()['pic'];

    $sql = "SELECT COUNT(post) as count FROM club_pics where username = '$username'";
    $res = mysqli_query($conn, $sql);
    if (mysqli_num_rows($res))
        $count = $res->fetch_array()['count'];
    }
    if($name == ''){
        $search_name = '';
        $search_msg = 'User Not Found';
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search </title>
    <?php include('header.php'); ?>
    <style>
    #profile_pic {
        width: 180px;
        height: 180px;
        border-radius: 80px;
    }

    #username,
    #name,
    #link,
    #bio {
        border-bottom: 2px solid black;
    }

    #box1 {
        margin: 20px;
    }

    #part1 {

        background-image: linear-gradient(to right, #76e3e9, #8de5ea, #a1e7ea, #b3e9eb, #c4ebec);
        box-shadow: 0 0 10px 1px black;
        border: 1px solid black;

    }

    #part2 {
        background-image: linear-gradient(to right, #011314, #081516, #0f1818, #141a1a, #181c1c);
        margin: 20px 0 20px 0;
    }

    #followers,
    #following,
    #posts {
        border: 1px solid #0f0;
        background-image: linear-gradient(to right, #011314, #081516, #0f1818, #141a1a, #181c1c);
        border-radius: 10px;
    }

    @media (min-width: 1100px) {

        #followers,
        #following,
        #posts {
            font-size: 21px;
        }
    }

    @media screen and (max-width: 1000px) and (min-width: 200px) {

        #followers,
        #following,
        #posts {
            font-size: 11px;
        }
    }

    .tilt-in-top-1 {
        -webkit-animation: tilt-in-top-1 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        animation: tilt-in-top-1 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    }

    @-webkit-keyframes tilt-in-top-1 {
        0% {
            -webkit-transform: rotateY(30deg) translateY(-300px) skewY(-30deg);
            transform: rotateY(30deg) translateY(-300px) skewY(-30deg);
            opacity: 0;
        }

        100% {
            -webkit-transform: rotateY(0deg) translateY(0) skewY(0deg);
            transform: rotateY(0deg) translateY(0) skewY(0deg);
            opacity: 1;
        }
    }

    @keyframes tilt-in-top-1 {
        0% {
            -webkit-transform: rotateY(30deg) translateY(-300px) skewY(-30deg);
            transform: rotateY(30deg) translateY(-300px) skewY(-30deg);
            opacity: 0;
        }

        100% {
            -webkit-transform: rotateY(0deg) translateY(0) skewY(0deg);
            transform: rotateY(0deg) translateY(0) skewY(0deg);
            opacity: 1;
        }
    }

    /* ------------------ */

    .effects {
        cursor: pointer;
        background: transparent;
        position: relative;
        display: inline-block;
        padding: 15px 30px;
        outline: none;
        border: 2px solid #0f0;

        text-transform: uppercase;
        font-weight: 900;
        text-decoration: none;
        letter-spacing: 2px;
        color: #fff;

    }


    .effects span {
        position: relative;
        z-index: 100;
    }

    .effects::before {
        content: "";
        position: absolute;
        left: -20px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 2px;
        box-shadow: 5px -8px 0 #0f0,
            5px 8px 0 #0f0;

    }

    .effects::after {
        content: "";
        position: absolute;
        right: -20px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 2px;

        box-shadow: -5px -8px 0 #0f0,
            -5px 8px 0 #0f0;
    }
    </style>
</head>

<body id="search">

    <!-- <?php include('navigation.php');  ?> -->



    <form action="" method="POST" class="d-flex mx-auto justify-content-center w-75">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search here... " name="search_name"
                aria-describedby="button-addon2">
            <button class="btn btn-primary" type="submit" name="search" id="button-addon2"><i
                    class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>


    <?php if ($search_name != '') { echo $status; ?>

    <div class=" row p-2" id="box1">
        <div class="text-center col col-lg-4 text-dark" id="part1">

            <?php if ($pic == '') {  ?>
            <h1 style="font-size:72px"> <i class="fa-regular fa-user pt-3"></i> </h1>
            <?php } else { ?>
            <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
            <?php } ?>

            <p class="fs-3 fw-bold"> <?php echo  $username ?> </p>

            <div class="text-center">
                <spam class="fw-bolder"> <?php echo $name; ?></spam> <br>
                <spam><?php echo $bio; ?></spam> <br>
                <a href="https://<?php echo $link ?>" class="text-primary fw-bold"> <?php echo $link; ?> </a>

            </div>
            <br>
        </div>

        <div class=" col col-lg-8 " id="part2">
            <div class="d-flex justify-content-around text-center pt-3 pe-3 mx-auto">

                <button class="text-light fw-bolder  m-1 p-2 w-25" class="btn" id="posts">
                    <a href="#post" class="text-decoration-none text-white"> Posts </a> <br>
                    <?php echo $count; ?>
                </button>

                <button class="text-light fw-bolder  m-1 p-2 w-25 " class="btn" data-bs-toggle="modal"
                    data-bs-target="#exampleModal" id="followers">
                    Followers <br>
                    <?php echo $follower; ?>
                </button>

                <button class="text-light fw-bolder  m-1 p-2 w-25" class="btn" data-bs-toggle="modal"
                    data-bs-target="#exampleModal1" id="following">
                    Following <br>
                    <?php echo $following; ?>
                </button>
            </div>

            <button class="effects btn text-center mx-auto my-3 d-block w-75 " data-bs-toggle="modal"
                data-bs-target="#exampleModal2">
                <a href="#" class="text-decoration-none text-white"> Follow </a>
            </button>

        </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Followers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

                    <?php
                        $query = "SELECT account from followers where follower_name = '$username'";
                        $result = mysqli_query($conn, $query);
                        $rows = array();
                        while ($row = mysqli_fetch_array($result))
                            $rows[] = $row;
                        ?>


                    <?php foreach ($rows as $row) { ?>


                    <div class="d-flex justify-content-around">
                        <span class="p-1 text-center text-secondary w-50 border shadow ">
                            <?php echo $row['account']; ?>
                        </span>
                        <span> <a
                                href="unfollow.php?follower_name=<?php echo $username ?>&account=<?php echo $row['account'] ?>"><button
                                    class="btn btn-secondary"> Remove </button></a></span>
                    </div>
                    <br>
                    <?php } ?>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Following</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <?php
                        $query = "SELECT follower_name from followers where account = '$username'";
                        $result = mysqli_query($conn, $query);
                        $rows = array();
                        while ($row = mysqli_fetch_array($result))
                            $rows[] = $row;
                        ?>

                    <?php foreach ($rows as $row) { ?>

                    <div class="d-flex justify-content-around">

                        <span class="p-1 text-center text-secondary w-50 border shadow ">
                            <?php echo $row['follower_name']; ?> </span>

                        <span> <a
                                href="unfollow.php?follower_name=<?php echo $row['follower_name'] ?>&account=<?php echo $username ?>">
                                <button class="btn btn-secondary"> Unfollow</button> </a></span>

                    </div>
                    <br>


                    <?php } ?>
                </div>

            </div>
        </div>
    </div>


    <h3 class="text-secondary fw-normal text-center "> POSTS</h3>

    <div class="container  p-1" id="post">
        <?php  if ($status == 0) {

                $sql = "SELECT * FROM image where username = '$username'";

                echo $sql;

                $res = mysqli_query($conn, $sql);

                $my_pics = array();
                while ($row = mysqli_fetch_array($res))
                    $my_pics[] = $row;

                echo $my_pics;
                
                foreach ($my_pics as $data) {
        ?>


        <img src="./uploads/<?php echo $data['post']; ?>" width="30%" height="10%" alt="" class="images btn d-inline"
            data-bs-toggle="modal" data-bs-target="#<?php echo $data['username']; ?><?php echo $data['id']; ?>">

        <div class="modal fade" id="<?php echo $data['username']; ?><?php echo $data['id']; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div>
                        <?php if ($pic != '') { ?>
                        <img src="./profile_pics/<?php echo $pic ?>" class="m-2 text-start" alt=""
                            style=" width: 50px; height: 50px; border-radius: 80px;">
                        <?php } else { ?>
                        <i class="fa-regular fa-user m-2 text-start fs-3"></i>
                        <?php } ?>
                        <span class="fs-5 text-start " id="exampleModalLabel"><?php echo $data['username']; ?>
                        </span>
                        <a href="delete.php?id=<?php echo $data['id']; ?>&category=0&post=<?php echo $data['post']; ?>"
                            class="float-end me-2 mt-3 text-danger"> <i class="fa-solid fa-trash"></i></a>

                    </div>



                    <div class="tilt-in-top-1 modal-body">
                        <img src="./uploads/<?php echo $data['post']; ?>" width="100%" height="100%" alt="">
                        <br><br>
                        &nbsp;
                        <a href="update.php?id=<?php echo $data['id'] ?>&pic=1"
                            class="text-decoration-none text-danger">
                            <i class="fa-regular fa-heart fs-3"> </i>
                        </a> &nbsp;
                        <span class="fs-4"><?php echo $data['likes']; ?> likes </span>

                        &nbsp;
                        <i class="fa-regular fa-comment text-primary fs-3"></i> &nbsp;
                        <a href="comments.php?id=<?php echo $data['id'] ?>&owner=<?php echo $data['username']; ?>&comment_status=0"
                            class="text-decoration-none fs-4 text-secondary"><span>

                                <?php
                                            $image_id = $data['id'];
                                            $comment_query = "SELECT COUNT(comments)as count from image_comments where image_id='$image_id'";
                                            $res = mysqli_query($conn, $comment_query);

                                            echo $res->fetch_array()['count'];


                                            ?>

                                Comments</span>
                        </a>

                        <?php if ($data['caption'] != '') {  ?>

                        <div class="text-start fs-5 fw-light mx-auto">
                            &nbsp; <span class="fw-bold"> <?php echo $data['username']; ?>:</span>
                            <?php echo $data['caption'] ?>
                        </div>
                        <?php } ?>

                        <div class="text-start text-secondary mx-auto">
                            &nbsp; <span class="fs-6">
                                <?php
                                            $dt = strtotime($data['created_at']);
                                            echo date("d", $dt);
                                            echo " ";
                                            echo date("M", $dt);
                                            echo " ";
                                            echo date("Y", $dt);
                                            ?>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>





        <?php }
            } else if ($status == 1) {

                $sql = "SELECT * FROM club_pics where username = '$username'";
                echo $sql;
                $res = mysqli_query($conn, $sql);
                
                $my_pics = array();
                while ($row = mysqli_fetch_array($res))
                    $my_pics[] = $row;

                foreach ($my_pics as $data) {


                ?>
        <img src="./club_pics/<?php echo $data['post']; ?>" width="25%" height="10%" alt="" class="btn"
            data-bs-toggle="modal" data-bs-target="#<?php echo $data['username'][0]; ?><?php echo $data['id']; ?>">


        <div class="modal fade" id="<?php echo $data['username'][0]; ?><?php echo $data['id']; ?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div>
                        <img src="./profile_pics/<?php echo $pic ?>" class="m-2 text-start " alt=""
                            style=" width: 50px; height: 50px; border-radius: 80px;">
                        <span class="fs-5 text-start " id="exampleModalLabel"><?php echo $data['username']; ?>
                        </span>
                        <a href="delete.php?id=<?php echo $data['id']; ?>&category=1&post=<?php echo $data['post']; ?>"
                            class="float-end me-2 mt-3 text-danger"> <i class="fa-solid fa-trash"></i></a>
                    </div>

                    <div class="tilt-in-top-1 modal-body">
                        <img src="./club_pics/<?php echo $data['post']; ?>" width="100%" height="100%" alt="">
                        <br><br>
                        &nbsp;
                        <a href="update.php?id=<?php echo $data['id'] ?>&pic=0"
                            class="text-decoration-none text-danger">
                            <i class="fa-regular fa-heart fs-3"> </i>
                        </a> &nbsp;
                        <span class="fs-4"><?php echo $data['likes']; ?> likes </span>

                        &nbsp;
                        <i class="fa-regular fa-comment text-primary fs-3"></i> &nbsp;
                        <a href="comments.php?id=<?php echo $data['id'] ?>&owner=<?php echo $data['username']; ?>&comment_status=1"
                            class="text-decoration-none text-secondary fs-4"><span>

                                <?php
                                            $image_id = $data['id'];
                                            $comment_query = "SELECT COUNT(comments)as count from club_pics_comments where image_id='$image_id'";
                                            $res = mysqli_query($conn, $comment_query);

                                            echo $res->fetch_array()['count'];


                                            ?>

                                Comments</span>
                        </a>

                        <?php if ($data['caption'] != '') {  ?>

                        <div class="text-start fs-5 fw-light mx-auto">
                            &nbsp; <span class="fw-bold"> <?php echo $data['username']; ?>:</span>
                            <?php echo $data['caption'] ?>
                        </div>
                        <?php } ?>

                        <div class="text-start text-secondary mx-auto">
                            &nbsp; <span class="fs-6">
                                <?php
                                            $dt = strtotime($data['created_at']);
                                            echo date("d", $dt);
                                            echo " ";
                                            echo date("M", $dt);
                                            echo " ";
                                            echo date("Y", $dt);
                                            ?>
                            </span>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        <?php }
            } ?>

    </div>


    <br><br> <br>

    <?php } else {  ?>

    <p class="text-center p-2 text-secondary"> <?php echo $search_msg; ?> </p>

    <?php } ?>
    <?php include('footer.php'); ?>
</body>

</html>