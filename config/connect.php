<?php

   $conn = mysqli_connect('localhost','esp32','password','saveetha');
   if(mysqli_connect_errno()){
       echo 'Connection_error : '.mysqli_connect_error();
   }

?>
