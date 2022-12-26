<?php


session_start();
include('config/connect.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './vendor/autoload.php';
$mail = new PHPMailer(true);

$error =  '';
$isShow = 0;
if (isset($_POST['sent_email'])) {

    $_SESSION['email'] = stripslashes($_REQUEST['email']);
    $_SESSION['email'] = mysqli_real_escape_string($conn, $_SESSION['email']);

    $email = $_SESSION['email'];
        
    $query    = "SELECT club_email FROM club WHERE club_email='$email'";
    $result   = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result)) {
        $_SESSION['status'] = 1;
        $error = '';
    }

    $query    = "SELECT email FROM login WHERE email='$email'";
    $result   = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result)) {
        $_SESSION['status']  = 2;
        $error = '';
    }

    if ($_SESSION['status']  == '') {
        $error = "User not exists. Create a new account ";
    } else {
        $_SESSION['otp'] = rand(100000, 999999);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '';                     //SMTP username
        $mail->Password   = '';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->setFrom('', 'Admin - Saveehub');
        $mail->addAddress($email, 'User');     //Add a recipient

        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Saveehub Forgot password -OTP';
        $mail->Body    = "<h1> The OTP to change your password - " . $_SESSION['otp'] . "</h1>";

        $mail->send();
        $isShow = 1;
    }
}

$pin1 = $pin2 = $pin3 = $pin4 = $pin5 = $pin6 = $password = $reenter_password = $pin = '';
if (isset($_POST['reset_email'])) {

    $pin1 = stripslashes($_REQUEST['pin-1']);
    $pin1 = mysqli_real_escape_string($conn, $pin1);

    $pin2 = stripslashes($_REQUEST['pin-2']);
    $pin2 = mysqli_real_escape_string($conn, $pin2);

    $pin3 = stripslashes($_REQUEST['pin-3']);
    $oin3 = mysqli_real_escape_string($conn, $pin3);

    $pin4 = stripslashes($_REQUEST['pin-4']);
    $pin4 = mysqli_real_escape_string($conn, $pin4);

    $pin5 = stripslashes($_REQUEST['pin-5']);
    $pin5 = mysqli_real_escape_string($conn, $pin5);

    $pin6 = stripslashes($_REQUEST['pin-6']);
    $pin6 = mysqli_real_escape_string($conn, $pin6);

    $pin = $pin1 . $pin2 . $pin3 . $pin4 . $pin5 . $pin6;

    if ($pin == $_SESSION['otp']) {

        $password = stripslashes($_REQUEST['new_password']);
        $password = mysqli_real_escape_string($conn, $password);

        $reenter_password = stripslashes($_REQUEST['reenter_new_password']);
        $reenter_password = mysqli_real_escape_string($conn, $reenter_password);


        if ($password == $reenter_password) {

            $email = $_SESSION['email'];

            if ($_SESSION['status']  == 2) {

                $query    = " UPDATE login SET password = '$password' WHERE email = '$email'";
                $result   = mysqli_query($conn, $query);
                
            } else if ($_SESSION['status']  == 1) {

                $query    = " UPDATE club SET club_password = '$password' WHERE  club_email = '$email'";
                $result   = mysqli_query($conn, $query);
            }

            $isShow = 1;
            $error = "Password Changed Successfully. Log in";
            session_destroy();
        } else {
            $isShow = 1;
            $error = "New password and Re-enter new password must be same";
        }
    } else {
        $isShow = 1;
        $error = "You have entered a Wrong OTP";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Forgot Password</title>
    <?php include('header.php') ?>

    <style>
    #reset_form {
        display: none;
    }

    #email_form {
        display: block;
    }

    #otp-body {

        justify-content: center;
    }

    #otp-body input {
        width: 80px;
        height: 80px;
        margin: 10px;
        text-align: center;
        font-size: 30px;
        border: 3px red solid;
        border-radius: 10px;
    }

    #otp-body input[type=text]:focus {
        background-color: #0C0C44;
        color: whitesmoke;
        border: 2px solid white;
        box-shadow: 3px 3px 5px 1px yellow;
    }
    </style>



</head>

<body>
    <div class=" p-1" id="email_form">
        <h3 class="fs-1 text-center fw-bolder text-secondary pt-3"> Forgot Password</h3>
        <p class="fs-6 text-center fw-normal text-dark"> Enter your email and we will sent you a OTP pin to reset your
            password</p>

        <form action="" method="POST" class="w-50 mx-auto card p-4 border">

            <p class="text-danger text-center  fs-6"> <?php echo $error; ?></p>
            <label for="email" class="form-label"> <i class="fa-solid fa-envelope"></i> Email: </label>
            <input type="email" class="form-control " id="email" name="email" placeholder="example@gmail.com" required>

            <div class="text-center pt-4">
                <input type="submit" value="Sent Email" class="btn btn-primary" name="sent_email">
            </div>
        </form>
    </div>

    <div id="reset_form">
        <br>
        <h3 class="fs-1 text-center fw-bolder text-secondary pt-3"> Forgot Password</h3>
        <form action="" class="w-50 mx-auto card p-4 border" method="POST">


            <p class="text-danger text-center  fs-6"> <?php echo $error; ?></p>

            <label for="" class="form-label"> <i class="fa-solid fa-lock"></i> Enter OTP : </label>
            <div class="d-flex m-1 p-1" id="otp-body">
                <input type="text" class="form-control" name="pin-1" id="pin-one" maxlength="1"
                    onkeyup="movetoNext('pin-one',this, 'pin-two')" onchange="changeBorder('pin-one',this)" required>
                <input type="text" class="form-control" name="pin-2" id="pin-two" maxlength="1"
                    onkeyup="movetoNext('pin-one',this, 'pin-three')" onchange="changeBorder('pin-two',this)" required>
                <input type="text" class="form-control" name="pin-3" id="pin-three" maxlength="1"
                    onkeyup="movetoNext('pin-two',this, 'pin-four')" onchange="changeBorder('pin-three',this)" required>
                <input type="text" class="form-control" name="pin-4" id="pin-four" maxlength="1"
                    onkeyup="movetoNext('pin-three',this, 'pin-five')" onchange="changeBorder('pin-four',this)"
                    required>
                <input type="text" class="form-control" name="pin-5" id="pin-five" maxlength="1"
                    onkeyup="movetoNext('pin-four',this, 'pin-six')" onchange="changeBorder('pin-five',this)" required>
                <input type="text" class="form-control" name="pin-6" id="pin-six" maxlength="1"
                    onkeyup="movetoNext('pin-five',this, 'pin-six')" onchange="changeBorder('pin-six',this)" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label "> <i class="fa-solid fa-lock"></i> New password :
                </label>
                <input type="password" class="form-control" id="password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label "> <i class="fa-solid fa-lock"></i> Re-enter new password :
                </label>
                <input type="password" class="form-control" id="password" name="reenter_new_password" required>
            </div>

            <div class="text-center pt-1">
                <input type="submit" value="Reset" class="btn btn-primary" name="reset_email">
            </div>
        </form>
    </div>


</body>

<script>
var isShow = <?php echo $isShow; ?>;
console.log(isShow);
if (isShow == 1) {
    document.getElementById('email_form').style.display = "none";
    document.getElementById('reset_form').style.display = "block";
}


function movetoNext(prevField, current, nextFieldID) {
    if (current.value.length >= current.maxLength) {
        document.getElementById(nextFieldID).focus();
    } else {
        document.getElementById(prevField).focus();
    }
}

function changeBorder(id, current) {
    if (current.value.length < 1) {
        document.getElementById(id).style.border = "3px solid red";
    } else {
        document.getElementById(id).style.border = "3px solid darkgreen";
    }
}
</script>

</html>