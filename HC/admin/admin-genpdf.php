<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="bootstrap-4.6.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/all.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome.min.css">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="css/admin-style.css">

    <title>Generate PDF - Admin | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="images/icon.ico" />
</head>

<body>
    <?php include 'admin-nav.php'; ?>
    <div class="main_content p-sm-0 p-md-2">
        <div class="text-current_page">Generate Lab Report</div>
        <hr>
        <p style="cursor:default;visibility:hidden;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus, minima nesciunt veritatis quas et alias quaerat amet, molestiae ea deserunt, obcaecati labore fugit exercitationem omnis nisi quod facere accusantium est?</p>
        <?php
        $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error() . "<br>");
        ?>

        <div class="container-fluid bg-white p-lg-3">
            <form action="admin-genpdf.php" method="POST">
                <div class="row my-1">
                    <div class="form-group col-md-4 mx-auto">
                        <label>Checked By/Ref. Doctor</label>
                        <select class="form-control" name="doctorId">
                            <option value="0" selected>Self</option>
                            <?php

                            $select_doc = "SELECT * FROM doctor";
                            $result_doctor = mysqli_query($con, $select_doc);
                            while ($rows = mysqli_fetch_array($result_doctor)) {
                            ?>
                                <option value="<?php echo $rows['doctor_id']; ?>"><?php echo $rows['first_name'] . ' ' . $rows['last_name']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="form-group col-md-4">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group col-md-4 ml-auto">
                        <label>Registered Date</label>
                        <input type="date" class="form-control" name="registered_date">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="form-group col-md-4">
                        <label>Age</label>
                        <input type="number" class="form-control" name="age">
                    </div>
                    <div class="form-group col-md-4 ml-auto">
                        <label>Reported Date</label>
                        <input type="date" class="form-control" name="reported_date">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="form-group col-md-6">
                        <label>Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Male">:Male
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Female">:Female
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" value="Other">:Other
                        </div>
                    </div>
                </div>
                <div class="row my-2">
                    <div class="form-group col-md-3">
                        <label>Test Name</label>
                        <input type="text" class="form-control" name="test_name">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Result</label>
                        <input type="text" class="form-control" name="result">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Unit</label>
                        <select class="form-control" name="unit">
                            <option value="mg/dl" selected>gm/dl</option>
                            <option value="%">%</option>
                            <option value="fL">fL</option>
                            <option value="pg">pg</option>
                            <option value="/mm3">/mm<sup>3</sup></option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Range</label>
                        <input type="text" class="form-control" name="range">
                    </div>
                </div>
                <div class="row my-2">
                    <div class="form-group col-md-4">
                        <input type="submit" class="btn btn-success" name="generate" value="Generate">
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['generate'])) {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $registered_date = $_POST['registered_date'];
            $reported_date = $_POST['reported_date'];
            $test_name = $_POST['test_name'];
            $result = $_POST['result'];
            $unit = $_POST['unit'];
            $range = $_POST['range'];
            $doctor_id = $_POST['doctorId'];

            // if ($doctor_id = 0) {
            //     echo "Self";
            // } else {
            //     $select_doctor = "SELECT * FROM doctor LEFT JOIN department ON (doctor.department_id=department.department_id) WHERE doctor_id=$doctor_id";
            //     $res = mysqli_query($con, $select_doctor);
            //     $row = mysqli_fetch_assoc($res);
            //     echo $row['first_name'];
            // }

            $select_doctor = "SELECT * FROM doctor LEFT JOIN department ON (doctor.department_id=department.department_id) WHERE doctor_id=$doctor_id";
            $res = mysqli_query($con, $select_doctor);
            $row = mysqli_fetch_assoc($res);

            $doctor_name = $row['first_name'] . ' ' . $row['last_name'];
            $doctor_qual = $row['qualification'];
            $doctor_nmc = $row['nmc'];
            $dept = $row['department_name'];


            //Create html of the data
            ob_start();
        ?>

            <!-- Start of Report  -->
            <table width=100% height="450px" style="margin: auto;">
                <tr>
                    <td rowspan="2" style="text-align: center;" class="clinic_name">Hamro Clinic</td>
                </tr>
                <tr>
                    <td colspan="3">Phone:9843807054<br><br>
                        Email:hamroclinic@gmail.com<br><br>
                        Address:Mid-Banehswor,Kathmandu<br><br>
                    </td>
                </tr>
                <tr>
                    <td>Doctor Name:<?php echo $doctor_name; ?>
                        <br><br>
                        Qualification:<?php echo $doctor_qual; ?>
                        <br><br>
                        Department:<?php echo $dept; ?>
                        <br><br>
                        NMC No:<?php echo $doctor_nmc; ?>
                    </td>
                    <td rowspan="1" colspan="3"></td>
                </tr>
                <tr>
                    <td>Name:<?php echo $name; ?>
                        <br><br>
                        Age:<?php echo $age; ?>
                        <br><br>
                        Gender:<?php echo $gender; ?>
                    </td>
                    <td colspan="3">
                        Lab report:<?php echo time(); ?>
                        <br><br>
                        Registerd Date:<?php echo $registered_date; ?>
                        <br><br>
                        Reported Date:<?php echo $reported_date; ?>
                    </td>
                </tr>
                <tr>
                    <td>Test Name:</td>
                    <td>Result</td>
                    <td>Unit</td>
                    <td>Range</td>
                </tr>
                <tr>
                    <td><?php echo $test_name; ?></td>
                    <td><?php echo $result; ?></td>
                    <td><?php echo $unit; ?></td>
                    <td><?php echo $range; ?></td>
                </tr>
            </table>
            <!-- End of Report -->

        <?php
            $body = ob_get_clean();

            $body = iconv("UTF-8", "UTF-8//IGNORE", $body);

            include("mpdf/vendor/autoload.php");

            $mpdf = new \Mpdf\Mpdf();

            //write html to pdf
            $stylesheet = file_get_contents('pdf-style.css');

            $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($body, \Mpdf\HTMLParserMode::HTML_BODY);

            //output pdf
            $mpdf->Output('test.pdf', 'F');
        }
        ?>

    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src=" bootstrap-4.6.0-dist/js/jquery.js"></script>

    <script src="bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>