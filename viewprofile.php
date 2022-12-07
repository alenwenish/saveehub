<?php

session_start();
include('config/connect.php');
$status = $_SESSION['is_club'];


$username = $_SESSION['name'];
$name = $bio = $link = $pic = '';

if (isset($_POST['file_submit'])) {

  $filename = $_FILES["uploadfile"]["name"];
  $tempname = $_FILES["uploadfile"]["tmp_name"];


  if ($status == 0) {

    $folder  = './uploads/' . $filename;
    $query = "INSERT INTO image(username,post) VALUES ('$username', '$filename')";
    mysqli_query($conn, $query);

    if (move_uploaded_file($tempname, $folder)) {
      echo 'POST UPLOADED SUCCESSFULLY';
    } else {
      echo 'POST UPLOAD FAILED';
    }

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

  } else if ($status == 1) {

    $folder  = './club_pics/' . $filename;
    $query = "INSERT INTO club_pics(username,post) VALUES ('$username', '$filename')";
    mysqli_query($conn, $query);

    if (move_uploaded_file($tempname, $folder)) {
      echo 'POST UPLOADED SUCCESSFULLY';
    } else {
      echo 'POST UPLOAD FAILED';
    }

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
  }
}


$sql = "SELECT count(follower_name) as following FROM followers WHERE account = '$username'";
$res = mysqli_query($conn, $sql);
$following = $res->fetch_array()['following'];


$sql = "SELECT count(follower_name) as follower FROM followers WHERE follower_name = '$username'";
$res = mysqli_query($conn, $sql);
$follower = $res->fetch_array()['follower'];


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
      /* background-image: linear-gradient(to bottom, #e2f0f0, #e5f3f3, #e8f6f6, #ecf9f9, #effcfc); */
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
      border: 2px solid black;
      margin: 20px;
      border-radius: 20em 1em 40em / 5em 30em;
      background-image: linear-gradient(to bottom, #292f2f, #3b4141, #4f5454, #636868, #787d7d);
      /* background-image: linear-gradient(to bottom, #76e3e9, #8de5ea, #a1e7ea, #b3e9eb, #c4ebec); */
      box-shadow: 0 0 10px 1px black;
    }

    #followers,
    #following {
      background-image: linear-gradient(to bottom, #656d6d, #525959, #3f4646, #2e3434, #1d2323);
    }
  </style>
</head>

<body id="view_profile">

  <div class="row p-2" id="box1">
    <div class="text-center col-4 text-warning ">

      <?php if ($pic == '') {  ?>
        <h1 style="font-size:72px"> <i class="fa-regular fa-user"></i> </h1>
      <?php } else { ?>
        <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
      <?php } ?>

      <p class="fs-3 fw-bold"> <?php echo  $_SESSION['name'] ?> </p>

      <div class="text-center">
        <spam class="fw-bolder"> <?php echo $name; ?></spam> <br>
        <spam><?php echo $bio; ?></spam> <br>
        <a href="<?php echo $link ?>" class="text-white"> <?php echo $link; ?> </a>

      </div>
      <br>
    </div>

    <div class="col-8">
      <div class="row text-center pt-3 pe-3 mx-auto">

        <button class="col text-warning rounded-pill fw-bolder fs-4 m-1 p-2 shadow" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal" id="followers">
          Followers <br>
          <?php echo $follower; ?>
        </button>

        <button class="col text-warning rounded-pill fw-bolder fs-4 m-1 p-2 shadow" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal1" id="following">
          Following <br>
          <?php echo $following; ?>
        </button>

      </div>

      <br>
      <button class="btn btn-warning text-center mx-auto d-block w-75 " data-bs-toggle="modal" data-bs-target="#exampleModal2"> <a href="editprofile.php" class="text-decoration-none text-dark"> Edit Profile </a> </button>
      <br>

      <div class="w-75 m-auto">

        <form action="" method="POST" enctype="multipart/form-data">
          <div class="input-group mb-1">
            <input type="file" name="uploadfile" id="uploadfile" class="form-control border border-dark border-2" aria-describedby="inputGroupFileAddon04">
            <button class="btn btn-warning" type="submit" name="file_submit" id="inputGroupFileAddon04">Upload</button>
          </div>
        </form>
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
        <div class="modal-body">

          <?php
          $query = "SELECT account from followers where follower_name = '$username'";
          $result = mysqli_query($conn, $query);
          $rows = array();
          while ($row = mysqli_fetch_array($result))
            $rows[] = $row;
          ?>

          <?php foreach ($rows as $row) { ?>
            <h6 class="p-1 card text-center text-secondary "> <?php echo $row['account']; ?> </h6> <br>
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
            <h6 class="p-1 card text-center text-secondary "> <?php echo $row['follower_name']; ?> </h6> <br>
          <?php } ?>
        </div>

      </div>
    </div>
  </div>


  <h3 class="text-secondary fw-normal text-center ">Your posts</h3>

  <div class="container  p-1">
    <?php

    if ($status == 0) {

      $sql = "SELECT * FROM image where username = '$username'";
      $res = mysqli_query($conn, $sql);
      while ($data = mysqli_fetch_assoc($res)) {
    ?>


        <img src="./uploads/<?php echo $data['post']; ?>" width="30%" height="10%" alt="" class="btn" data-bs-toggle="modal" data-bs-target="#<?php echo $data['username']; ?><?php echo $data['id']; ?>">


        <div class="modal fade" id="<?php echo $data['username']; ?><?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">

              <div class="modal-header">
                <img src="./profile_pics/<?php echo $pic ?>" class="pt-2 " alt="" style=" width: 50px; height: 50px; border-radius: 80px;"> &nbsp; &nbsp;
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $data['username']; ?> </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
        <img src="./club_pics/<?php echo $data['post']; ?>" width="15%" height="10%" alt="">

    <?php }
    } ?>

  </div>












  <br><br> <br>
  <?php include('footer.php'); ?>
</body>

</html>