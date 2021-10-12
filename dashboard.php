<?php
session_start();
include('admin/connection.php');
include('includes/checklogin.php');
check_login();
$title = "Dashboard";

include("includes/header_resources.php");
// include("admin/connection.php");
include("admin/function.php");

$hall_list = hall_list();
$student_list = student_list();
$room_list = room_list();
$seat_list = seat_list();
$seat_status_list = seat_status_list();

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
// die();

//include("includes/header.php"); 
?>

<div class="dashboard">
	<div class="dasHeader"><?php include("includes/header.php"); ?></div>
	<div class="dasSidebar"><?php include("includes/sidebar.php"); ?></div>
	<div class="dasMain d-flex flex-wrap align-items-start p-3">

		<div class="card text-dark bg-info m-3 " style="max-width: 18rem; ">
			<div class="card-header card-title h2 p-4">
				Total Seat <?php echo $total_seat; ?>
			</div>
			<div class="card-body bg-light">
				<h5 class="card-text h6">Full Details <i class="fas fa-arrow-right"></i></h5>
			</div>
		</div>

		<div class="card text-dark bg-info m-3 " style="max-width: 18rem; ">
			<div class="card-header card-title h2 p-4">
				Seat Available <?php echo $not_alloted_seat; ?>
			</div>
			<div class="card-body bg-light text-dark">
				<a href="seat_booking_info_listview.php" target="_blank" class="card-link stretched-link">
					<h5 class="card-text h6">Full Details <i class="fas fa-arrow-right"></i></h5>
				</a>
			</div>
		</div>
	</div>




</div>
</div>
<div class="dasfooter">
	<?php include('includes/footer_resources.php'); ?>
	<?php include("includes/footer.php"); ?></div>
</div>