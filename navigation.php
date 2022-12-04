
<style>
 #profile_pic{
          width: 60px;
          height : 60px;
          border-radius : 80px;
          
        }

</style>
<?php

$pic= '';

$sql = "SELECT pic FROM login where username = '$username'";
$res = mysqli_query($conn,$sql);
$pic = $res->fetch_array()['pic'];

?>

<div>
  
<nav class="navbar navbar-expand-sm shadow  navbar-inverse navbar-fixed-top  navbar-dark " style="background-color:#F5FCFF">

<a class="nav-link text-black float-start text-warning fs-2 ps-4" href="">
    


<?php if($pic == '') {  ?>
    <i class="fa-regular fa-user"></i> 
      <?php }else{ ?>
        <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
      <?php } ?>
      


<?php echo  $_SESSION['name'] ?> </a>

<img src="images/logo1.png"  class="d-block mx-auto" width="120px" height = "10%" >
<a class="nav-link text-black float-end text-warning fs-3" href="logout.php">  <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
   
</nav>
</div>