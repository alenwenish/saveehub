<?php

session_start();
include('config/connect.php');
$status = $_SESSION['is_club'];


$username = $_SESSION['name'];
$name = $bio = $link = $pic =  $count = '';


$sql = "SELECT count(follower_name) as following FROM followers WHERE account = '$username'";
$res = mysqli_query($conn, $sql);
$following = $res->fetch_array()['following'];


$sql = "SELECT count(follower_name) as follower FROM followers WHERE follower_name = '$username'";
$res = mysqli_query($conn, $sql);
$follower = $res->fetch_array()['follower'];

if ($status == 0) {
  $sql = "SELECT name  FROM login WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  $name = $res->fetch_array()['name'];

  $sql = "SELECT bio  FROM login WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  $bio = $res->fetch_array()['bio'];

  $sql = "SELECT link FROM login WHERE username = '$username'";
  $res = mysqli_query($conn, $sql);
  $link = $res->fetch_array()['link'];

  $sql = "SELECT pic FROM login where username = '$username'";
  $res = mysqli_query($conn, $sql);
  $pic = $res->fetch_array()['pic'];

  $sql = "SELECT COUNT(post) as count FROM image where username = '$username'";
  $res = mysqli_query($conn, $sql);
  $count = $res->fetch_array()['count'];
} else if ($status == 1) {


  $sql = "SELECT name  FROM club WHERE club_name = '$username'";
  $res = mysqli_query($conn, $sql);
  $name = $res->fetch_array()['name'];

  $sql = "SELECT bio  FROM club WHERE club_name = '$username'";
  $res = mysqli_query($conn, $sql);
  $bio = $res->fetch_array()['bio'];

  $sql = "SELECT link FROM club WHERE club_name = '$username'";
  $res = mysqli_query($conn, $sql);
  $link = $res->fetch_array()['link'];

  $sql = "SELECT pic FROM club where club_name = '$username'";
  $res = mysqli_query($conn, $sql);
  $pic = $res->fetch_array()['pic'];

  $sql = "SELECT COUNT(post) as count FROM club_pics where username = '$username'";
  $res = mysqli_query($conn, $sql);
  $count = $res->fetch_array()['count'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <?php include('header.php'); ?>
  <style>
    #view_profile {
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

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
      background-image: linear-gradient(to right, #011314, #081516, #0f1818, #141a1a, #181c1c);
    }
  </style>
</head>

<body id="view_profile">

  <div class="row p-2" id="box1">
    <div class="text-center col-4 text-dark" id="part1">

      <?php if ($pic == '') {  ?>
        <h1 style="font-size:72px"> <i class="fa-regular fa-user"></i> </h1>
      <?php } else { ?>
        <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
      <?php } ?>

      <p class="fs-3 fw-bold"> <?php echo  $_SESSION['name'] ?> </p>

      <div class="text-center">
        <spam class="fw-bolder"> <?php echo $name; ?></spam> <br>
        <spam><?php echo $bio; ?></spam> <br>
        <a href="<?php echo $link ?>" class="text-primary fw-bold"> <?php echo $link; ?> </a>

      </div>
      <br>
    </div>

    <div class="col-8 " id="part2">
      <div class="d-flex justify-content-around text-center pt-3 pe-3 mx-auto">

        <button class=" text-light fw-bolder fs-4 m-1 p-2 w-25" class="btn" id="posts">
          <a href="#post" class="text-decoration-none text-white"> Posts </a> <br>
          <?php echo $count; ?>
        </button>

        <button class=" text-light fw-bolder fs-4 m-1 p-2 w-25 " class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" id="followers">
          Followers <br>
          <?php echo $follower; ?>
        </button>

        <button class=" text-light fw-bolder fs-4 m-1 p-2 w-25" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal1" id="following">
          Following <br>
          <?php echo $following; ?>
        </button>

      </div>

      <br>
      <button class="btn btn-secondary text-center mx-auto d-block w-75 " data-bs-toggle="modal" data-bs-target="#exampleModal2"> <a href="editprofile.php" class="text-decoration-none text-white"> Edit Profile </a> </button>
      <br>
      <br>
      <div class="w-75 m-auto text-center">
        <a href="upload.php" class="text-decoration-none fs-3 text-warning fw-normal">
          <i class="fa-solid fa-circle-plus"></i> New Post
        </a>

      </div>

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
              <span class="p-1 text-center text-secondary w-50 border shadow "> <?php echo $row['account']; ?> </span>
              <span> <a href="unfollow.php?follower_name=<?php echo $username?>&account=<?php echo $row['account']?>"><button class="btn btn-secondary"> Unfollow</button></a></span>

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

              <span class="p-1 text-center text-secondary w-50 border shadow "> <?php echo $row['follower_name']; ?> </span>

              <span> <a href="unfollow.php?follower_name=<?php echo $row['follower_name']?>&account=<?php echo $username?>"> <button class="btn btn-secondary"> Unfollow</button> </a></span>

            </div>
            <br>


          <?php } ?>
        </div>

      </div>
    </div>
  </div>


  <h3 class="text-secondary fw-normal text-center ">Your posts</h3>

  <div class="container  p-1" id="post">
    <?php

    if ($status == 0) {

      $sql = "SELECT * FROM image where username = '$username'";
      $res = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_assoc($res)) {
    ?>



        <img src="./uploads/<?php echo $data['post']; ?>" width="30%" height="10%" alt="" class="btn d-inline" data-bs-toggle="modal" data-bs-target="#<?php echo $data['username']; ?><?php echo $data['id']; ?>">

        <div class="modal fade" id="<?php echo $data['username']; ?><?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div>
                <img src="./profile_pics/<?php echo $pic ?>" class="m-2 text-start" alt="" style=" width: 50px; height: 50px; border-radius: 80px;">
                <span class="fs-5 text-start " id="exampleModalLabel"><?php echo $data['username']; ?> </span>
                <a href="delete.php?id=<?php echo $data['id']; ?>&category=0&post=<?php echo $data['post']; ?>" class="float-end me-2 mt-3 text-danger"> <i class="fa-solid fa-trash"></i></a>

              </div>



              <div class="modal-body">
                <img src="./uploads/<?php echo $data['post']; ?>" width="100%" height="100%" alt="">
                <br>
                &nbsp;
                <i class="fa-regular fa-heart text-danger fs-3"> </i> &nbsp;
                <span class="fs-4"><?php echo $data['likes']; ?> likes </span>

              </div>
            </div>
          </div>
        </div>





      <?php }
    } else if ($status == 1) {

      $sql = "SELECT * FROM club_pics where username = '$username'";
      $res = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_assoc($res)) {

      ?>
        <img src="./club_pics/<?php echo $data['post']; ?>" width="25%" height="10%" alt="" class="btn" data-bs-toggle="modal" data-bs-target="#<?php echo $data['username'][0]; ?><?php echo $data['id']; ?>">


        <div class="modal fade" id="<?php echo $data['username'][0]; ?><?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div>
                <img src="./profile_pics/<?php echo $pic ?>" class="m-2 text-start " alt="" style=" width: 50px; height: 50px; border-radius: 80px;">
                <span class="fs-5 text-start " id="exampleModalLabel"><?php echo $data['username']; ?> </span>
                <a href="delete.php?id=<?php echo $data['id']; ?>&category=1&post=<?php echo $data['post']; ?>" class="float-end me-2 mt-3 text-danger"> <i class="fa-solid fa-trash"></i></a>
              </div>

              <div class="modal-body">
                <img src="./club_pics/<?php echo $data['post']; ?>" width="100%" height="100%" alt="">
                <br>
                &nbsp;
                <i class="fa-regular fa-heart text-danger fs-3"> </i> &nbsp;
                <span class="fs-4"><?php echo $data['likes']; ?> likes </span>

              </div>
            </div>
          </div>
        </div>

    <?php }
    } ?>

  </div>


  <br><br> <br>
  <?php include('footer.php'); ?>


</body>

</html>