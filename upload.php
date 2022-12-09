<?php


session_start();
include('config/connect.php');

$status = $_SESSION['is_club'];
$username = $_SESSION['name'];

$success = $caption = ' ';

if (isset($_POST['upload'])) {


    $caption = stripslashes($_REQUEST['caption']);
    $caption = mysqli_real_escape_string($conn, $caption);

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];

    if ($status == 0) {

        $folder  = './uploads/' . $filename;
        $query = "INSERT INTO image(username,post,caption) VALUES ('$username', '$filename','$caption')";

        mysqli_query($conn, $query);

        if (move_uploaded_file($tempname, $folder)) {
            $success = 1;
        } else {
            $success = 0;
        }
    } else if ($status == 1) {

        $folder  = './club_pics/' . $filename;
        $query = "INSERT INTO club_pics(username,post,caption) VALUES ('$username', '$filename','$caption')";
        $query;
        mysqli_query($conn, $query);

        if (move_uploaded_file($tempname, $folder)) {
            $success = 1;
        } else {
            $success = 0;
        }
    }
}






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Post</title>
    <?php include('header.php'); ?>

</head>

<body class="container mx-auto w-50 bg-dark">
    <br><br>


    <div class="p-3 card border border-secondary border-1 shadow">

        <h1 class="fs-3 text-center"> Upload Post</h1>
        <form action="" method="POST" class="m-2" enctype="multipart/form-data">

            <div class=" mb-3 ">
                <label for="Profile" class="form-label "> Post pic : </label> <br>
                <input type="file" name="uploadfile" id="uploadfile" onChange="imagePreview(this)"  class="form-control border border-dark border-2" aria-describedby="inputGroupFileAddon04">
            </div>

            <br>

            <div id="preview" class="text-center"></div>

            <br>

            <div class="mb-3 ">

                <input type="text" class="form-control shadow" id="caption" name="caption" placeholder="Write a caption..." required>
            </div>


            <div class="pt-3  text-center  w-100">
                <input type="submit" value="Upload" id="upload" name="upload" class="btn btn-light btn-outline-primary shadow-sm">
            </div>
        </form>
    </div>

    <br>

    <a href="viewprofile.php" class="text-light text-decoration-none fs-3"><i class="fa-solid fa-arrow-left"></i> Back</a>

</body>


<script>
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
        toastr.success("Post uploaded - Successfully");
    } else if (success == 0) {
        toastr.error("Post uploaded - Failed");
    }

    
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