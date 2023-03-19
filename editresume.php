<?php

session_start();
include('config/connect.php');

$username = $_SESSION['name'];

$firstName = $lastName = $dept = $address = $city = $state = $zipCode = $dob = $age = $phoneNumber = $email = $objective = $schoolName = $schoolMarks = $schoolYear = $collegeName = $collegeMarks = $collegeYear = $diplomaName = $diplomaMarks = $diplomaYear = '';
$skill1 = $skill1_p = $skill2 = $skill2_p = $skill3 = $skill3_p = $skill4 = $skill4_p = $skill5 = $skill5_p = $skill6 = $skill6_p = '';
$company1 = $company1_role = $company1_time = $company1_desc = $company2 = $company2_role = $company2_time = $company2_desc = '';
$project1_title = $project1_desc = $project2_title = $project2_desc = '';
$achievements = '';
$linkedin = $github = '';


if (isset($_POST['submit'])) {

    $firstName = stripslashes($_REQUEST['fname']);
    $firstName = mysqli_real_escape_string($conn, $firstName);

    $lastName = stripslashes($_REQUEST['lname']);
    $lastName = mysqli_real_escape_string($conn, $lastName);

    $dept = stripslashes($_REQUEST['dept']);
    $dept = mysqli_real_escape_string($conn, $dept);

    $address = stripslashes($_REQUEST['address']);
    $address = mysqli_real_escape_string($conn, $address);

    $city = stripslashes($_REQUEST['city']);
    $city = mysqli_real_escape_string($conn, $city);

    $state = stripslashes($_REQUEST['state']);
    $state = mysqli_real_escape_string($conn, $state);

    $zipCode = stripslashes($_REQUEST['zip']);
    $zipCode = mysqli_real_escape_string($conn, $zipCode);

    $age = stripslashes($_REQUEST['age']);
    $age = mysqli_real_escape_string($conn, $age);

    $dob = stripslashes($_REQUEST['dob']);
    $dob = mysqli_real_escape_string($conn, $dob);

    $phoneNumber = stripslashes($_REQUEST['phNumber']);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);

    $email = stripslashes($_REQUEST['email']);
    $email = mysqli_real_escape_string($conn, $email);

    $objective = stripslashes($_REQUEST['objective']);
    $objective = mysqli_real_escape_string($conn, $objective);

    $schoolMarks = stripslashes($_REQUEST['schoolPercent']);
    $schoolMarks = mysqli_real_escape_string($conn, $schoolMarks);

    $schoolName = stripslashes($_REQUEST['schoolName']);
    $schoolName = mysqli_real_escape_string($conn, $schoolName);

    $schoolYear = stripslashes($_REQUEST['schoolYear']);
    $schoolYear = mysqli_real_escape_string($conn, $schoolYear);

    $diplomaMarks = stripslashes($_REQUEST['diplomaPercent']);
    $diplomaMarks = mysqli_real_escape_string($conn, $diplomaMarks);

    $diplomaName = stripslashes($_REQUEST['diplomaName']);
    $diplomaName = mysqli_real_escape_string($conn, $diplomaName);

    $diplomaYear = stripslashes($_REQUEST['diplomaYear']);
    $diplomaYear = mysqli_real_escape_string($conn, $diplomaYear);

    $collegeMarks = stripslashes($_REQUEST['collegePercent']);
    $collegeMarks = mysqli_real_escape_string($conn, $collegeMarks);

    $collegeName = stripslashes($_REQUEST['collegeName']);
    $collegeName = mysqli_real_escape_string($conn, $collegeName);

    $collegeYear = stripslashes($_REQUEST['collegeYear']);
    $collegeYear = mysqli_real_escape_string($conn, $collegeYear);

    $skill1 = stripslashes($_REQUEST['skill1']);
    $skill1 = mysqli_real_escape_string($conn, $skill1);
    $skill1_p = stripslashes($_REQUEST['skill1_P']);
    $skill1_p = mysqli_real_escape_string($conn, $skill1_p);

    $skill2 = stripslashes($_REQUEST['skill2']);
    $skill2 = mysqli_real_escape_string($conn, $skill2);
    $skill2_p = stripslashes($_REQUEST['skill2_P']);
    $skill2_p = mysqli_real_escape_string($conn, $skill2_p);

    $skill3 = stripslashes($_REQUEST['skill3']);
    $skill3 = mysqli_real_escape_string($conn, $skill3);
    $skill3_p = stripslashes($_REQUEST['skill3_P']);
    $skill3_p = mysqli_real_escape_string($conn, $skill3_p);

    $skill4 = stripslashes($_REQUEST['skill4']);
    $skill4 = mysqli_real_escape_string($conn, $skill4);
    $skill4_p = stripslashes($_REQUEST['skill4_P']);
    $skill4_p = mysqli_real_escape_string($conn, $skill4_p);

    $skill5 = stripslashes($_REQUEST['skill5']);
    $skill5 = mysqli_real_escape_string($conn, $skill5);
    $skill5_p = stripslashes($_REQUEST['skill5_P']);
    $skill5_p = mysqli_real_escape_string($conn, $skill5_p);

    $skill6 = stripslashes($_REQUEST['skill6']);
    $skill6 = mysqli_real_escape_string($conn, $skill6);
    $skill6_p = stripslashes($_REQUEST['skill6_P']);
    $skill6_p = mysqli_real_escape_string($conn, $skill6_p);

    $company1 = stripslashes($_REQUEST['company1_name']);
    $company1 = mysqli_real_escape_string($conn, $company1);
    $company1_role = stripslashes($_REQUEST['company1_role']);
    $company1_role = mysqli_real_escape_string($conn, $company1_role);
    $company1_time = stripslashes($_REQUEST['company1_time']);
    $company1_time = mysqli_real_escape_string($conn, $company1_time);
    $company1_desc = stripslashes($_REQUEST['company1_desc']);
    $company1_desc = mysqli_real_escape_string($conn, $company1_desc);

    $company2 = stripslashes($_REQUEST['company2_name']);
    $company2 = mysqli_real_escape_string($conn, $company2);
    $company2_role = stripslashes($_REQUEST['company2_role']);
    $company2_role = mysqli_real_escape_string($conn, $company2_role);
    $company2_time = stripslashes($_REQUEST['company2_time']);
    $company2_time = mysqli_real_escape_string($conn, $company2_time);
    $company2_desc = stripslashes($_REQUEST['company2_desc']);
    $company2_desc = mysqli_real_escape_string($conn, $company2_desc);


    $project1_title = stripslashes($_REQUEST['project1_name']);
    $project1_title = mysqli_real_escape_string($conn, $project1_title);
    $project1_desc = stripslashes($_REQUEST['project1_desc']);
    $project1_desc = mysqli_real_escape_string($conn, $project1_desc);

    $project2_title = stripslashes($_REQUEST['project2_name']);
    $project2_title = mysqli_real_escape_string($conn, $project2_title);
    $project2_desc = stripslashes($_REQUEST['project2_desc']);
    $project2_desc = mysqli_real_escape_string($conn, $project2_desc);

    $achievements = stripslashes($_REQUEST['achievements']);
    $achievements = mysqli_real_escape_string($conn, $achievements);

    $linkedin = stripslashes($_REQUEST['linkedin']);
    $linkedin = mysqli_real_escape_string($conn, $linkedin);

    $github = stripslashes($_REQUEST['github']);
    $github = mysqli_real_escape_string($conn, $github);


    $query    = "INSERT INTO resume (username,firstName,lastName,address,city,state,zipCode,dob,age,phoneNumber,email,objective,schoolName,schoolMarks,schoolYear,collegeName,collegeMarks,collegeYear,diplomaName,diplomaMarks,diplomaYear,skill1,skill1_p,skill2,skill2_p,skill3,skill3_p,skill4,skill4_p,skill5,skill5_p,skill6,skill6_p,company1,company1_role,company1_time,company1_desc,company2,company2_role,company2_time,company2_desc,project1_title,project1_desc,project2_title,project2_desc,achievements,dept,linkedin,github)
    VALUES ('$username','$firstName','$lastName', '$address' , '$city' , '$state' , '$zipCode' , '$dob' , '$age' , '$phoneNumber' , '$email'  ,'$objective' , '$schoolName' , '$schoolMarks' , '$schoolYear' , '$collegeName' , '$collegeMarks' , '$collegeYear' , '$diplomaName' , '$diplomaMarks' , '$diplomaYear','$skill1','$skill1_p','$skill2','$skill2_p','$skill3','$skill3_p','$skill4','$skill4_p','$skill5','$skill5_p','$skill6','$skill6_p','$company1','$company1_role','$company1_time','$company1_desc','$company2','$company2_role','$company2_time','$company2_desc','$project1_title','$project1_desc','$project2_title','$project2_desc','$achievements','$dept','$linkedin','$github')";

 



    $result   = mysqli_query($conn, $query);

    $states = [
        "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh",
        "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya",
        "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttarakhand", "Uttar Pradesh",
        "West Bengal"
      ];

      
$state_count =  count($states);
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resume</title>
    <?php include('header.php'); ?>

</head>

<body class="container mx-auto w-75 bg-dark">
    <br>
    <div class="p-3 card border border-secondary border-1 shadow">

        <form action="" method="POST" class="row m-2" enctype="multipart/form-data">


            <h1 class="fs-2 text-secondary py-2">Personal Details : </h1>

            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">First Name</label>
                <input type="text" name="fname" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Last Name</label>
                <input type="text" name="lname" class="form-control" id="inputPassword4">
            </div>

            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Department</label>
                <input type="text" name="dept" class="form-control" id="inputPassword4">
            </div>

            <div class="col-12 my-3">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="inputAddress" placeholder="House No/Street">
            </div>

            <div class="col-md-6">
                <label for="inputCity" class="form-label">City</label>
                <input type="text" name="city" class="form-control" id="inputCity">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">State</label>
                <select id="inputState" class="form-select" name="state">
                    <option selected>TamilNadu</option>
                    <option>Andhra Pradesh</option>
                    <option>Telangana</option>
                    <option>Maharashtra</option>
                    <option>Bihar</option>
                    <option>Kerala</option>
                    <option>Punjab</option>
                    <option>Karnataka</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputZip" class="form-label">Zip</label>
                <input type="text" name="zip" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Date of Birth</label>
                <input type="text" name="dob" class="form-control" placeholder="DD-MM-YYYY">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Age</label>
                <input type="number" name="age" class="form-control">
            </div>

            <div class="my-1">
                <label for="inputZip" class="form-label">Phone number </label>
                <input type="text" name="phNumber" class="form-control">
            </div>

            <div class="my-1">
                <label for="inputZip" class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
            </div>


            <h1 class="fs-2 text-secondary my-2">Create a Objective : </h1>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fs-6 text-danger"> Provide a 2-3 sentence of
                    your professional experience, skills, and achievements, and explains why they make you the right
                    candidate for the job</label>
                <textarea class="form-control" name="objective" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>


            <h1 class="fs-2 text-secondary my-2">Educational Background : </h1>

            <h4 class="fs-5 text-secondary my-1"> 10th Std details </h4>
            <div class="my-1">
                <label for="inputZip" class="form-label">Name of the School </label>
                <input type="text" name="schoolName" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Percentage </label>
                <input type="text" name="schoolPercent" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Completed Year </label>
                <input type="number" name="schoolYear" class="form-control">
            </div>

            <h4 class="fs-5 text-secondary my-1"> 12th Std/Diploma details </h4>
            <div class="my-1">
                <label for="inputZip" class="form-label">Name of the School/College </label>
                <input type="text" name="diplomaName" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Percentage </label>
                <input type="text" name="diplomaPercent" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Completed Year </label>
                <input type="number" name="diplomaYear" class="form-control">
            </div>

            <h4 class="fs-5 text-secondary my-1"> College details (UG) </h4>
            <div class="my-1">
                <label for="inputZip" class="form-label">Name of the College </label>
                <input type="text" name="collegeName" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">CGPA (Current CGPA) </label>
                <input type="text" name="collegePercent" class="form-control">
            </div>

            <div class="col-md-6 my-3">
                <label for="inputZip" class="form-label">Completed Year</label>
                <input type="number" name="collegeYear" class="form-control">
            </div>



            <h1 class="fs-2 text-secondary my-2">Skills : </h1>

            <div class="col-md-6 my-1">
                <input type="text" name="skill1" class="form-control" placeholder="Technical skill">
            </div>
            <div class="col-md-6 my-1">
                <input type="number" name="skill1_P" class="form-control" placeholder="Rate it out of 100">
            </div>

            <div class="col-md-6 my-1">
                <input type="text" name="skill2" class="form-control" placeholder="Technical skill">
            </div>
            <div class="col-md-6 my-1">
                <input type="number" name="skill2_P" class="form-control" placeholder="Rate it out of 100">
            </div>

            <div class="col-md-6 my-1">
                <input type="text" name="skill3" class="form-control" placeholder="Technical skill">
            </div>
            <div class="col-md-6 my-1">
                <input type="number" name="skill3_P" class="form-control" placeholder="Rate it out of 100">
            </div>

            <div class="col-md-6 my-1">
                <input type="text" name="skill4" class="form-control" placeholder="Technical skill">
            </div>
            <div class="col-md-6 my-1">
                <input type="number" name="skill4_P" class="form-control" placeholder="Rate it out of 100">
            </div>

            <div class="col-md-6 my-1">
                <input type="text" name="skill5" class="form-control" placeholder="Soft skill">
            </div>
            <div class="col-md-6 my-1">
                <input type="number" name="skill5_P" class="form-control" placeholder="Rate it out of 100">
            </div>

            <div class="col-md-6 my-1">
                <input type="text" name="skill6" class="form-control" placeholder="Soft skill">
            </div>
            <div class="col-md-6 my-1">
                <input type="number" name="skill6_P" class="form-control" placeholder="Rate it out of 100">
            </div>


            <h1 class="fs-2 text-secondary my-3">Internship / Work Experience : </h1>

            <h4 class="fs-5 text-secondary my-1"> Experience 1 </h4>
            <div class="my-1">
                <label for="inputZip" class="form-label">Name of the Company </label>
                <input type="text" name="company1_name" class="form-control">
            </div>
            <div class="col-md-6 my-1">
                <label for="inputZip" class="form-label">Role </label>
                <input type="text" name="company1_role" class="form-control">
            </div>
            <div class="col-md-6 my-1">
                <label for="inputZip" class="form-label">Time Period</label>
                <input type="number" name="company1_time" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fs-6 "> Description </label>
                <textarea class="form-control" name="company1_desc" id="exampleFormControlTextarea1"
                    rows="3"></textarea>
            </div>

            <h4 class="fs-5 text-secondary my-1"> Experience 2 </h4>
            <div class="my-1">
                <label for="inputZip" class="form-label">Name of the Company </label>
                <input type="text" name="company2_name" class="form-control">
            </div>
            <div class="col-md-6 my-1">
                <label for="inputZip" class="form-label">Role </label>
                <input type="text" name="company2_role" class="form-control">
            </div>
            <div class="col-md-6 my-1">
                <label for="inputZip" class="form-label">Time Period</label>
                <input type="number" name="company2_time" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fs-6 "> Description </label>
                <textarea class="form-control" name="company2_desc" id="exampleFormControlTextarea1"
                    rows="3"></textarea>
            </div>



            <h1 class="fs-2 text-secondary my-3">Projects : </h1>

            <div class="my-1">
                <label for="inputZip" class="form-label">Project Title - 1 </label>
                <input type="text" name="project1_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fs-6 "> Brief Explanation about the
                    project</label>
                <textarea class="form-control" name="project1_desc" id="exampleFormControlTextarea1"
                    rows="3"></textarea>
            </div>

            <div class="my-1">
                <label for="inputZip" class="form-label">Project Title - 2</label>
                <input type="text" name="project2_name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label fs-6 "> Brief Explanation about the
                    project</label>
                <textarea class="form-control" name="project2_desc" id="exampleFormControlTextarea1"
                    rows="3"></textarea>
            </div>

            <h1 class="fs-2 text-secondary my-2">Achievements/Awards: </h1><span class="fs-6 text-success">If more than
                1
                achievement, separate with comma ',' </span>
            <div class="mb-3">

                <textarea class="form-control" name="achievements" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>


            <h1 class="fs-2 text-secondary my-3">Personal Links : </h1>

            <div class="my-1">
                <label for="inputZip" class="form-label">Linkedin URL : </label>
                <input type="text" name="linkedin" class="form-control">
            </div>
            <div class="my-1">
                <label for="inputZip" class="form-label">Github Profile Link : </label>
                <input type="text" name="github" class="form-control">
            </div>




            <div class="col-12 my-3">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
            </div>

        </form>
    </div>
    <?php include('footer.php'); ?>
</body>

</html>