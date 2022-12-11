<?php


session_start();
include('config/connect.php');

$name = $email =  $password = $fail = ' ';
if (isset($_POST['login'])) {


    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);


    $query    = "SELECT username FROM login WHERE email='$email' AND  password='$password'";
    $result   = mysqli_query($conn, $query);
    $rows = mysqli_num_rows($result);


    $query1    = "SELECT club_name FROM club WHERE club_email='$email' AND  club_password='$password'";
    $result1   = mysqli_query($conn, $query1);
    $rows1 = mysqli_num_rows($result1);



    if ($rows == 1) {
        echo 'done';
        $name = $result->fetch_array()['username'];
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['is_club'] = 0;
        header("Location: home.php");
    } else if ($rows1 == 1) {
        $name1 = $result1->fetch_array()['club_name'];
        $_SESSION['name'] = $name1;
        $_SESSION['email'] = $email;
        $_SESSION['is_club'] = 1;
        header("Location: home.php");
    } else {
        $fail = 1;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>


    <title>Login</title>

    <?php include('header.php') ?>

    <style>
        #login_body {
            background-image: linear-gradient(to top, #121414, #1e2021, #2b2d2d, #383b3b, #454949);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        #login_card {
            border-radius: 100px 100px 100px 100px;
            box-shadow: 0 0 50px 1px black;

            border: 2px solid gold;

            background: linear-gradient(90deg,
                    transparent 70%,

                    #009999);
            animation: shadows 2s infinite;
        }

        @keyframes shadows {
            0% {
                text-shadow: gold 0 0 10px;
            }

            50% {
                text-shadow: goldenrod 0 0 10px;
            }

            75% {
                text-shadow: darkorange 0 0 10px;
            }

            100% {
                text-shadow: yellow 0 0 100px;
            }

        }

        .custom-shape-divider-bottom-1670230400 {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }

        .custom-shape-divider-bottom-1670230400 svg {
            position: relative;
            display: block;
            width: calc(153% + 1.3px);
            height: 500px;
        }

        .custom-shape-divider-bottom-1670230400 .shape-fill {
            fill: #A5D5F3;
        }
    </style>


</head>

<body id="login_body">

    <div class="custom-shape-divider-bottom-1670230400">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
    </div>

    <div class="container position-relative">
        <br>
        <img src="./images/logo1.png" alt="logo" width="40%" height="30%" class="mx-auto  d-block ">
        <br>

        <div class="card mb-3 w-50 mx-auto p-3 border-secondary" id="login_card">

            <h1 class="fs-1 text-center text-white"> Login </h1>

            <form action="" method="POST" class="m-2">


                <div class="mb-3">
                    <label for="email" class="form-label text-white"> <i class="fa-solid fa-envelope"></i> Email: </label>
                    <input type="email" class="form-control shadow" id="email" name="email" placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-white"> <i class="fa-solid fa-lock"></i> Password: </label>
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

<script>
    var fail = <?php echo $fail ?>

    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    if (fail == 1) {
        toastr.error("Invalid credentials. Try again");
    }
</script>

</html>