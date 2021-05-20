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

  <link rel="stylesheet" href="admin/fontawesome/all.min.css">
  <link rel="stylesheet" href="admin/fontawesome/fontawesome.min.css">

  <title>Contact | Hamro Clinic</title>
  <link rel="shortcut icon" type="image/ico" href="admin/images/icon.ico" />

  <script>
    function validateForm() {
      var name = document.forms["myForm"]["name"].value;
      var email = document.forms["myForm"]["email"].value;
      var query = document.forms["myForm"]["query"].value;

      var count = 0;

      if (name == "") {
        document.getElementById("para-name").innerHTML = "Name must be filled out";
        count++;
      }

      if (email == "") {
        document.getElementById("para-email").innerHTML = "Email must be filled out";
        count++;
      }

      if (query == "") {
        document.getElementById("para-query").innerHTML = "Please, write your query";
        count++;
      }

      if (count != 0) {
        return false;
      }

    }
  </script>
</head>

<body>

  <div class="container-fluid px-0 d-flex flex-column justify-content-between" style="min-height:100vh;">
    <div class="except-footer">
      <?php $page = 'contact';
      include 'nav.php'; ?>
      <div class="container shadow-lg my-5">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-12 d-flex flex-column justify-content-center">
            <span><i class="fas fa-mobile-alt"></i>&nbsp;9843807054</span><br>
            <span><i class="fas fa-envelope"></i>&nbsp;hamroclinic@gmail.com</span><br>
            <span><i class="fas fa-map-marker"></i>&nbsp;Mid-Banedswor,Kathmandu,Nepal</span><br>
          </div>
          <div class="col-lg-8 col-md-6 col-12 py-3 contact-div">
            <p class="h1 text-center font-weight-normal">CONTACT US</p>
            <form name="myForm" class="w-75 mx-auto" onsubmit="return(validateForm())" method="post">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
                <p id="para-name" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
                <p id="para-email" class="text-danger"></p>
              </div>
              <div class="form-group">
                <label for="query">Query</label>
                <textarea name="query" id="query" class="w-100" rows="5"></textarea>
                <p id="para-query" class="text-danger"></p>
              </div>
              <input type="submit" class="btn btn-danger my-1" name="submit" value="Ask">
            </form>

            <?php
            $con = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error());

            if (isset($_POST['submit'])) {
              $fullname = $_POST['name'];
              $email = $_POST['email'];
              $query = $_POST['query'];

              $sql = "INSERT INTO contact (email,name,query,status) VALUES ('$email','$fullname','$query','Unreplied')";

              $result = mysqli_query($con, $sql);

              if ($result) {

                echo "<div class='text-success'>Your Query is Successfully Send</div>";
              } else {
                echo "<div class='text-danger'>Error Occured</div>";
              }

              mysqli_close($con);
            }
            ?>

          </div>
        </div>
      </div>
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