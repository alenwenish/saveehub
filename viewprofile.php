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

        <button class="col bg-dark text-warning fw-bolder fs-4 m-1 p-2 shadow" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Followers <br>
           <?php echo $follower; ?> 
        </button>

        <div class="col bg-dark text-warning fw-bolder fs-4 m-1 p-2 shadow" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal1">
            Following <br>
            <?php echo $following; ?> 
        </div>

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
        $result = mysqli_query($conn,$query);
        $rows = array();
        while($row = mysqli_fetch_array($result))
              $rows[] = $row;
        ?>
       
        <?php foreach($rows as $row) { ?>
          <h6 class="p-1 card text-center text-secondary ">  <?php echo $row['account']; ?> </h6> <br>
        <?php } ?>

        
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
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
        $result = mysqli_query($conn,$query);
        $rows = array();
        while($row = mysqli_fetch_array($result))
              $rows[] = $row;
        ?>
       
        <?php foreach($rows as $row) { ?>
          <h6 class="p-1 card text-center text-secondary ">  <?php echo $row['follower_name']; ?> </h6> <br>
        <?php } ?>

      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->


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