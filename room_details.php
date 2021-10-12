<?php
session_start();
// print_r($_SESSION['id']);
// die;
include('admin/connection.php');
include('includes/checklogin.php');
check_login();
$title = "My Room";

include("includes/header_resources.php");
// include("admin/connection.php");
include("admin/function.php");

$student_id = $_SESSION['id'];

$hall_list = hall_list();
$student_list = student_list();
$room_list = room_list();
$seat_list = seat_list();

$total_hall = count($hall_list);
$total_room = count($room_list);
$total_student = count($student_list);

$total_seat = count($seat_list['total_seat']);
$not_alloted_seat = count($seat_list['available_seat']);
$alloted_seat = count($seat_list['alloted_seat']);
$pending_seat = $total_seat - $alloted_seat - $not_alloted_seat;
// echo "<pre>";
// print_r(count($seat_list['total_seat']));
// print_r(count($seat_list['available_seat']));
// print_r($seat_list());
// print_r($room_seat_list['seat']);
// die();

//include("includes/header.php"); 
?>

<div class="dashboard">
    <div class="dasHeader"><?php include("includes/header.php"); ?></div>
    <div class="dasSidebar"><?php include("includes/sidebar.php"); ?></div>
    <div class="dasMain d-flex flex-wrap align-items-start p-3">
        <?php
        $i = 0;

        $sql = "SELECT 
                    si.seat_id AS seat_id,
                    si.hall_id AS hall_id,
                    si.floor_id AS floor_id,
                    si.room_id AS room_id,
                    si.seat_no as seat_no,
                    si.student_id as student_id,
                    ssi.status as seat_status
                FROM seat_information si
                LEFT JOIN seat_status_information ssi 
                ON si.seat_status = ssi.status_id
                WHERE room_id IN (SELECT room_id FROM seat_information WHERE student_id = {$student_id})
                ORDER BY seat_no
                ";
        $result = $conn->query($sql);

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


        ?>

        <div class="card text-dark bg-info m-3 " style="max-width: 18rem; ">
            <div class="card-header card-title h2 p-4">
                Total Seat <?php echo $result->num_rows; ?>
            </div>
            <div class="card-body bg-light">
                <h5 class="card-text h6">Full Details <i class="fas fa-arrow-right"></i></h5>
            </div>
        </div>

        <table border='1' <table class='table table-striped' cellpadding='0' align='center'>
            <caption style="caption-side: top;">
                <h3 class="">Available Seat List For Allotment</h3>
            </caption>
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Hall Name</th>
                    <th>Room No</th>
                    <th>Seat No</th>
                    <th>Seat Status</th>
                    <th>Your Roommate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    $i++;
                    $seat_id  = $row['seat_id'];
                    $hall_name  = $hall_info[$row['hall_id']];
                    $room_no  = $room_info[$row['room_id']];
                    $seat_no  = $row['seat_no'];
                    $seat_status  = $row['seat_status'];
                    $student_name  = isset($row['student_id']) ? $student_list[$row['student_id']] : "Not assigned";
                    echo "<tr>
        <td>$i</td>
        <td>$hall_name</td>
        <td>$room_no</td>
        <td>$seat_no</td>
        <td>$seat_status</td>
        <td>$student_name</td>
            
        </tr>";
                } ?>
            </tbody>
        </table>

    </div>
</div>




</div>
</div>
<div class="dasfooter">
    <?php include('includes/footer_resources.php'); ?>
    <?php include("includes/footer.php"); ?></div>
</div>