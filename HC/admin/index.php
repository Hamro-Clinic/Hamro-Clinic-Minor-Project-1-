<?php include "admin_server.php"; ?>
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

    <title>Log-in | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="images/icon.ico" />
</head>

<body>
    <div class="d-flex justify-content-center align-items-center log-main-div" style="min-height: 100vh;">
        <!-- login form -->
        <div class="container shadow-lg p-md-2 a-login">
            <h3 class="text-center">Admin Login Panel</h3>
            <div class="row p-md-3">
                <div class="col mx-auto">
                    <form action="index.php" method="POST">
                        <div class="form-group">
                            <i class="fas fa-user"></i>
                            <label for="email" class="col-auto col-form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email..." name="email">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-key"></i>
                            <label for="password" class="col-auto col-form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="show" onclick="showFunction()">
                            <label class="form-check-label" for="show">Show Password</label>
                        </div>
                        <input type="submit" name="login_admin" class="btn btn-primary my-2" value="Login">
                        <?php include "errors.php"; ?>
                        <div class="my-2 d-flex justify-content-end">
                            <a href="../home.php" class="btn btn-outline-dark">Home</a>
                        </div>

                    </form>
                </div>

            </div>
        </div>
        <!-- login form ends -->
    </div>

    <script>
        function showFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <script src="bootstrap-4.6.0-dist/js/jquery.js"></script>
    <script src="bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>