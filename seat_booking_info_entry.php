<?php
session_start();

include('admin/connection.php');
include('includes/checklogin.php');
include('admin/function.php');
$hall_list = hall_list();
$floor_list = floor_list();
$room_list = room_list();
check_login();
if (isset($_GET['seat_id'])) {
    $seat_id = $_GET['seat_id'];
    $student_id = $_SESSION['id'];
    // echo "<pre>";
    // print_r($_SESSION['id']);
    // print_r($student_id);
    // die;
    $sql2 = "SELECT * FROM seat_information WHERE student_id= {$student_id}";
    $result2 = $conn->query($sql2);
    if ($result2->num_rows > 0) {
        while ($row = mysqli_fetch_array($result2)) {
            $seat_status = $row['seat_status'];
            $seat_no = $hall_list[$row['hall_id']] . " " . $floor_list[$row['floor_id']] . " " . $room_list[$row['room_id']] . " " . $row['seat_no'];
            if ($seat_status == 2) {
                // echo "You Have Already Applied for a Seat NO={$seat_no}";
                echo "<script>alert('Already you Have Applied for a Seat in {$seat_no}');</script>";
                echo "<meta http-equiv='refresh' content='0;url=seat_booking_info_listview.php'>";
            } else if ($seat_status == 3) {
                echo "<script>alert('No Need to Apply. <br>{$seat_no} seat is already allotted for you.');</script>";
                echo "<meta http-equiv='refresh' content='0;url=seat_booking_info_listview.php'>";
            }
            // echo "<pre>";
            // print_r($row);
            //die();;
        }
    } else {
        $sql = "UPDATE seat_information 
                SET seat_status=2 , student_id={$student_id}
                WHERE seat_id={$seat_id}";
        // echo "<pre>";
        // print_r($sql);
        // die;
        $result = $conn->query($sql);

        if ($result == 1) {
            // echo "Successfully Inserted!";
            echo "<script>alert('Application Successfull !!');</script>";
            echo "Application Successfull !!";
            echo "<meta http-equiv='refresh' content='0;url=seat_booking_info_listview.php'>";
        } else {
            echo "<script>alert('Something Wrong happened!');</script>";
        }
    }
    die;
}
