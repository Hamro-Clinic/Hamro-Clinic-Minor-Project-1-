<?php
// session_start();

// if (!isset($_SESSION['email'])) {
//     $_SESSION['msg'] = "You must log in first";
//     header('location: index.php');
// }
// if (isset($_GET['logout'])) {
//     session_destroy();
//     unset($_SESSION['email']);
//     header("location: index.php");
// }
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

    <title>Dashboard - Admin | Hamro Clinic</title>
    <link rel="shortcut icon" type="image/ico" href="images/icon.ico" />
</head>

<body>
    <?php include 'admin-nav.php'; ?>
    <div class="main_content p-sm-0 p-md-2">
        <div class="text-current_page">Dashboard</div>
        <hr>
        <?php
        $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error() . "<br>");
        if (isset($_POST['del'])) {
            $id = $_POST['id'];

            $delete_query = "DELETE FROM department WHERE department_id=$id";

            $re = mysqli_query($con, $delete_query);

            if ($re) {
                echo "<div class='d-inline-block alert alert-success text-success'>Succesfully deleted</div>";
            } else {
                echo "<div class='d-inline-block alert alert-danger text-danger'>Failed to delete</div>";
            }
        }
        if (isset($_POST['edit'])) {
            $id = $_POST['id'];
            $dept = $_POST['department'];

            $update = "UPDATE department 
            SET department_name='$dept'
            WHERE department_id=$id";

            $re = mysqli_query($con, $update);

            if ($re) {
                echo "<div class='d-inline-block alert alert-success text-success'>Succesfully updated</div>";
            } else {
                echo "<div class='d-inline-block alert alert-danger text-danger'>Failed to update" . mysqli_error($con) . "</div>";
            }
        }

        if (isset($_POST['ins-submit'])) {
            $depart = $_POST['department'];

            $insert_sql = "INSERT INTO department(department_name) VALUES ('$depart')";

            $res = mysqli_query($con, $insert_sql);

            if ($res) {
                echo "<div class='alert alert-success text-success'>Inserted</div>";
            } else {
                echo "<div class='alert alert-danger text-danger'>Failed</div>";
            }
        }

        ?>
        <div class="contanier bg-white my-5 p-md-3 p-1">
            <form action="admin-department.php" method="post">
                <div class="form-group col-md-6 mx-auto">
                    <label>Department:</label>
                    <input type="text" name="department" class="form-control my-3">
                    <input type="submit" name="ins-submit" value="Add Department" class="btn btn-success my-3" />
                </div>
            </form>
        </div>
        <div class="table-responsive container bg-white p-1 my-5">
            <table class="table table-bordered">
                <tr>
                    <th>SN</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>

                <?php
                $sn = 0;

                $sql2 = "SELECT * FROM department";
                $res2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($res2) > 0) {
                    while ($row = mysqli_fetch_assoc($res2)) {
                ?>
                        <tr>
                            <td><?php echo ++$sn; ?></td>
                            <td><?php echo $row['department_name']; ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dModal<?php echo $row['department_id'] ?>">
                                    Delete
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="dModal<?php echo $row['department_id'] ?>" tabindex="-1" aria-labelledby="dModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dModalLabel">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="admin-department.php" method="post">
                                                    <input type="hidden" name="id" value="<?php echo $row['department_id']; ?>">
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

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uModal<?php echo $row['department_id'] ?>">
                                    Update
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="uModal<?php echo $row['department_id'] ?>" tabindex="-1" aria-labelledby="dModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="dModalLabel">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="admin-department.php" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?php echo $row['department_id']; ?>">
                                                    Department:<input type="text" name="department" class="form-control" value="<?php echo $row['department_name']; ?>">



                                                    <div class=" modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                        <input type="submit" value="Update" name="edit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>


                        </tr>
                <?php
                    }
                } else {
                    echo "There  are no Department to edit at this moment";
                }
                ?>
            </table>
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