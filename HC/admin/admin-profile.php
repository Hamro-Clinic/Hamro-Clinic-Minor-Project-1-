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

    <title>Profile - Admin | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="images/icon.ico" />
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error());

    $email = $_SESSION['email'];

    $sql1 = "SELECT * FROM admin WHERE email='$email'";

    $res1 = mysqli_query($con, $sql1);

    if (isset($_POST['update_photo'])) {
        $id = $_POST['id'];

        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $filesize = $_FILES["image"]["size"];

        $filearr = explode(".", $filename);
        $fileExt = strtolower(end($filearr));

        $new_filename = time() . 'profile.' . $fileExt;
        $folder = "images/" . $new_filename;
        $allowedExtn = ["png", "jpg", "jpeg", "gif"];

        if (!in_array($fileExt, $allowedExtn)) {
            echo "<div class='text-danger alert alert-danger' style='position:absolute;top:10px;right:10px;z-index:101;'>Unable to recognize Image<br>Only(png,jpg,jpeg,gif) are Allowed</div>";
        } elseif ($filesize > 1000000) {
            echo "<div class='text-danger alert alert-danger' style='position:absolute;top:10px;right:10px;z-index:101;'>Image is to large(Should be less than 1MB)</div>";
        } else {
            if (move_uploaded_file($tempname, $folder)) {
                $update_query = "UPDATE admin SET image='$new_filename' WHERE admin_id=$id";

                $res = mysqli_query($con, $update_query);

                if ($res) {
                    echo "<div class='text-success alert alert-success' style='position:absolute;top:10px;right:10px;z-index:101;'>Succesfully updated</div>";
                } else {
                    echo "<div class='text-danger alert alert-danger' style='position:absolute;top:10px;right:10px;z-index:101;'>Failed to update</div>";
                }
            }
        }
    }

    if (isset($_POST['update_password'])) {
        $id = $_POST['id'];
        $old_password = $_POST['old_password'];
        $old_passwordmd5 = md5($old_password);

        $new_password = $_POST['new_password'];
        $new_cpassword = $_POST['new_cpassword'];

        $check = "SELECT * FROM admin WHERE admin_id=$id";

        $result = mysqli_query($con, $check);

        $row = mysqli_fetch_assoc($result);

        if ($row['password'] == $old_passwordmd5 && $new_cpassword == $new_password && $new_password != "") {
            $new_password = md5($new_password);
            $new_cpassword = md5($new_cpassword);
            $update_query = "UPDATE admin SET password='$new_password',cpassword='$new_cpassword' WHERE admin_id=$id";

            $res = mysqli_query($con, $update_query);

            if ($res) {
                echo "<div class='text-success alert alert-success' style='position:absolute;top:10px;right:10px;z-index:101;'>Succesfully changed</div>";
            } else {
                echo "<div class='text-danger alert alert-danger' style='position:absolute;top:10px;right:10px;z-index:101;'>Unable to change password</div>";
            }
        } else {
            echo "<div class='text-danger alert alert-danger' style='position:absolute;top:10px;right:10px;z-index:101;'>Unable to change password</div>";
        }
    }

    $row1 = mysqli_fetch_assoc($res1);

    ?>
    <?php include 'admin-nav.php'; ?>
    <div class="main_content p-sm-0 p-md-2">
        <div class="text-current_page">Admin Profile</div>
        <hr>
        <p style="cursor:default;visibility:hidden;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus, minima nesciunt veritatis quas et alias quaerat amet, molestiae ea deserunt, obcaecati labore fugit exercitationem omnis nisi quod facere accusantium est?</p>
        <div class="container shadow-lg text-justify profile-div p-md-5 bg-white">
            <div class="row">
                <div class="col-sm-12 col-md-6 d-flex flex-wrap flex-column align-content-center justify-content-center">
                    <?php
                    $image = $row1['image'];
                    echo "<img src='images/$image' height='200px' width='200px' style='border-radius:50%;'>";
                    ?>
                    <button class="btn my-2 btn-dark" data-toggle="modal" data-target="#uModal<?php echo $row1['admin_id'] ?>">Upload Photo</button>

                    <!--Start of Photo Update Modal -->
                    <div class="modal fade Modal2" id="uModal<?php echo $row1['admin_id'] ?>" tabindex="-1" aria-labelledby="uModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uModalLabel">Update Your Photo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="myForm" action="admin-profile.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row1['admin_id']; ?>">

                                        <div class="row mb-3 mt-4">
                                            <div class="form-group col-12">
                                                <label for="photo">Upload Photo:</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <input type="submit" value="Update" name="update_photo" class="btn btn-success">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of photo update modal -->

                    <button class="btn my-2 btn-dark" data-toggle="modal" data-target="#upModal<?php echo $row1['admin_id'] ?>">Change Password</button>
                </div>

                <!-- Start of Password Update Modal -->
                <div class="modal fade Modal3" id="upModal<?php echo $row1['admin_id'] ?>" tabindex="-1" aria-labelledby="dModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="upModalLabel">Change Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="admin-profile.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?php echo $row1['admin_id']; ?>">
                                    <div class="form-group">
                                        <label>Old Password:</label>
                                        <input type="password" class="form-control" name="old_password">
                                    </div>
                                    <div class="form-group">
                                        <label>New Password:</label>
                                        <input type="password" class="form-control" name="new_password">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password:</label>
                                        <input type="password" class="form-control" name="new_cpassword">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <input type="submit" value="Change" name="update_password" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Password Update Modal -->

                <div class="col-sm-12 col-md-6">
                    <hr>
                    <div>
                        Full Name : <?php echo $row1['first_name'] . " " . $row1['last_name']; ?>
                    </div>
                    <hr>
                    <div>
                        Gender : <?php echo $row1['gender']; ?>
                    </div>
                    <hr>
                    <div>
                        Email : <?php echo $row1['email']; ?>
                    </div>
                    <hr>
                    <div>
                        Date of Birth : <?php echo $row1['dob']; ?>
                    </div>
                    <hr>

                    <div>
                        Mobile : <?php echo $row1['phone_number']; ?>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src="bootstrap-4.6.0-dist/js/jquery.js"></script>

    <script src="bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>