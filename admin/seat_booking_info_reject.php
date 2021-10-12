<?php
include('connection.php');

if (isset($_GET['seat_id']) && $_GET['student_id']) {
    $seat_id = $_GET['seat_id'];
    $student_id = $_GET['student_id'];

    $sql = "UPDATE seat_information 
            SET seat_status = 1, student_id = NULL
            WHERE seat_id=$seat_id";

    $result = $conn->query($sql);

    if ($result == 1) {

        echo "Application Rejected !!";
        echo "<meta http-equiv='refresh' content='0.5;url=seat_booking_info_approve_listview.php'>";
    }
}
