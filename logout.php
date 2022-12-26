<?php 
session_start();
// Destroy session
if(session_destroy()) {  
    header("Location: login.php");
}
?>



<form action="" method="POST" class="d-flex mx-auto justify-content-center w-75">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search here... " name="search_name"
            aria-describedby="button-addon2">
        <button class="btn btn-primary" type="submit" name="search" id="button-addon2"><i
                class="fa-solid fa-magnifying-glass"></i></button>
    </div>
</form>