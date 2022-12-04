<?php

$username = $name = $bio = $link = ' ';

if (isset($_POST['update'])) {

    $name = stripslashes($_REQUEST['name']);
    $name = mysqli_real_escape_string($conn, $name);

    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($conn, $username);

    $bio = stripslashes($_REQUEST['bio']);
    $bio = mysqli_real_escape_string($conn, $bio);

    $link = stripslashes($_REQUEST['link']);
    $link = mysqli_real_escape_string($conn, $link);

    $query    = " UPDATE login SET bio = '$bio' WHERE username = '$username'"; 
    $result   = mysqli_query($conn, $query);

    $query    = " UPDATE login SET link = '$link' WHERE username = '$username'"; 
    $result   = mysqli_query($conn, $query);

    $query    = " UPDATE login SET name = '$name' WHERE username = '$username'"; 
    $result   = mysqli_query($conn, $query);

    $query    = " UPDATE login SET username = '$username' WHERE username = '$username'"; 
    $result   = mysqli_query($conn, $query);

    $_SESSION['name'] = $username;    
}

?>

<form action="" method="POST" class="m-2">

    <div class=" mb-3 ">
        <label for="Profile" class="form-label "> Profile Pic: </label> <br>
        <input type="file" name="uploadfile" id="uploadfile" class="form-control border border-dark border-2"  aria-describedby="inputGroupFileAddon04" >    
    </div>

                <div class="mb-3 ">
                    <label for="username" class="form-label "> Username: </label>
                    <input type="text" class="form-control shadow" id="username" name="username" value="<?php echo $username ?>"  required >
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label"> Name: </label>
                    <input type="text" class="form-control shadow" id="name" name="name"  required>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label"> Bio: </label>
                    <textarea class="form-control shadow" id="bio" name="bio" required> </textarea>
                </div>

                <div class="mb-3 ">
                    <label for="link" class="form-label"> Add Link:</label>
                    <input type="text" class="form-control shadow" id="link" name="link"  required>
                </div>

                <div class="pt-3  text-center  w-100">
                    <input type="submit" value="Update" id="update" name="update" class="btn btn-light btn-outline-primary shadow-sm">
                </div>          
</form>