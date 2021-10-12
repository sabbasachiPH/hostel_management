<?php
include('connection.php');
if (isset($_GET['seat_id']) && $_GET['student_id']) {
    $seat_id = $_GET['seat_id'];
    $student_id = $_GET['student_id'];

    $sql = "UPDATE seat_information 
            SET seat_status = 3, student_id = $student_id
            WHERE seat_id=$seat_id";

    $sql2 = "UPDATE userregistration
            SET seat_id = $seat_id
            WHERE id={$student_id}";

    $result = $conn->query($sql);


    if ($result == 1) {

        echo "Application Granted !!";
        echo "<meta http-equiv='refresh' content='0.5;url=seat_booking_info_approve_listview.php'>";
    }
}
