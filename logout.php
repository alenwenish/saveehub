<?php 
session_start();
// Destroy session
if(session_destroy()) {  
    header("Location: login.php");
}
?>