<?php

session_start();
include('config/connect.php');


$username = $_SESSION['name'];
$id = $_GET['id'];
$owner = $_GET['owner'];

$comment = '';
if (isset($_POST['post'])) {
    $comment = stripslashes($_REQUEST['comment']);
    $comment = mysqli_real_escape_string($conn, $comment);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Comments</title>
    <?php include('header.php') ?>
</head>

<body>
    <?php include('navigation.php'); ?>

    <div>
        
        <form action="" method="POST" class="d-flex justify-content-center">
            <label for="comment" class="form-label">
                <?php if ($pic == '') {  ?>
                    <i class="fa-regular fa-user"></i>
                <?php } else { ?>
                    <img src="./profile_pics/<?php echo $pic ?>" class="pt-2" alt="" id="profile_pic">
                <?php } ?>
            </label> &nbsp;
            <input type="text" class="form-control w-25" name="comment" id="comment" placeholder="Add a comment..."> &nbsp;
            <button type="submit" class="btn btn-secondary" name="post" id="post">Post</button>
        </form>
    </div>


</body>

</html>