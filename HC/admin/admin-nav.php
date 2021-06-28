<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <div class="logo_name">
                    Hamro Clinic
                </div>
            </div>
            <i class="fa fa-bars" id="btn-ham"></i>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="admin-dashboard.php" data-toggle="tooltip" title="Dashboard">
                    <i class="fas fa-th-large"></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="admin-profile.php" data-toggle="tooltip" title="Admin Profile">
                    <i class="far fa-address-card"></i>
                    <span class="links_name">Admin Profile</span>
                </a>
            </li>
            <li>
                <a href="admin-labreport.php" data-toggle="tooltip" title="Upload Lab Report">
                    <i class="fas fa-file-upload"></i>
                    <span class="links_name">Upload Lab Report</span>
                </a>
            </li>
            <li>
                <a href="admin-doctors.php" data-toggle="tooltip" title="Doctors">
                    <i class="fas fa-stethoscope"></i>
                    <span class="links_name">Doctors</span>
                </a>
            </li>
            <li>
                <a href="admin-department.php" data-toggle="tooltip" title="Manage Department">
                    <i class="fas fa-building"></i>
                    <span class="links_name">Manage Department</span>
                </a>
            </li>
            <li>
                <a href="admin-manage.php" data-toggle="tooltip" title="Manage User">
                    <i class="fas fa-users"></i>
                    <span class="links_name">Manage User</span>
                </a>
            </li>
            <li>
                <a href="admin-patient.php" data-toggle="tooltip" title="Patients">
                    <i class="fas fa-user-injured"></i>
                    <span class="links_name">Patients</span>
                </a>
            </li>
            <li>
                <a href="admin-contact.php" data-toggle="tooltip" title="Contact">
                    <i class="fas fa-comment-dots"></i>
                    <span class="links_name">Contact</span>
                </a>
            </li>
            <li>
                <a href="admin-Faqs.php" data-toggle="tooltip" title="FAQ's">
                    <i class="fas fa-question"></i>
                    <span class="links_name">FAQ's</span>
                </a>
            </li>
            <li>
                <a href="admin-dashboard.php?logout='1'" data-toggle="tooltip" title="Log out">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>

    <script>
        let btn = document.querySelector("#btn-ham");
        let sidebar = document.querySelector(".sidebar");

        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>

</html>