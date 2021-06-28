<?php
$conn = mysqli_connect("localhost", "root", "", "hcc_db") or die("Unable to connect" . mysqli_connect_error() . "<br>");
date_default_timezone_set('Asia/Kathmandu');
$current_date = date('Y-m-d');
$current_time = date("H:i:s");
$condition = $_POST['s_date'];
$doctor_id = $_POST['d_id'];

//Check Select Condition
if ($condition == 'Today') {
    $dis_sql = "SELECT * FROM appointment WHERE doctor_id=$doctor_id AND appointment_date='$current_date'";
} else if ($condition == 'Upcoming') {
    $dis_sql = "SELECT * FROM appointment WHERE doctor_id=$doctor_id AND appointment_date>='$current_date'";
} else if ($condition == 'All') {
    $dis_sql = "SELECT * FROM appointment WHERE doctor_id=$doctor_id";
}
//End of checking select condition

$dis_res = mysqli_query($conn, $dis_sql);
if (mysqli_num_rows($dis_res) > 0) {
    $sn = 0;
    while ($dis_row = mysqli_fetch_assoc($dis_res)) {
?>
        <tr>
            <td><?php echo ++$sn; ?></td>
            <td><?php echo $dis_row['appointment_date']; ?></td>
            <td><?php echo $dis_row['day']; ?></td>
            <td>
                <?php
                $dis_time =  date("h:i A", strtotime($dis_row['appointment_time']));
                echo $dis_time;
                ?>
            </td>
            <td><?php echo $dis_row['reason']; ?></td>
            <td><?php echo $dis_row['patient_id']; ?></td>
        </tr>
<?php
    }
}

?>