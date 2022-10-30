<?php

session_start();
include('config/connect.php');

$username = $_SESSION['name'];
$sql = "SELECT username FROM login where username != '$username'";
$res = mysqli_query($conn,$sql);
$rows = array();
while($row = mysqli_fetch_array($res))
    $rows[] = $row;

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

    <div>
        <table class="table w-50 mx-auto mt-3">
            <?php foreach($rows as $row) { ?>
                
                <tr class="border   mb-2 fs-4 shadow-sm">
                    <td class="p-4"> <i class="fa-regular fa-user"></i> </td>
                    <td class="p-4">  <?php echo $row['username']; ?> </td>
                    <td class="p-4">  <button class="btn btn-sm btn-primary">FOLLOW</button></td>
                </tr>
            
            <?php } ?>
        </table>
    </div>

    

    <?php include('footer.php'); ?>
</body>
</html>