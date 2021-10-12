<!DOCTYPE html>
<html lang="en">

<?php include('connection.php');
include("function.php");
session_start();

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

?>

<head>
	<?php
	$title = "Hostel Management System_PGDICT Batch # 38_Group2";
	include('header_resources.php');   ?>
</head>

<body>
	<section id="container">
		<?php
		include('header.php');
		include('nav.php');
		?>
		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Total Hall <?php echo $total_hall; ?></h4>
					</a>
				</div>

				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Total Room = <?php echo $total_room; ?></h4>
						<!-- <p class="list-group-item-text">Total Hall</p> -->
					</a>
				</div>

				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Total Student = <?php echo $total_student; ?></h4>
						<!-- <p class="list-group-item-text">Total Hall</p> -->
					</a>
				</div>

				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Total Seat = <?php echo $total_seat; ?></h4>
						<!-- <p class="list-group-item-text">Total Hall</p> -->
					</a>
				</div>

				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Seat Available = <?php echo $not_alloted_seat; ?></h4>
						<!-- <p class="list-group-item-text">Total Hall</p> -->
					</a>
				</div>

				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Seat Alloted = <?php echo $alloted_seat; ?></h4>
						<!-- <p class="list-group-item-text">Total Hall</p> -->
					</a>
				</div>

				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Seat Application Pending = <?php echo $pending_seat; ?></h4>
						<!-- <p class="list-group-item-text">Total Hall</p> -->
					</a>
				</div>
			</section>
		</section>		
	</section>
	<?php include('footer_resources.php');  ?>
</body>
</html>