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

  <title>Home | Hamro Clinic</title>
  <link rel="shortcut icon" type="image/ico" href="admin/images/icon.ico" />
</head>

<body>

  <!-- Modal -->
  <div class="modal fade" id="about" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">About us</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-justify p-md-3 my-3">
            Hamro Clinic Pvt. Ltd. is a polyclinic based health facility located at Mid-Banehswor, Kathmandu. It was established in 2021, with the aim to provide basic health and specialist services to the neighboring localities as well as to the public of the Kathmandu Valley. The polyclinic is easily accessible via public transports.<br><br>

            Our services include Doctor consultations, pathology lab, USG, digital X-rays, health packages as well as minor surgeries, physiotherapy and Dental Clinic. Our polyclinic provides Specialists Consultations in the field of Internal Medicine, Heart Clinic, Diabetes, Thyroid & Hormone Clinic, Chest Clinic, Child Health, Women’s Health, Orthopedic clinic, Neuro Clinic, Skin & Aesthetic Clinic, ENT & Audiology, Mental Health and Dental clinic. Our specialists are affiliated to the major national level hospitals and health institutes.<br><br>

            Our aim is to provide quality health & diagnostic services at a reasonable affordable price.<br><br>

            We welcome advices, suggestions & feedbacks especially from the public who have taken services from our polyclinic.. The clinic is run by team of experts in medical field to provide best of service to peoples health in Nepal.
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Ends -->

  <!-- Modal -->
  <div class="modal fade" id="appointment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabel">Make Appointment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="text-center p-md-3 my-3 h1">
            Comming Soon...
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Ends -->

  <div class="container-fluid px-0 d-flex flex-column justify-content-between" style="min-height:100vh;">
    <div class="except-footer">
      <div class="bg-home col-12 px-0">
        <?php $page = 'home';
        include 'nav.php'; ?>
        <div class="container-fluid p-md-3">
          <div class="row" style="min-height: 600px;">
            <div class="col-md-6 d-flex justify-content-center align-items-center flex-column">
              <div class="display-4 my-3">Lets Cure Together</div>
              <button class="btn btn-lg btn-outline-dark my-3" data-toggle="modal" data-target="#appointment">Make Appointment</button>
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
              <img src="admin/images/home.jpg" class="img-fluid rounded">
            </div>
          </div>
        </div>
        <div class="container">
          <div class="about-section row my-5">
            <div class="col-md-6 p-1 p-md-3">
              <img src="admin/images/about.jpg" class="img-fluid rounded">
            </div>
            <div class="col-md-6 p-1 p-md-3">
              <h2 class="text-center"><u>ABOUT US</u></h2>
              <div class="text-justify my-5">
                Hamro Clinic Pvt. Ltd. is a polyclinic based health facility located at Mid-Banedswor, Kathmandu. It was established in 2021, with the aim to provide basic health and specialist services to the neighboring localities as well as to the public of the Kathmandu Valley. The polyclinic is easily accessible via public transports.
              </div>
              <button class="btn btn-outline-dark my-2" data-toggle="modal" data-target="#about">Learn More...</button>
            </div>
          </div>
          <div class="services-section row my-5">
            <h2 class="text-center mx-auto my-3">Our Services</h2>
            <div class="cards-sec d-flex justify-content-center flex-wrap">
              <div class="card m-2 bg-dark text-white" style="width: 300px;">
                <div class="card-body">
                  <div class="mx-auto text-center display-4 my-2"><i class="fas fa-clinic-medical"></i></i></div>
                  <h5 class="card-title text-center">Whole Body Checkup</h5>
                </div>
              </div>
              <div class="card m-2 bg-dark text-white" style="width: 300px;">
                <div class="card-body">
                  <div class="mx-auto text-center display-4 my-2"><i class="fas fa-notes-medical"></i></div>
                  <h5 class="card-title text-center">Get Report Quick Online</h5>
                </div>
              </div>
              <div class="card m-2 bg-dark text-white" style="width: 300px;">
                <div class="card-body">
                  <div class="mx-auto text-center display-4 my-2"><i class="fas fa-user-md"></i></div>
                  <h5 class="card-title text-center">See a Doctor or Specialist</h5>
                </div>
              </div>
              <div class="card m-2 bg-dark text-white" style="width: 300px;">
                <div class="card-body">
                  <div class="mx-auto text-center display-4 my-2"><i class="fas fa-cut"></i></div>
                  <h5 class="card-title text-center">Minor Surguries or Procedures</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
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