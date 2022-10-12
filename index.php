<?php

session_start();
include('config/connect.php');



$email = $p_id= $p_name = '';
$err='';
if (isset($_POST['login'])) {

    
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $p_id = stripslashes($_REQUEST['p_id']);
    $p_id = mysqli_real_escape_string($conn, $p_id);

    $p_name = stripslashes($_REQUEST['p_name']);
    $p_name = mysqli_real_escape_string($conn, $p_name);

    // echo $p_id;
    // echo $p_name;
    // echo $email;
    
    $query    = "SELECT * FROM patients WHERE p_email='$email' AND p_id='$p_id' AND p_name='$p_name'";   
    $result   = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
    
    if ($rows == 1) {
        $_SESSION['p_id'] = $p_id; 
        header("Location: data.php");
    } else {
        $err = "Email Id/Password is incorrect, Try Again !!!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Login</title>
    <?php include('header.php') ?>
    <style>
        
    </style>
   
    
</head>
<body id="login_body">
    

    <div class="card w-75  mb-2 m-auto border border-2 shadow-lg" style="background-color:#F5FCFF">
       
    <h1 class="text-secondary text-center fs-1 pt-2">Login</h1>

       
        <img src="image/medtrons_logo.jpg"  class="m-auto rounded-circle p-2" alt=""  srcset="" style="width:100px; height:100px;">
        <form action="" method="POST">

        <div class="ms-3 me-3 ">

            <div class="mb-3 ">
                <label for="p_id" class="form-label "> <i class="fa-solid fa-image-portrait"></i> ID:</label>
                <input type="text" class="form-control shadow" id="p_id" name="p_id"  placeholder="Enter your ID..." required>
              </div>
            <div class="mb-3 ">
                <label for="p_name" class="form-label"> <i class="fa-solid fa-user"></i> Name:</label>
                <input type="text" class="form-control shadow" id="p_name" name="p_name" 
                 placeholder="Enter your Name..." required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"> <i class="fa-solid fa-envelope"></i> Email: </label>
                <input type="email" class="form-control shadow" id="email" name="email"
                 placeholder="Enter your Email..." required>
            </div>

            <div class="pt-3  text-center  w-100">
                 <input type="submit" value="Login" id="login" name="login" class="btn btn-light btn-outline-primary shadow-sm">
            </div>

            <div class="pt-3 pb-3 text-center  w-100">
                <a href="register.php">New user? Sign up</a>
             </div>

        </div>

        </form>
        


    </div>

    
   
</body>
</html>