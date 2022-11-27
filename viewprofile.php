<?php

session_start();
include('config/connect.php');

$username = $_SESSION['name'];
if(isset($_POST['file_submit'])){

  $filename = $_FILES["uploadfile"]["name"];
 
  $tempname = $_FILES["uploadfile"]["tmp_name"];


  $folder  = './uploads/'.$filename;

  $query = "INSERT INTO image(username,post) VALUES ('$username', '$filename')";
  mysqli_query($conn, $query);

  if(move_uploaded_file($tempname,$folder)){
    echo 'POST UPLOADED SUCCESSFULLY';
  }else{
    echo 'POST UPLOAD FAILED';
  }
  
}


$sql = "SELECT count(follower_name) as following FROM followers WHERE account = '$username'";
$res = mysqli_query($conn,$sql);
$following = $res->fetch_array()['following'];


$sql = "SELECT count(follower_name) as follower FROM followers WHERE follower_name = '$username'";
$res = mysqli_query($conn,$sql);
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
         #view_profile{
          background-image: linear-gradient(to bottom, #e2f0f0, #e5f3f3, #e8f6f6, #ecf9f9, #effcfc);
          background-repeat: no-repeat;
          background-attachment: fixed;
        }
    </style>
</head>

<body id="view_profile">

<div class="row">
      <div class="text-center col-4">
        <h1 style="font-size:108px"> <i class="fa-regular fa-user"></i>  </h1>
        <p class="fs-3 fw-bold"> <?php echo  $_SESSION['name'] ?> </p>
      </div>

      <div class="col-8">
      <div class="row text-center pt-3 pe-3 mx-auto">
        <div class="col bg-dark text-warning fw-bolder card m-1 p-2 shadow">
            <h4> Followers </h4>
            <h5> <?php echo $follower; ?> </h5>
        </div>
        <div class="col card bg-dark text-warning fw-bolder m-1 p-2 shadow">
            <h4> Following </h4>
            <h5> <?php echo $following; ?> </h5>
        </div>
      </div>
      </div>
</div>

<div class="w-50 m-auto">
  <form action="" method="POST"  enctype="multipart/form-data">
      <div class="input-group">
        <input type="file" name="uploadfile" id="uploadfile" class="form-control border border-dark border-2"  aria-describedby="inputGroupFileAddon04" >
        <button class="btn btn-outline-success" type="submit" name="file_submit" id="inputGroupFileAddon04">Upload</button>
      </div>
  </form>
</div>
<br><br>
<div class="container  p-1">


  <?php
  $sql = "SELECT * FROM image where username = '$username'";
  $res = mysqli_query($conn,$sql);
  while($data = mysqli_fetch_assoc($res)) {
    
  ?>
  
  <img src="./uploads/<?php echo $data['post']; ?>" width="15%" height="10%" alt="">
  
  <?php } ?>

</div>

    
<br><br>
    <?php include('footer.php'); ?>
</body>
</html>