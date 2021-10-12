<!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
<!--header start-->
<header class="header black-bg">
  <div class="sidebar-toggle-box">
    <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
  </div>
  <!--logo start-->
  <a href="index.php" class="logo"><b>Hostel Management System</a>
  <!--logo end-->
  <div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
    </ul>
    <!--  notification end -->
  </div>
</header>

<?php if (isset($_SESSION['id'])) : ?>
  <header class="header black-bg">
    <div class="sidebar-toggle-box">
      <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a href="dashboard.php" class="logo"><b><?php echo $_SESSION['userName'] ?></a>
    <!--logo end-->
    <div class="nav notify-row" id="top_menu">
      <!--  notification start -->
      <ul class="nav top-menu">

      </ul>
      <!--  notification end -->
    </div>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
        <li><a class="logout" href="admin_logout.php">Logout</a></li>
      </ul>
    </div>
  <?php endif;
  ?>
  </header>




  <!--header end-->