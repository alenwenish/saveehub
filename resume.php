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
    </style>


</head>

<body>

    <div id="outer" class="p-2">

        <div class="w-50 mx-auto text-center bg-white">
            <div class="py-2  text-center">
                <span class="fs-6 p-2">About</span>
                <span class="fs-6 p-2">Skills</span>
                <span class="fs-6 p-2">Portfolio</span>
                <span class="fs-6 p-2">Experience</span>
                <span class="fs-6 p-2">Education</span>
                <span class="fs-6 p-2">Reference</span>
                <span class="fs-6 p-2">Contact</span>

            </div>
        </div>

        <br><br>

        <div class="w-50 mx-auto border-light shadow row bg-white rounded">
            <div class="col-6 p-3">
                <br>
                <h1 class="text-center" style="font-size: 108px;"><i class="fa-solid fa-user"></i></h1>
                <br>
                <div class="text-center mx-auto">
                    <i class="fa-sharp fa-solid fa-envelope fs-5 p-3"></i>
                    <i class="fa-brands fa-linkedin fs-5 p-3"></i>
                    <i class="fa-brands fa-github fs-5 p-3"></i>
                    <i class="fa-brands fa-twitter fs-5 p-3"></i>
                </div>
            </div>
            <div class="col-6 pt-3 p-4">
                <span class="fs-3 fw-bold p-1">Sathish Kumar</span> <br>
                <span class="fs-5  p-1">Computer Science Engineer</span> <br>
                <button class="btn btn-dark m-3"> Download Resume </button> <br>
                <table>
                    <tr>
                        <td>
                            Age &nbsp;
                        </td>
                        <td>
                            :&nbsp; 19
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Address &nbsp;
                        </td>
                        <td>
                            :&nbsp; Chennai, TamilNadu
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Phone Number &nbsp;
                        </td>
                        <td>
                            :&nbsp; 7448540231
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Email &nbsp;
                        </td>
                        <td>
                            :&nbsp; sathish@email.com
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <br><br>
        <br>



    </div>

    <div class="w-75 m-auto">
        <br>
        <h3>
            Objective :
        </h3>
        <p>Looking for a challenging role in a reputable organization to utilize my technical, database, and management
            skills for the growth of the organization as well as to enhance my knowledge about new and emerging trends
            in the IT sector</p>

        <h3>
            Skills :
        </h3>
        <div class="row">

            <div class="col">
                <p class="fs-6 p-1">Python</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80"
                        aria-valuemin="0" aria-valuemax="100">80</div>
                </div>
                <p class="fs-6 p-1">Java</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                        aria-valuemin="0" aria-valuemax="100">75</div>
                </div>
                <p class="fs-6 p-1">C</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90"
                        aria-valuemin="0" aria-valuemax="100">90</div>
                </div>
            </div>
            <div class="col">
                <p class="fs-6 p-1">HTML</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 88%;" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">88</div>
                </div>
                <p class="fs-6 p-1">DBMS</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">65</div>
                </div>
                <p class="fs-6 p-1">Devops</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: 70%;" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">70</div>
                </div>
            </div>

        </div>

    </div>


    <br><br><br>

    <?php include('footer.php'); ?>

</body>

</html>