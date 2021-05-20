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

    <!-- Jquery Datatables  -->
    <link href="bootstrap-4.6.0-dist/css/datatables.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/all.min.css">
    <link rel="stylesheet" href="fontawesome/fontawesome.min.css">

    <!-- Custom CSS  -->
    <link rel="stylesheet" href="css/admin-style.css">

    <title>Manage User - Admin | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="images/icon.ico" />

    <script>
        function validateForm() {
            var fname = document.forms["myForm"]["fname"].value;
            var lname = document.forms["myForm"]["lname"].value;
            var email = document.forms["myForm"]["email"].value;

            // atpos = emailID.indexOf("@");
            // dotpos = emailID.lastIndexOf(".");

            var password = document.forms["myForm"]["password"].value;
            var cpassword = document.forms["myForm"]["cpassword"].value;
            var phone = document.forms["myForm"]["phone"].value;
            // var dob = document.forms["myForm"]["dob"].value;
            var count = 0;

            if (fname == "") {
                document.getElementById("para-fname").innerHTML = "First Name must be filled out";
                count++;
            }

            if (lname == "") {
                document.getElementById("para-lname").innerHTML = "Last Name must be filled out";
                count++;
            }

            if (email == "") {
                document.getElementById("para-email").innerHTML = "Email must be filled out";
                count++;

            }

            if (password != cpassword) {
                document.getElementById("para-cpassword").innerHTML = "Both Password area must be same";
                document.getElementById("para-password").innerHTML = "Both Password area must be same";
                count++;

            }

            if (password == "") {
                document.getElementById("para-password").innerHTML = "Password must be filled out";
                count++;

            }

            if (cpassword == "") {
                document.getElementById("para-cpassword").innerHTML = "Password must be filled out";
                count++;

            }



            if (phone.length != 10 || isNaN(phone)) {
                document.getElementById("para-phone").innerHTML = "Please enter your correct phone number";
                count++;

            }

            if (count != 0) {
                return false;
            }

        }
    </script>
</head>

<body>
    <?php include 'admin-nav.php'; ?>
    <div class="main_content p-sm-0 p-md-2">
        <div class="text-current_page">Manage User</div>
        <hr>
        <p style="cursor:default;visibility:hidden;">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus, minima nesciunt veritatis quas et alias quaerat amet, molestiae ea deserunt, obcaecati labore fugit exercitationem omnis nisi quod facere accusantium est?</p>
        <?php
        $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error());

        // initializing variable
        $email    = "";
        $errors = array();


        // REGISTER ADMIN
        if (isset($_POST['reg_admin'])) {

            // receive all input values from the form

            $email = mysqli_real_escape_string($con, $_POST['email']);

            $password = mysqli_real_escape_string($con, $_POST['password']);
            $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

            $first_name = mysqli_real_escape_string($con, $_POST['fname']);
            $last_name = mysqli_real_escape_string($con, $_POST['lname']);
            $gender = mysqli_real_escape_string($con, $_POST['gender']);
            $dob = mysqli_real_escape_string($con, $_POST['dob']);
            $phone_number = mysqli_real_escape_string($con, $_POST['phone']);

            // first check the database to make sure 
            // a user does not already exist with the same email

            $check_email = "SELECT * FROM admin 
                WHERE email='$email'";

            $result = mysqli_query($con, $check_email);

            $row = mysqli_fetch_assoc($result);

            if ($row) { // if user exists

                if ($row['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }

            // Finally, register user if there are no errors in the form

            if (count($errors) == 0) {

                $password = md5($password); //encrypt the password before saving in the database
                $cpassword = md5($cpassword); //encrypt the password before saving in the database

                $query = "INSERT INTO admin (first_name,last_name,gender,dob,phone_number,email,password,cpassword,image) 
                    VALUES('$first_name','$last_name','$gender','$dob',$phone_number,'$email','$password','$cpassword','admin-photo.png')";

                $res = mysqli_query($con, $query);
                if ($res) {
                    echo "<div class='text-success'>Successfully Added</div>";
                } else {
                    echo "<div class='text-danger'>Failed to Add</div>";
                }
            }
        }

        $sn = 0;

        //code to delete selected record
        if (isset($_POST['del'])) {

            $count_admin = "SELECT * FROM admin";

            $result = mysqli_query($con, $count_admin);
            if (mysqli_num_rows($result) == 1) {

                echo "<div class='text-danger'>Unable to Delete Last Admin</div>";
            } else {
                $id = $_POST['id'];
                $email = $_SESSION['email'];
                $check_self = "SELECT * FROM admin WHERE email='$email'";
                $self_result = mysqli_query($con, $check_self);
                $row = mysqli_fetch_assoc($self_result);
                if ($id = $row['admin_id']) {
                    $delete_query = "DELETE FROM admin WHERE admin_id=$id";

                    $res = mysqli_query($con, $delete_query);
                    unset($_SESSION['email']);
                    if ($res) {
                        echo "<div class='text-success'>You have deleted your own account</div>";
                    } else {
                        echo "<div class='text-danger'>Failed to delete your own account</div>";
                    }
                } else {
                    $delete_query = "DELETE FROM admin WHERE admin_id=$id";

                    $res = mysqli_query($con, $delete_query);

                    if ($res) {
                        echo "<div class='text-success'>Succesfully deleted</div>";
                    } else {
                        echo "<div class='text-danger'>Failed to delete</div>";
                    }
                }
            }
        }
        ?>
        <!--Insert Modal -->
        <div class="modal fade Modal1" id="insertModal" role="dialog">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="myForm" action="admin-manage.php" onsubmit="return(validateForm())" method="POST">
                            <div class="row my-2">
                                <div class="form-group col-sm-6">
                                    <label for="fname">First Name:</label>
                                    <input type="text" class="form-control" placeholder="First Name..." name="fname" id="fname">
                                    <p id="para-fname" class="text-danger"></p>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="lastname">Last Name:</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Last Name..." name="lname">
                                    <p id="para-lname" class="text-danger"></p>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="form-group col-auto">
                                    <label for="">Gender:</label>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="Male" id="male" name="gender" checked="checked">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="Female" id="female" name="gender">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="Others" id="others" name="gender">
                                        <label class="form-check-label" for="others">Others</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-auto">
                                    <label for="dob">Date of Birth:</label>
                                    <input type="date" class="form-control" id="dob" name="dob">
                                    <p id="para-dob" class="text-danger"></p>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-auto">
                                    <label for="phone">Phone Number:</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Your Mobile Number...">
                                    <p id="para-phone" class="text-danger"></p>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="form-group col-sm-6">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="Your Email..." name="email" value="<?php echo $email; ?>">
                                    <p id="para-email" class="text-danger"></p>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="form-group col-sm-6">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control" id="password" placeholder="Enter Your Password Here.." name="password">
                                    <p id="para-password" class="text-danger"></p>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="cpassword">Confirm Password:</label>
                                    <input type="password" class="form-control" id="cpassword" placeholder="Confirm Your Password Here.." name="cpassword">
                                    <p id="para-cpassword" class="text-danger"></p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-success" value="Add" name="reg_admin">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Insert Modal Ends -->

        <?php include "errors.php"; ?>
        <div class="container-fluid table-responsive shadow-lg p-md-1 bg-white">
            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#insertModal">
                <span><i class="fas fa-plus-square"></i></span> Add Admin
            </button>
            <table class="table table-bordered display" id="display-admin">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_admin = "SELECT * FROM admin";
                    $result = mysqli_query($con, $show_admin);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo ++$sn; ?></td>
                                <td><?php echo $row['first_name']; ?></td>
                                <td><?php echo $row['last_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['phone_number']; ?></td>
                                <td>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#dModal<?php echo $row['admin_id'] ?>" data-toggle="tooltip" title="Delete">
                                        <i class="far fa-trash-alt"></i>
                                    </button>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="dModal<?php echo $row['admin_id'] ?>" tabindex="-1" aria-labelledby="dModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="dModalLabel">Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="admin-manage.php" method="POST" enctype="multipart/form-data">
                                                        <input type="hidden" name="id" value="<?php echo $row['admin_id']; ?>">
                                                        Are you sure?
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <input type="submit" value="Yes" name="del" class="btn btn-primary">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End of Delete Modal -->
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src="bootstrap-4.6.0-dist/js/jquery.js"></script>
    <script src="bootstrap-4.6.0-dist/js/datatables.min.js"></script>

    <script src="bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#display-admin").DataTable();
        });
    </script>
</body>

</html>