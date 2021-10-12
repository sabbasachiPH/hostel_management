<!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
<!--sidebar start-->
<?php
// echo "<pre>";
// echo "<br>";
// echo "<br>";
// echo "<br>";
// echo "<br>";
// echo "<br>";
// echo "<br>";
// print_r($_SESSION['admin_user_level']);
// // die;

?>
<!-- Nav bar For Super Admin -->
<aside>
  <div id="sidebar" class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
      <li class="mt">
        <a class="active" href="dashboard.php">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <?php if (isset($_SESSION['admin_user_level']) && in_array($_SESSION['admin_user_level'], [1, 2, 3])) : ?>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-tasks"></i>
            <span>Master Setup</span>
          </a>
          <ul class="sub">
            <li><a href="university_info_listview.php">University Information</a></li>
            <li><a href="subject_info_listview.php">Subject Information</a></li>
            <li><a href="hall_info_listview.php">Hall Information</a></li>
            <li><a href="floor_info_listview.php">Floor Information</a></li>
            <li><a href="room_info_listview.php">Room Information</a></li>
            <li><a href="seat_info_listview.php">Seat Information</a></li>
          </ul>
        </li>

        <!-- Super Admin Part-->
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-tasks"></i>
            <span>Super Admin Part</span>
          </a>
          <ul class="sub">
            <li><a href="admin_user_info_listview.php">Admin User Information</a></li>
          </ul>
        </li>
      <?php endif; ?>

      <!-- Admin Part -->
      <li class="sub-menu">
        <a href="javascript:;">
          <i class="fa fa-tasks"></i>
          <span>Admin Part</span>
        </a>
        <ul class="sub">
          <li><a href="student_reg_info_listview.php">Student's Registration</a></li>
          <li><a href="seat_booking_info_listview.php">Seat Booking Information</a></li>
          <li><a href="seat_booking_info_approve_listview.php">Seat Booking Approve</a></li>
        </ul>
      </li>
    </ul>
    <!-- sidebar menu end-->
  </div>
</aside>