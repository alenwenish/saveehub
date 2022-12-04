<?php

session_start();
include('config/connect.php');

$username = $_SESSION['name'];
$sql = "SELECT username FROM login where username NOT IN (SELECT follower_name FROM followers WHERE account = '$username') AND username != '$username'";

$res = mysqli_query($conn,$sql);
$rows = array();
while($row = mysqli_fetch_array($res))
    $rows[] = $row;

$sql1 = "SELECT club_name FROM club where club_name NOT IN (SELECT follower_name FROM followers WHERE account = '$username') AND club_name != '$username'";

$res1 = mysqli_query($conn,$sql1);
$rows1 = array();
while($row = mysqli_fetch_array($res1))
    $rows1[] = $row;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends</title>
    <?php include('header.php') ?>
</head>

<body>
    <?php include('navigation.php'); ?>

    <div class="container">
        <h2 class="fs-2 fw-normal text-secondary pt-4 text-center"> Follow Requests</h2>
        <h2 class="fs-4 fw-normal text-secondary pt-4 text-center"> Friends</h2>

        <table class="container table w-50 mx-auto mt-3">
            <?php foreach($rows as $row) { ?>
                
                <tr class="fs-4 shadow-sm">
                    <td class="py-2 px-3"> <i class="fa-regular fa-user"></i> </td>
                    <td class="py-2 px-3">  <?php echo $row['username']; ?> </td>
                    <td class="py-2 px-3"> 
                        <a href="addfollower.php?acc=<?php echo $username; ?>&follower=<?php echo $row['username']; ?> "  >
                        <button class="btn btn-sm btn-dark">FOLLOW</button>
                        </a>
                    </td>                                    
                </tr>
                
            
            <?php } ?>
        </table>

        <h2 class="fs-4 fw-normal text-secondary pt-4 text-center"> Clubs </h2>

        <table class="container table w-50 mx-auto mt-3">
            <?php foreach($rows1 as $row) { ?>
                
                <tr class="fs-4 shadow-sm">
                    <td class="py-2 px-3"> <i class="fa-regular fa-user"></i> </td>
                    <td class="py-2 px-3">  <?php echo $row['club_name']; ?> </td>
                    <td class="py-2 px-3"> 
                        <a href="addfollower.php?acc=<?php echo $username; ?>&follower=<?php echo $row['club_name']; ?> "  >
                        <button class="btn btn-sm btn-dark">FOLLOW</button>
                        </a>
                    </td>                                    
                </tr>
                
            
            <?php } ?>
        </table>

    </div>

    <br><br><br>

    <?php include('footer.php'); ?>
</body>
</html>