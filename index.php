<?php

session_start();
include('config/connect.php');



$name = $email = $age = $number = $password = ' ';
if (isset($_POST['signup'])) {

    
    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($conn, $name);

    $age = stripslashes($_REQUEST['age']);
    $age = mysqli_real_escape_string($conn, $age);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);

    $number = stripslashes($_REQUEST['number']);
    $number = mysqli_real_escape_string($conn, $number);

    
    $query    = "INSERT INTO login (username,email,password,age,number)
    VALUES ('$name', '$email', '$password' , '$age', '$number')"; 
   
    $result   = mysqli_query($conn, $query);

    $check_query    = "SELECT no FROM login WHERE email='$email' AND usename='$name'";   
    $check_result   = mysqli_query($conn, $check_query);

    $rows = mysqli_num_rows($check_result);
  
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
        #signup_body{
          background-image: linear-gradient(to bottom, #ace6e9, #3bbee0, #0092de, #0061d2, #0821ac);
          background-repeat: no-repeat;
          background-attachment: fixed;
        }
        #sign_up_card{
            border-radius: 10px 100px 10px 100px;
        }
    </style>
   
    
</head>
<body id="signup_body">
    <div class="container">
        <img src="./images/logo1.png" alt="logo" width="40%" height="30%" class="mx-auto  d-block">
        <div class="card mb-3 w-50 mx-auto p-3 border-secondary shadow-lg" id="sign_up_card">
            
            <h1 class="fs-1 text-center text-secondary"> <i class="fa-solid fa-user-plus"></i> New User </h1> 
            
            <form action="" method="POST" class="m-2">
                <div class="mb-3 ">
                    <label for="name" class="form-label ">  <i class="fa-solid fa-user"></i> Username: </label>
                    <input type="text" class="form-control shadow" id="name" name="name"  required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"> <i class="fa-solid fa-envelope"></i> Email: </label>
                    <input type="email" class="form-control shadow" id="email" name="email" placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label"> <i class="fa-solid fa-lock"></i> Password: </label>
                    <input type="password" class="form-control shadow" id="password" name="password" required>
                </div>

                <div class="mb-3 ">
                    <label for="age" class="form-label"> <i class="fa-solid fa-user-pen"></i> Age:</label>
                    <input type="number" class="form-control shadow" id="age" name="age"  required>
                </div>

                <div class="mb-3 ">
                    <label for="number" class="form-label"> <i class="fa-solid fa-phone"></i> Phone Number:</label>
                    <input type="text" class="form-control shadow" id="number" name="number" >
                </div>

                <div class="pt-3  text-center  w-100">
                    <input type="submit" value="Register" id="Sign Up" name="signup" class="btn btn-light btn-outline-primary shadow-sm">
                </div>

                <div class="pt-3 pb-1 text-center  w-100">
                    <a href="login.php">Already a User? Log in</a>
                </div>
            </form>

        </div>
    </div>
    
   
</body>
</html>