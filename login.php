<?php

session_start();
include('config/connect.php');



$name = $email =  $password = ' ';
if (isset($_POST['login'])) {

    
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    
    $query    = "SELECT username FROM login WHERE email='$email' AND  password='$password'"; 
    $result   = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);
  
    $name = $result->fetch_array()['username'];

    if ($rows == 1) {
        $_SESSION['name'] = $name; 
        $_SESSION['email'] = $email;
        header("Location: home.php");
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Login</title>
    <?php include('header.php') ?>
    <style>
        #login_body{
          background-image: linear-gradient(to bottom, #ace6e9, #3bbee0, #0092de, #0061d2, #0821ac);
          background-repeat: no-repeat;
          background-attachment: fixed;
        }
        #login_card{
            border-radius: 100px 10px 100px 10px;
        }
    </style>
   
    
</head>
<body id="login_body">
    <div class="container">
        <img src="./images/logo1.png" alt="logo" width="40%" height="30%" class="mx-auto  d-block">
        <div class="card mb-3 w-50 mx-auto p-3 border-secondary shadow-lg" id="login_card">
            
            <h1 class="fs-1 text-center text-secondary"> Login </h1> 
            
            <form action="" method="POST" class="m-2">
               
                <div class="mb-3">
                    <label for="email" class="form-label"> <i class="fa-solid fa-envelope"></i> Email: </label>
                    <input type="email" class="form-control shadow" id="email" name="email" placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label"> <i class="fa-solid fa-lock"></i> Password: </label>
                    <input type="password" class="form-control shadow" id="password" name="password" required>
                </div>

                
                <div class="pt-3  text-center  w-100">
                    <input type="submit" value="Login" id="login" name="login" class="btn btn-light btn-outline-primary shadow-sm">
                </div>

                <div class="pt-3 pb-1 text-center  w-100">
                    <a href="index.php">New User? Register Now !!!</a>
                </div>
            </form>

        </div>
    </div>
    
   
</body>
</html>