<?php


session_start();
include('config/connect.php');
$status = $_SESSION['is_club'];

$username = $_SESSION['name'];

$user = $name = $bio = $link = ' ';

if (isset($_POST['update'])) {

    $filename = $_FILES["uploadpic"]["name"];
    $tempname = $_FILES["uploadpic"]["tmp_name"];

    $folder  = './profile_pics/' . $filename;


    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($conn, $name);

    $user = stripslashes($_REQUEST['username']);
    $user = mysqli_real_escape_string($conn, $user);

    $bio = stripslashes($_REQUEST['bio']);
    $bio = mysqli_real_escape_string($conn, $bio);

    $link = stripslashes($_REQUEST['link']);
    $link = mysqli_real_escape_string($conn, $link);

    if ($status == 0) {

        $query = "UPDATE login SET pic = '$filename' WHERE username = '$username'";
        mysqli_query($conn, $query);

        move_uploaded_file($tempname, $folder);

        $query    = " UPDATE login SET bio = '$bio' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE login SET link = '$link' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE login SET name = '$name' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE followers SET account = '$user' WHERE account = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE followers SET follower_name = '$user' WHERE follower_name = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE image SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE saved_pics SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE saved_clubpics SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);



        $query = "UPDATE image_comments SET commenter = '$user' WHERE commenter = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE image_comments SET owner = '$user' WHERE owner = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE club_pics_comments SET commenter = '$user' WHERE commenter = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE club_pics_comments SET owner = '$user' WHERE owner = '$username'";
        $result   = mysqli_query($conn, $query);




        $query    = " UPDATE login SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);


        $_SESSION['name'] = $user;

        $url = "http://localhost/saveehub/viewprofile.php";
        header("Location: $url ");
    } else if ($status == 1) {

        $query = "UPDATE club SET pic = '$filename' WHERE club_name = '$username'";
        mysqli_query($conn, $query);

        move_uploaded_file($tempname, $folder);

        $query    = " UPDATE club SET bio = '$bio' WHERE  club_name = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE club SET link = '$link' WHERE  club_name = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE club SET name = '$name' WHERE  club_name = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE followers SET account = '$user' WHERE account = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE followers SET follower_name = '$user' WHERE follower_name = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE club_pics SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE saved_pics SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query    = " UPDATE saved_clubpics SET username = '$user' WHERE username = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE image_comments SET commenter = '$user' WHERE commenter = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE image_comments SET owner = '$user' WHERE owner = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE club_pics_comments SET commenter = '$user' WHERE commenter = '$username'";
        $result   = mysqli_query($conn, $query);

        $query = "UPDATE club_pics_comments SET owner = '$user' WHERE owner = '$username'";
        $result   = mysqli_query($conn, $query);


        $query    = "UPDATE club SET club_name = '$user' WHERE  club_name = '$username'";
        $result   = mysqli_query($conn, $query);


        $_SESSION['name'] = $user;

        $url = "http://localhost/saveehub/viewprofile.php";
        header("Location: $url ");
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include('header.php'); ?>

</head>

<body class="container mx-auto w-50 bg-dark">
    <br><br>


    <div class="p-3 card border border-secondary border-1 shadow">

        <h1 class="fs-3 text-center"> Edit Profile</h1>
        <form action="" method="POST" class="m-2" enctype="multipart/form-data">

            <div class=" mb-3 ">
                <label for="Profile" class="form-label "> Profile Pic: </label> <br>
                <input type="file" onChange="imagePreview(this)" name="uploadpic" id="uploadpic"
                    class="form-control border border-dark border-2" aria-describedby="inputGroupFileAddon04">
            </div>

            <br>

            <div id="preview" class="text-center"></div>

            <div class="mb-3 ">
                <label for="username" class="form-label "> Username/Clubname: </label>
                <input type="text" class="form-control shadow" id="username" name="username"
                    value="<?php echo $username ?>" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label"> Name: </label>
                <input type="text" class="form-control shadow" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label"> Bio: </label>
                <textarea class="form-control shadow" id="bio" name="bio" required> </textarea>
            </div>

            <div class="mb-3 ">
                <label for="link" class="form-label"> Add Link:</label>
                <input type="text" class="form-control shadow" id="link" name="link" required>
            </div>

            <div class="pt-3  text-center  w-100">
                <input type="submit" value="Update" id="update" name="update"
                    class="btn btn-light btn-outline-primary shadow-sm">
            </div>
        </form>
    </div>

</body>

<script>
function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function(event) {
            $('#preview').html('<img src="' + event.target.result + '" width="300" height="auto"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
    }
}
$("#image").change(function() {

    imagePreview(this);
});
</script>

</html>