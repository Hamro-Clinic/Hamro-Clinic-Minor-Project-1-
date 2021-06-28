<?php
session_start();

if (!isset($_SESSION['doctor_email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['doctor_email']);
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
    <link href="../admin/bootstrap-4.6.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin/fontawesome/all.min.css">
    <link rel="stylesheet" href="../admin/fontawesome/fontawesome.min.css">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="../admin/css/admin-style.css">

    <title>Dashboard - Doctor | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="../admin/images/icon.ico" />
</head>

<body>
    <?php include 'doctor-nav.php'; ?>
    <div class="main_content p-sm-0 p-md-2">
        <div class="text-current_page">Dashboard</div>
        <hr>
        <?php
        $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error() . "<br>");
        ?>
        <div class="container-fluid dashboard-cards p-md-2">
            <div class="card-1">
                <h3>Today's Appointments</h3>
                <h3>9</h3>
            </div>
            <div class="card-3">
                <h3>Upcomming Appointments</h3>
                <h3>20</h3>
            </div>
        </div>
    </div>

    <script src="../admin/bootstrap-4.6.0-dist/js/jquery.js"></script>

    <script src="../admin/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>