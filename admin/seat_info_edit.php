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

$hall_list  = hall_list();
$floor_list = floor_list();
$room_list  = room_list();

if (isset($_GET['seat_id'])) {
    $seat_id = $_GET['seat_id'];

    $sql = "select * from seat_information where seat_id ={$seat_id}";
    $output = [];
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        $seat_id    = $row['seat_id'];
        $hall_id    = $row['hall_id'];
        $floor_id   = $row['floor_id'];
        $room_id    = $row['room_id'];
        $seat_no    = $row['seat_no'];
    }
}

if (isset($_POST['update_seat'])) {
    $seat_id   = $_POST['seat_id'];
    $hall_id   = $_POST['hall_id'];
    $floor_id  = $_POST['floor_id'];
    $room_id   = $_POST['room_id'];
    $seat_no   = $_POST['seat_no'];

    $sql = "UPDATE seat_information 
            SET hall_id='$hall_id',floor_id='$floor_id',room_id='$room_id',seat_no='$seat_no'
            WHERE seat_id={$seat_id}";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "<script>alert('Successfully Updated!');</script>";
        header("Location: seat_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Seat Entry Page";
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
                <h3>Update Seat Information </h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <select name="hall_id" id="hall_id" style="height:30px; width:525px;">
                                            <!-- <option value='' disabled>Select your hall</option> -->
                                            <?php
                                            foreach ($hall_list as $key => $value) {
                                                if ($hall_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Floor Name</label>
                                    <div class="col-sm-6">
                                        <select name="floor_id" id="floor_id" style="height:30px; width:525px;">
                                            <option value='' disabled>Select Floor</option>
                                            <?php
                                            foreach ($floor_list as $key => $value) {
                                                if ($floor_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Room Number</label>
                                    <div class="col-sm-6">
                                        <select name="room_id" id="room_id" style="height:30px; width:525px;">
                                            <option value='' disabled>Select Room</option>
                                            <?php
                                            foreach ($room_list as $key => $value) {
                                                if ($room_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Seat Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="seat_no" value="<?php echo $seat_no; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="update_seat" value="UPDATE" class="btn btn-info">
                                        <input type="hidden" name="seat_id" value="<?php echo $seat_id; ?>" class="btn btn-info">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- col-lg-12-->
                </div>
            </section>
        </section>
    </section>
    <?php include('footer_resources.php');  ?>
    <script src="js/dependent_dropdown.js"></script>
</body>

</html>