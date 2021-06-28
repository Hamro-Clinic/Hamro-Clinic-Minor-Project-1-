<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="admin/bootstrap-4.6.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="admin/css/style.css">

    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" href="admin/fontawesome/all.min.css">
    <link rel="stylesheet" href="admin/fontawesome/fontawesome.min.css">

    <title>Doctors | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="admin/images/icon.ico" />

</head>

<body>

    <div class="container-fluid px-0 d-flex flex-column justify-content-between" style="min-height:100vh;">
        <div class="except-footer">
            <?php $page = 'doctor';
            include 'nav.php'; ?>

            <?php
            $con = mysqli_connect("localhost", "root", "", "hcc_db")
                or die("Unable to connect" . mysqli_connect_error());
            ?>

            <?php
            $sql = "SELECT * FROM doctor
                    LEFT JOIN department
                    ON (doctor.department_id=department.department_id)";

            $result = mysqli_query($con, $sql);
            ?>

            <div class="d-flex flex-wrap justify-content-center m-md-5">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card m-5 doctor-cards" style="min-width:300px;max-width:300px;">
                            <?php
                            $image = $row['image'];
                            echo "<img class='card-img-top' src='admin/images/$image' height='200px' width='300px'>"
                            ?>
                            <div class="card-body">
                                <h5 class="card-title text-center">
                                    <?php echo "Dr. " . $row['first_name'] . " " . $row['last_name']; ?>
                                </h5>
                                <p class="card-text">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        NMC Number:
                                        <?php echo $row['nmc']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        Department:
                                        <?php echo $row['department_name']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        Qualification:
                                        <?php echo $row['qualification']; ?>
                                    </li>
                                    <li class="list-group-item">
                                        Schedule:

                                    </li>
                                </ul>
                                </p>
                            </div>
                        </div>

                <?php
                    }
                }
                ?>

                <?php mysqli_close($con); ?>

            </div>



        </div>

        <div class="footer-part">
            <?php include 'footer.php'; ?>
        </div>

    </div>

    <script src="admin/bootstrap-4.6.0-dist/js/jquery.js"></script>
    <script src="admin/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>