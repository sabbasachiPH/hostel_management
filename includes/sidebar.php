<?php //include("includes/header_resources.php"); 
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="height:100%;">

	<ul class="nav nav-pills flex-column mb-auto">

		<li class="">Main</li>
		<?PHP if (isset($_SESSION['id'])) { ?>
			<li class="nav-item"><a class="nav-link text-white" href="dashboard.php"><i class="fas fa-desktop"></i> Dashboard</a></li>
			<li class="nav-item"><a class="nav-link text-white" href="seat_booking_info_listview.php"><i class="fas fa-copy"></i> Book Hostel</a></li>
			<!-- <li class="nav-item"><a class="nav-link text-white" href="my-profile.php"><i class="fas fa-user"></i> My Profile</a></li> -->
			<li class="nav-item"><a class="nav-link text-white" href="change-password.php"><i class="fas fa-copy"></i> Change Password</a></li>
			<li class="nav-item"><a class="nav-link text-white" href="room_details.php"><i class="fas fa-copy"></i> Your Room Details</a></li>
			<!-- <li class="nav-item"><a class="nav-link text-white" href="access-log.php"><i class="fas fa-copy"></i> Access log</a></li> -->
		<?php } ?>

	</ul>
</div>