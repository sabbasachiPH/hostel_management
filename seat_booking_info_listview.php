<?php
session_start();

include('admin/connection.php');
include('includes/checklogin.php');
check_login();
$title = "Apply for Seat";

include("includes/header_resources.php");
include("admin/function.php");

$seat_list = seat_list();

$total_seat = count($seat_list['total_seat']);
$not_alloted_seat = count($seat_list['available_seat']);

// echo "<pre>";
// print_r($_SESSION['id']);
// die;
// print_r(count($seat_list['total_seat']));
// print_r(count($seat_list['available_seat']));
// print_r($seat_list());
// die();

//include("includes/header.php"); 
?>

<div class="dashboard">
    <div class="dasHeader"><?php include("includes/header.php"); ?></div>
    <div class="dasSidebar"><?php include("includes/sidebar.php"); ?></div>
    <div class="dasMain d-flex flex-wrap align-items-start p-3">
        <h3 class="">Available Seat List For Allotment</h3>
        <?php
        $hall_info = array();
        $sql2 = "select * from hall_information";
        $result2 = $conn->query($sql2);
        while ($row2 = mysqli_fetch_array($result2)) {
            $hall_info[$row2['hall_id']] = $row2['hall_name'];
        }

        $room_info = array();
        $sql3 = "SELECT * FROM room_information";
        $result3 = $conn->query($sql3);

        while ($row3 = mysqli_fetch_array($result3)) {
            $room_info[$row3['room_id']] = $row3['room_no'];
        }

        echo "<table border='1' <table class='table table-striped' cellpadding='0' align='center'>";
        echo "<thead>
    <tr>
    <th>SL</th>
    <th>Hall Name</th>
    <th>Room No</th>
    <th>Seat No</th>
    <th>Action</th>
    </tr>
    </thead>";
        echo "<tbody>";

        $i = 0;

        $sql = "SELECT * FROM seat_information 
                    WHERE seat_status = 1 AND student_id IS NULL
                    ORDER BY hall_id,room_id";
        $result = $conn->query($sql);

        while ($row = mysqli_fetch_array($result)) {
            $i++;
            $seat_id  = $row['seat_id'];

            $hall_name  = $hall_info[$row['hall_id']];
            $room_no  = $room_info[$row['room_id']];
            $seat_no  = $row['seat_no'];
            echo "<tr>
        <td>$i</td>
        <td>$hall_name</td>
        <td>$room_no</td>
        <td>$seat_no</td>
    
        <td>
            <a href='seat_booking_info_entry.php?seat_id=$seat_id'  class='btn btn-primary'>Apply</a>
        </td>
        
        </tr>";
        }
        echo "</tbody>";
        echo "</table>";
        ?>
    </div>
</div>
<div class="dasfooter">
    <?php include('includes/footer_resources.php'); ?>
    <?php include("includes/footer.php"); ?></div>
</div>