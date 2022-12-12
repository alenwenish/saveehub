<?php

session_start();
include('config/connect.php');

$name = $email = $age = $number = $password = ' ';
$success = '';

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

    $check_query    = "SELECT no FROM login WHERE email='$email' AND username='$name'";

    $check_result   = mysqli_query($conn, $check_query);

    $rows = mysqli_num_rows($check_result);

    if ($rows == 1) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $success = 1;
    } else {
        $success = 0;
    }
}

$club_name = $club_email = $club_fc = $club_sc = $club_password = ' ';
if (isset($_POST['club_signup'])) {


    $club_email = stripslashes($_REQUEST['club_email']);
    $club_email = mysqli_real_escape_string($conn, $club_email);

    $club_name = stripslashes($_REQUEST['club_name']);
    $club_name = mysqli_real_escape_string($conn, $club_name);

    $club_sc = stripslashes($_REQUEST['club_sc']);
    $club_sc = mysqli_real_escape_string($conn, $club_sc);

    $club_password = stripslashes($_REQUEST['club_password']);
    $club_password = mysqli_real_escape_string($conn, $club_password);

    $club_fc = stripslashes($_REQUEST['club_fc']);
    $club_fc = mysqli_real_escape_string($conn, $club_fc);


    $query    = "INSERT INTO club (club_name, club_email, club_password , club_fc, club_sc)
    VALUES ('$club_name', '$club_email', '$club_password' , '$club_fc', '$club_sc')";

    $result   = mysqli_query($conn, $query);

    $check_query    = "SELECT id FROM club WHERE club_email='$club_email' AND club_name='$club_name'";
    $check_result   = mysqli_query($conn, $check_query);

    $rows = mysqli_num_rows($check_result);

    if ($rows == 1) {
        $_SESSION['name'] = $club_name;
        $_SESSION['email'] = $club_email;
        $success = 1;
    } else {
        $success = 0;
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php include('header.php') ?>

    <style>
        #signup_body {
            background-image: linear-gradient(to top, #080746, #003d7e, #0073aa, #00aaca, #57e2e2);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        #sign_up_card,
        #sign_up_club_card {
            /* border-radius: 100px 100px 100px 100px; */
            box-shadow: 0 0 40px 1px #48abe0;
            /* animation: shadows 5s infinite; */
            background: linear-gradient(180deg,
                    rgb(255, 255, 113, 0.5),
                    rgba(255, 255, 113, 0.5),
                    transparent 70%);
        }



        @keyframes shadows {
            0% {
                text-shadow: red 0 0 10px;
            }

            50% {
                text-shadow: blue 0 0 10px;
            }

            75% {
                text-shadow: green 0 0 10px;
            }

            100% {
                text-shadow: yellow 0 0 100px;
            }

        }

        #sign_up_club_card {
            display: none;
        }

        .custom-shape-divider-top-1670231206 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .custom-shape-divider-top-1670231206 svg {
            position: relative;
            display: block;
            width: calc(170% + 1.3px);
            height: 500px;
        }

        .custom-shape-divider-top-1670231206 .shape-fill {
            fill: lightcyan;
        }


        span {
            position: absolute;
            border-radius: 100vmax;
        }

        .top {
            top: 0;
            left: 0;
            width: 0;
            height: 10px;
            background: linear-gradient(90deg,
                    transparent 50%,
                    rgba(255, 49, 49, 0.5),
                    rgb(255, 49, 49));
        }

        .bottom {
            right: 0;
            bottom: 0;
            height: 10px;
            background: linear-gradient(90deg,
                    rgb(57, 255, 20),
                    rgba(57, 255, 20, 0.5),
                    transparent 50%);
        }

        .right {
            top: 0;
            right: 0;
            width: 10px;
            height: 0;
            background: linear-gradient(180deg,
                    transparent 30%,
                    rgba(0, 255, 255, 0.5),
                    rgb(0, 255, 255));
        }

        .left {
            left: 0;
            bottom: 0;
            width: 10px;
            height: 0;
            background: linear-gradient(180deg,
                    rgb(255, 255, 113),
                    rgba(255, 255, 113, 0.5),
                    transparent 70%);
        }

        .top {
            animation: animateTop 5s ease-in-out infinite;
        }

        .bottom {
            animation: animateBottom 5s ease-in-out infinite;
        }

        .right {
            animation: animateRight 5s linear 1;
        }

        .left {
            animation: animateLeft 5s ease-in-out 1;
        }

        @keyframes animateTop {
            25% {
                width: 100%;
                opacity: 1;
            }

            30%,
            100% {
                opacity: 0;
            }
        }

        @keyframes animateBottom {

            0%,
            50% {
                opacity: 0;
                width: 0;
            }

            75% {
                opacity: 1;
                width: 100%;
            }

            76%,
            100% {
                opacity: 0;
            }
        }

        @keyframes animateRight {

            0%,
            25% {
                opacity: 0;
                height: 0;
            }

            50% {
                opacity: 1;
                height: 100%;
            }

            55%,
            100% {
                height: 100%;
                opacity: 0;
            }
        }

        @keyframes animateLeft {

            0%,
            75% {
                opacity: 0;
                bottom: 0;
                height: 0;
            }

            100% {
                opacity: 1;
                height: 100%;
            }
        }

        .tilt-in-fwd-tr {
            -webkit-animation: tilt-in-fwd-tr 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: tilt-in-fwd-tr 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        @-webkit-keyframes tilt-in-fwd-tr {
            0% {
                -webkit-transform: rotateY(20deg) rotateX(35deg) translate(300px, -300px) skew(-35deg, 10deg);
                transform: rotateY(20deg) rotateX(35deg) translate(300px, -300px) skew(-35deg, 10deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                opacity: 1;
            }
        }

        @keyframes tilt-in-fwd-tr {
            0% {
                -webkit-transform: rotateY(20deg) rotateX(35deg) translate(300px, -300px) skew(-35deg, 10deg);
                transform: rotateY(20deg) rotateX(35deg) translate(300px, -300px) skew(-35deg, 10deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                opacity: 1;
            }
        }

        .tilt-in-fwd-tl {
            -webkit-animation: tilt-in-fwd-tl 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
            animation: tilt-in-fwd-tl 0.6s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
        }

        @-webkit-keyframes tilt-in-fwd-tl {
            0% {
                -webkit-transform: rotateY(-20deg) rotateX(35deg) translate(-300px, -300px) skew(35deg, -10deg);
                transform: rotateY(-20deg) rotateX(35deg) translate(-300px, -300px) skew(35deg, -10deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                opacity: 1;
            }
        }

        @keyframes tilt-in-fwd-tl {
            0% {
                -webkit-transform: rotateY(-20deg) rotateX(35deg) translate(-300px, -300px) skew(35deg, -10deg);
                transform: rotateY(-20deg) rotateX(35deg) translate(-300px, -300px) skew(35deg, -10deg);
                opacity: 0;
            }

            100% {
                -webkit-transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                transform: rotateY(0) rotateX(0deg) translate(0, 0) skew(0deg, 0deg);
                opacity: 1;
            }
        }
    </style>


</head>

<body id="signup_body">

    <div class="custom-shape-divider-top-1670231206">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
    </div>


    <div class="container  position-relative">
        <img src="./images/logo1.png" alt="logo" width="15%" height="30%" class="mx-auto  d-block">

        <div class="text-center m-2">
            <button class="btn btn-outline-dark" onclick=showUser() id="student_button"> Join as a Student</button>
            <button class="btn btn-outline-dark" onclick=showClub() id="club_button"> Join as a Club</button>
        </div>

        <br>
        <div class="tilt-in-fwd-tr card mb-3 w-50 mx-auto p-3 " id="sign_up_card">

            <h1 class="fs-2 text-center text-secondary"> <i class="fa-solid fa-user-plus"></i> New User </h1>



            <form action="" method="POST" class="m-2">
                <div class="mb-3 ">
                    <label for="name" class="form-label "> <i class="fa-solid fa-user"></i> Username: </label>
                    <input type="text" class="form-control shadow" id="name" name="name" required>
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
                    <label for="age" class="form-label text-white"> <i class="fa-solid fa-user-pen"></i> Age:</label>
                    <input type="number" class="form-control shadow" id="age" name="age" required>
                </div>

                <div class="mb-3 ">
                    <label for="number" class="form-label text-white"> <i class="fa-solid fa-phone"></i> Phone Number:</label>
                    <input type="text" class="form-control shadow" id="number" name="number">
                </div>

                <div class="pt-3  text-center  w-100">
                    <input type="submit" value="Register" id="Sign Up" name="signup" class="btn btn-light btn-outline-primary shadow-sm">
                </div>

                <div class="pt-3 pb-1 text-center  w-100">
                    <a href="login.php">Already a User? Log in</a>
                </div>
            </form>

            <span class="top"></span>
            <span class="right"></span>
            <span class="bottom"></span>
            <span class="left"></span>

        </div>


        <div class="tilt-in-fwd-tl card mb-3 w-50 mx-auto p-3 " id="sign_up_club_card">

            <h1 class="fs-2 text-center text-secondary"> <i class="fa-solid fa-user-plus"></i> New Club </h1>

            <form action="" method="POST" class="m-2">
                <div class="mb-3 ">
                    <label for="name" class="form-label "> <i class="fa-solid fa-user"></i> Club name: </label>
                    <input type="text" class="form-control shadow" id="club_name" name="club_name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"> <i class="fa-solid fa-envelope"></i> Club email: </label>
                    <input type="email" class="form-control shadow" id="club_email" name="club_email" placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3 ">
                    <label for="coord" class="form-label "> <i class="fa-solid fa-user-pen"></i> Student Coordinator:</label>
                    <input type="text" class="form-control shadow" id="club_sc" name="club_sc" required>
                </div>

                <div class="mb-3 ">
                    <label for="coord" class="form-label text-white"> <i class="fa-solid fa-user-pen"></i> Faculty Coordinator:</label>
                    <input type="text" class="form-control shadow" id="club_fc" name="club_fc">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-white"> <i class="fa-solid fa-lock"></i> Password: </label>
                    <input type="password" class="form-control shadow" id="club_password" name="club_password" required>
                </div>



                <div class="pt-3  text-center  w-100">
                    <input type="submit" value="Register" id="club Sign Up" name="club_signup" class="btn btn-light btn-outline-primary shadow-sm">
                </div>

                <div class="pt-3 pb-1 text-center  w-100">
                    <a href="login.php">Already a User? Log in</a>
                </div>
            </form>

            <span class="top"></span>
            <span class="right"></span>
            <span class="bottom"></span>
            <span class="left"></span>


        </div>

    </div>

    <script>
        var user = document.getElementById('sign_up_card');
        var club = document.getElementById('sign_up_club_card');

        function showUser() {
            user.style.display = "block";
            club.style.display = "none";
        }

        function showClub() {
            user.style.display = "none";
            club.style.display = "block";
        }

        var success = <?php echo $success ?>

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

        if (success == 1) {
            toastr.success("Registration Successful. <br> Log in with your email and password");
        } else if (success == 0) {
            toastr.error("Registration Failed. Try again");
        }
    </script>


</body>

</html>