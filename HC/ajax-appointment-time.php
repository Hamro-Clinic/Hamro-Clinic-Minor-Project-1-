<?php

$conn = mysqli_connect('localhost', 'root', '', 'hcc_db') or die("Unable to connect" . mysqli_connect_error());

date_default_timezone_set('Asia/Kathmandu');
$date = $_POST['date'];
$appointment_date = date('Y/m/d', strtotime($date));
$doctor_id = $_POST['doctor_id'];
$appointment_day = date("l", strtotime($appointment_date));

$sql = "SELECT * FROM schedule JOIN doctor
        ON(schedule.doctor_id=doctor.doctor_id)
    	WHERE schedule.doctor_id=$doctor_id AND day = '$appointment_day'";

$res = mysqli_query($conn, $sql);
?>

<div class="col-md-6 col-12 form-group">
    <label for="">Time</label>
    <select name="appointment_time" class="form-control">
        <?php
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $start_time = $row['start_time'];
            $end_time = $row['end_time'];
            $range = range(strtotime($start_time), strtotime($end_time), 30 * 60);
            foreach ($range as $time) {
        ?>
                <option value="<?php echo date("H:i:s", $time); ?>">
                    <?php echo date("h:i A", $time); ?>
                </option>
        <?php
            }
        }
        ?>
    </select>
</div>
<div class="col-md-6 col-12 form-group">
    <label for="">Day</label>
    <input type="text" name="appointment_day" class="form-control" value="<?php echo $appointment_day; ?>" disabled>
</div>