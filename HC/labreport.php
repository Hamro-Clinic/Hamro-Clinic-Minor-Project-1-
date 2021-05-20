<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="admin/bootstrap-4.6.0-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="admin/css/style.css">

    <!-- Font Awesome CSS  -->
    <link rel="stylesheet" href="admin/fontawesome/all.min.css">
    <link rel="stylesheet" href="admin/fontawesome/fontawesome.min.css">

    <title>Lab Report | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="admin/images/icon.ico" />
</head>

<body>

    <div class="container-fluid px-0 d-flex flex-column justify-content-between" style="min-height:100vh;">
        <div class="except-footer">

            <!-- body parts -->
            <div class="bg-labtest" style="min-height:95vh;">
                <?php $page = 'lab';
                include 'nav.php'; ?>
                <div class="labtest-searchbox d-flex flex-column align-items-center">
                    <h1 style="color:#001f3f;text-align:center">Lab Report:</h1>
                    <hr>
                    <form method="POST" class="w-100 d-flex flex-column align-items-center">
                        <input type="text" class="form-control form-control-lg" placeholder="Search Your Labreport Here... " name="keyword">
                        <input type="submit" name="search" class="btn-lg btn-success my-3" value="Search">
                    </form>
                </div>

                <?php
                $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error());
                if (isset($_POST['search'])) {
                    $key = $_POST['keyword'] . ".pdf";

                    $sql = "SELECT * FROM report WHERE file='$key'";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) { ?>
                            <div class="container alert alert-dark d-flex flex-column align-items-center">
                                <div class="row my-2">
                                    <p class="text-success text-center h4">Report Found</p>
                                </div>
                                <div class="row my-2">
                                    <span class="m-2"><?php echo $row['file']; ?></span>
                                    <a href="admin/reports/<?php echo $row['file']; ?>" class="btn btn-warning" target="_blank">View</a>
                                    <a href="download.php?file=admin/reports/<?php echo $row['file']; ?>" class="btn btn-danger mx-2">Download</a>
                                </div>

                            </div>
                <?php  }
                    } else {
                        echo "<div class='container alert alert-dark text-center text-danger h4'>No Report Found</div>";
                    }
                }
                ?>

            </div>
            <!-- body parts ends here -->

        </div>

        <div class="footer-part">
            <?php include 'footer.php'; ?>
        </div>

    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


    <script src="admin/bootstrap-4.6.0-dist/js/jquery.js"></script>
    <script src="admin/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>