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
        /* animation: shadows 2s infinite; */
    }

    /* @keyframes shadows {
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

        } */

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

    .bounce-in-top {
        -webkit-animation: bounce-in-top 1.1s both;
        animation: bounce-in-top 1.1s both;
    }

    @-webkit-keyframes bounce-in-top {
        0% {
            -webkit-transform: translateY(-500px);
            transform: translateY(-500px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
            opacity: 0;
        }

        38% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
            opacity: 1;
        }

        55% {
            -webkit-transform: translateY(-65px);
            transform: translateY(-65px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        72% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        81% {
            -webkit-transform: translateY(-28px);
            transform: translateY(-28px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        90% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        95% {
            -webkit-transform: translateY(-8px);
            transform: translateY(-8px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
    }

    @keyframes bounce-in-top {
        0% {
            -webkit-transform: translateY(-500px);
            transform: translateY(-500px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
            opacity: 0;
        }

        38% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
            opacity: 1;
        }

        55% {
            -webkit-transform: translateY(-65px);
            transform: translateY(-65px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        72% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        81% {
            -webkit-transform: translateY(-28px);
            transform: translateY(-28px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        90% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }

        95% {
            -webkit-transform: translateY(-8px);
            transform: translateY(-8px);
            -webkit-animation-timing-function: ease-in;
            animation-timing-function: ease-in;
        }

        100% {
            -webkit-transform: translateY(0);
            transform: translateY(0);
            -webkit-animation-timing-function: ease-out;
            animation-timing-function: ease-out;
        }
    }


    button {
        --primary-color: #6C6C74;
        --secondary-color: #fff;
        --hover-color: #111;
        --arrow-width: 10px;
        --arrow-stroke: 2px;
        box-sizing: border-box;
        border: 0;
        border-radius: 20px;
        color: var(--secondary-color);
        padding: 1em 1.8em;
        background: var(--primary-color);
        display: flex;
        transition: 0.2s background;
        align-items: center;
        gap: 0.6em;
        font-weight: bold;
    }

    button .arrow-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    button .arrow {
        margin-top: 1px;
        width: var(--arrow-width);
        background: var(--primary-color);
        height: var(--arrow-stroke);
        position: relative;
        transition: 0.2s;
    }

    button .arrow::before {
        content: "";
        box-sizing: border-box;
        position: absolute;
        border: solid var(--secondary-color);
        border-width: 0 var(--arrow-stroke) var(--arrow-stroke) 0;
        display: inline-block;
        top: -3px;
        right: 3px;
        transition: 0.2s;
        padding: 3px;
        transform: rotate(-45deg);
    }

    button:hover {
        background-color: var(--hover-color);
    }

    button:hover .arrow {
        background: var(--secondary-color);
    }

    button:hover .arrow:before {
        right: 0;
    }

    @media (min-width: 1100px) {


        #login_card {
            width: 600px;
        }
    }

    @media screen and (max-width: 1100px) and (min-width: 200px) {

        #login_card {
            width: 350px
        }
    }
    </style>

</head>

<body id="login_body">

    <!-- 5Zs|17Tiia-@w9&c

    id20024342_saveetha
    id20024342_root -->

    <div class="custom-shape-divider-bottom-1670230400">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path
                d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z"
                class="shape-fill"></path>
        </svg>
    </div>

    <div class="container position-relative">
        <br>
        <img src="./images/logo1.png" alt="logo" width="30%" height="30%" class="mx-auto  d-block ">
        <br>

        <div class="bounce-in-top card mb-3  mx-auto p-3 border-secondary" id="login_card">

            <h1 class="fs-1 text-center text-white"> Login </h1>

            <form action="" method="POST" class="m-2">


                <div class="mb-3">
                    <label for="email" class="form-label text-white"> <i class="fa-solid fa-envelope"></i> Email:
                    </label>
                    <input type="email" class="form-control shadow" id="email" name="email"
                        placeholder="example@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-white"> <i class="fa-solid fa-lock"></i> Password:
                    </label>
                    <input type="password" class="form-control shadow" id="password" name="password" required>
                </div>


                <div class="pt-3  text-center  w-100">

                    <button type="submit" id="login" name="login" class="mx-auto"> Login
                        <div class="arrow-wrapper">
                            <div class="arrow"></div>
                        </div>
                    </button>

                </div>

                <div class="pt-3 pb-1 text-center  w-100">
                    <a href="index.php">New User? Register Now !!!</a> <br>
                    <a href="forgotpassword.php"> Forgot Password ? </a>
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