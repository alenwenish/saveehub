<?php
session_start();
include('config/connect.php');



$firstName = $lastName = $address = $city = $state = $zipCode = $dob = $age = $phoneNumber = $email = $objective = $schoolName = $schoolMarks = $schoolYear = $collegeName = $collegeMarks = $collegeYear = $diplomaName = $diplomaMarks = $diplomaYear = '';
$skill1 = $skill1_p = $skill2 = $skill2_p = $skill3 = $skill3_p = $skill4 = $skill4_p = $skill5 = $skill5_p = $skill6 = $skill6_p = '';
$company1 = $company1_role = $company1_time = $company1_desc = $company2 = $company2_role = $company2_time = $company2_desc = '';
$project1_title = $project1_desc = $project2_title = $project2_desc = '';
$achievements = '';
$dept =  '';
$linkedin = $github = '';
$username = '';
$regno = '';

if (isset($_POST['submit'])) {

    $regno = stripslashes($_REQUEST['regno']);
    $regno = mysqli_real_escape_string($conn, $regno);
    $url = "http://localhost/saveehub/resumePage.php?regno=" . $regno;
    echo $url;
    header("Location: $url ");
}



$regno =  $_GET['regno'];


if ($regno != '' && $regno != "") {

    $sql = "SELECT * FROM resume where regno = '$regno'";
    $res = mysqli_query($conn, $sql);

    $rows1 = mysqli_num_rows($res);

    if ($rows1 == 1) {


        while ($row = mysqli_fetch_array($res)) {
            $username = $row['1'];
            $firstName = $row['2'];
            $lastName = $row['3'];
            $address = $row['4'];
            $city = $row['5'];
            $state = $row['6'];
            $zipCode = $row['7'];
            $dob = $row['8'];
            $age = $row['9'];
            $phoneNumber = $row['10'];
            $email = $row['11'];
            $objective = $row['12'];

            $schoolName = $row['13'];
            $schoolMarks = $row['14'];
            $schoolYear = $row['15'];

            $diplomaName = $row['19'];
            $diplomaMarks = $row['20'];
            $diplomaYear = $row['21'];

            $collegeName = $row['16'];
            $collegeMarks = $row['17'];
            $collegeYear = $row['18'];

            $skill1 = $row['22'];
            $skill1_p = $row['23'];
            $skill2 = $row['24'];
            $skill2_p = $row['25'];
            $skill3 = $row['26'];
            $skill3_p = $row['27'];
            $skill4 = $row['28'];
            $skill4_p = $row['29'];
            $skill5 = $row['30'];
            $skill5_p = $row['31'];
            $skill6 = $row['32'];
            $skill6_p = $row['33'];

            $company1 = $row['34'];
            $company1_role = $row['35'];
            $company1_time = $row['36'];
            $company1_desc = $row['37'];

            $company2 = $row['38'];
            $company2_role = $row['39'];
            $company2_time = $row['40'];
            $company2_desc = $row['41'];

            $project1_title = $row['42'];
            $project1_desc = $row['43'];
            $project2_title = $row['44'];
            $project2_desc =  $row['45'];

            $achievements = $row['46'];

            $dept = $row['47'];
            $linkedin = $row['48'];
            $github = $row['49'];
            $resumepdf = $row['50'];
        }

        $sql = "SELECT pic FROM login where username = '$username'";
        $res = mysqli_query($conn, $sql);
        $pic = $res->fetch_array()['pic'];
    };
}


?>

<!DOCTYPE html>

<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume - Page</title>
    <?php include('header.php') ?>

    <style>
    #outer {
        background-image: url("saveetha.jpg");
        background-repeat: no-repeat;
        object-fit: cover;
        background-size: 100% 100%;
    }

    p {
        font-size: 20px;
    }

    li {
        font-size: 20px;
    }
    </style>


</head>

<body>

    <?php if ($regno != '' && $regno != "" && $rows1 == 1) { ?>
    <div id="outer" class="p-2">

        <div class="w-50 mx-auto text-center bg-white">
            <div class="py-2  text-center ">
                <a href="#about" class="text-decoration-none text-secondary"><span class="fs-6 p-2">About</span></a>
                <a href="#education" class="text-decoration-none text-secondary"><span
                        class="fs-6 p-2">Education</span></a>
                <a href="#skills" class="text-decoration-none text-secondary"> <span class="fs-6 p-2">Skills</span></a>
                <a href="#experience" class="text-decoration-none text-secondary"> <span
                        class="fs-6 p-2">Experience</span></a>
                <a href="#projects" class="text-decoration-none text-secondary"> <span
                        class="fs-6 p-2">Projects</span></a>
                <a href="#achievements" class="text-decoration-none text-secondary"> <span
                        class="fs-6 p-2">Achievements</span></a>

            </div>
        </div>

        <br><br>

        <div class="w-75 mx-auto border-light shadow row bg-white rounded">
            <div class="col-lg-6 p-3">
                <br>
                <?php if ($pic == '') {  ?>
                <h1 class="text-center" style="font-size: 108px;"><i class="fa-solid fa-user"></i></h1>
                <?php } else { ?>
                <img src="./profile_pics/<?php echo $pic ?>" class="mx-auto d-block w-25" alt="" id="profile_pic">
                <?php } ?>

                <br>
                <div class="text-center mx-auto">
                    <a href="mailto:<?php echo $email; ?>"><i class="fa-sharp fa-solid fa-envelope fs-5 p-3"></i></a>
                    <a href="<?php echo $linkedin; ?>"><i class="fa-brands fa-linkedin fs-5 p-3"></i></a>
                    <a href="<?php echo $github; ?>"><i class="fa-brands fa-github fs-5 p-3"></i></a>

                </div>
            </div>
            <div class="col-lg-6 pt-3 p-4">
                <span class="fs-3 fw-bold p-1"><?php echo $firstName . " " . $lastName ?></span>

                <button class="clipboard bg-white border border-white text-primary"><i
                        class="fa-solid fa-copy px-5"></i>
                </button>

                <br>
                <span class="fs-5  p-1"><?php echo $dept ?></span> <br>

                <?php if ($resumepdf != '') { ?>
                <a href=" <?php echo "resumes/" . $resumepdf ?>" download>
                    <?php } ?>

                    <button class="btn btn-dark m-3"> Download Resume </button></a>
                <br>
                <table>
                    <tr>
                        <td>
                            Age &nbsp;
                        </td>
                        <td>
                            :&nbsp; <?php echo $age ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Address &nbsp;
                        </td>
                        <td>
                            :&nbsp; <?php echo $address . " " . $city . " " . $state; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Phone Number &nbsp;
                        </td>
                        <td>
                            :&nbsp; <?php echo $phoneNumber ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Email &nbsp;
                        </td>
                        <td>
                            :&nbsp; <?php echo $email ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <br><br>
        <br>



    </div>



    <div class=" w-75 m-auto" id="about">
        <br>
        <h3>
            <i class="fa-solid fa-circle-info"></i>
            Objective :
        </h3> <br>
        <p><?php echo $objective; ?></p>



        <hr>

        <h3 id="education"><i class="fa-solid fa-school"></i> Education Details : </h3>
        <br>
        <div>
            <h4><?php echo $collegeName ?> - <span class="fw-normal fs-5">
                    <?php echo $dept ?>, <?php echo $collegeYear ?> </span>
            </h4>
            <h5 class="fs-5"><?php echo $collegeMarks ?> CGPA</h5>
        </div>

        <div>
            <h4><?php echo $diplomaName ?> - <span class="fw-normal fs-5">
                    Completed 12th STD, <?php echo $diplomaYear ?> </span>
            </h4>
            <h5 class="fs-5"><?php echo $diplomaMarks ?>%</h5>
        </div>

        <div>
            <h4><?php echo $schoolName ?> - <span class="fw-normal fs-5">
                    Completed 10th STD, <?php echo $schoolYear ?> </span>
            </h4>
            <h5 class="fs-5"><?php echo $schoolMarks ?>%</h5>
        </div>

        <hr>
        <h3 id="skills">
            <i class="fa-solid fa-brain"></i> Skills :
        </h3> <br>


        <div class="row">

            <div class="col">
                <p class="fs-6 p-1"><?php echo $skill1 ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $skill1_p ?>%;"
                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"><?php echo $skill1_p ?>
                    </div>
                </div>
                <p class="fs-6 p-1"><?php echo $skill2 ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $skill2_p ?>%;"
                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><?php echo $skill2_p ?>
                    </div>
                </div>
                <p class="fs-6 p-1"><?php echo $skill3 ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $skill3_p ?>%;"
                        aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"><?php echo $skill3_p ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <p class="fs-6 p-1"><?php echo $skill4 ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $skill4_p ?>%;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $skill4_p ?>
                    </div>
                </div>
                <p class="fs-6 p-1"><?php echo $skill5 ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $skill5_p ?>%;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $skill5_p ?>
                    </div>
                </div>
                <p class="fs-6 p-1"><?php echo $skill6 ?></p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $skill6_p ?>%;"
                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $skill6_p ?>
                    </div>
                </div>
            </div>

        </div>


        <hr>

        <h3 id="experience"><i class="fa-solid fa-trophy"></i> Experience : </h3>
        <br>
        <div>
            <h4><?php echo $company1_time ?></h4>
            <h5><?php echo $company1_role . ", " . $company1 ?></h5>
            <p><?php echo $company1_desc ?></p>
        </div>

        <div>
            <h4><?php echo $company2_time ?></h4>
            <h5><?php echo $company2_role . ", " . $company2 ?></h5>
            <p><?php echo $company2_desc ?></p>
        </div>

        <hr>

        <h3 id="projects"><i class="fa-solid fa-file"></i> Projects : </h3> <br>

        <div>
            <h4><?php echo $project1_title ?></h4>
            <p><?php echo $project1_desc ?>
            </p>
        </div>

        <div>
            <h4><?php echo $project2_title ?></h4>
            <p><?php echo $project2_desc ?>
            </p>
        </div>

        <hr>

        <h3 id="achievements"><i class="fa-solid fa-award"></i> Achievements/Awards : </h3> <br>

        <li>
            <?php echo $achievements; ?>
        </li>













    </div>

    <?php } else { ?>

    <h5 class="text-danger text-center p-3">You have entered wrong register number.<br> <br> Please enter the correct
        one
    </h5>

    <form action="" method="POST" class="row  w-50 m-auto" enctype="multipart/form-data">

        <input type="text" name="regno" class="form-control" id="inputEmail4" placeholder="Enter your Reg no">
        <button type="submit" class="btn btn-dark d-block mx-auto my-2 w-50" name="submit">

            Submit </button>

    </form>

    <?php } ?>


    <br><br><br>



</body>

<script>
var $temp = $("<input>");
var $url = $(location).attr('href');

$('.clipboard').on('click', function() {
    $("body").append($temp);
    $temp.val($url).select();
    document.execCommand("copy");
    $temp.remove();
    alert('Link Copied')
})
</script>

</html>