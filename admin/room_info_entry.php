<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');
include('function.php');

$hall_list = hall_list();
$floor_list = floor_list();

if (isset($_POST['save_room'])) {
    $hall_id  = $_POST['hall_id'];
    $floor_id = $_POST['floor_id'];
    $room_no  = $_POST['room_no'];

    $sql = "INSERT INTO room_information(hall_id,floor_id,room_no) 
            VALUES ('$hall_id','$floor_id','$room_no')";
    $result = $conn->query($sql);

    if ($result == 1) {
        echo "<script>alert('Successfully Inserted!');</script>";
        header("Location: room_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Room Entry Page";
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
                <h3> Room Information Entry</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="room_info_entry.php" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <select name="hall_id" id="hall_id" style="height:30px; width:525px;">
                                            <option value='' selected disabled>Select your hall</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Floor Name</label>
                                    <div class="col-sm-6">
                                        <select name="floor_id" id="floor_id" style="height:30px; width:525px;">
                                            <option value='' selected disabled>Select Floor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Room Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="room_no" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="save_room" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <?php include('footer_resources.php');  ?>
    <script src="dependent_dropdown.js"></script>
</body>

</html>