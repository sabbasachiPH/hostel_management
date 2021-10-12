<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');
include('function.php');

$hall_list  = hall_list();
$floor_list = floor_list();
$room_list  = room_list();
$student_list = student_list_for_seat_allotment();
// echo "<pre>";
// print_r($hall_list);
// die();

if (isset($_GET['seat_id'])) {
    $seat_id = $_GET['seat_id'];

    $sql = "select * from seat_information where seat_id ={$seat_id}";
    $output = [];
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        // echo "<pre>";
        // print_r($row);
        // die;
        $seat_id    = $row['seat_id'];
        $hall_id    = $row['hall_id'];
        $floor_id   = $row['floor_id'];
        $room_id    = $row['room_id'];
        $seat_no    = $row['seat_no'];
    }
}

if (isset($_POST['seat_allotment'])) {
    // echo "<pre>";
    // print_r($_POST);
    // die;
    $seat_id    = $_POST['seat_id'];
    $student_id = $_POST['student_id'];


    $sql = "UPDATE seat_information 
            SET seat_status=2 , student_id={$student_id}
            WHERE seat_id={$seat_id}";

    $sql2 = "UPDATE userregistration
            SET seat_id = {$seat_id}
            WHERE id={$student_id}";

    // echo "<pre>";
    // print_r($sql);
    // print_r($sql2);
    // die;

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    if ($result == 1) {
        // echo "Successfully Inserted!";
        echo "Application Successfull !!";
        echo "<meta http-equiv='refresh' content='0.5;url=seat_booking_info_listview.php'>";
    } else {
        echo "<script>alert('Something Wrong happened!');</script>";
    }
}
?>

<head>
    <?php $title = "Seat Allotment Page";
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
                <h3>Seat Allotment Information </h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <select disabled name="hall_id" id="hall_id" style="height:30px; width:525px;">
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
                                        <select disabled name="floor_id" id="floor_id" style="height:30px; width:525px;">
                                            <option value='' disabled>Select Floor</option>
                                            <?php

                                            foreach ($floor_list as $key => $value) {
                                                if ($floor_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="text" name="floor_name" class="form-control"> -->

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Room Number</label>
                                    <div class="col-sm-6">
                                        <select disabled name="room_id" id="room_id" style="height:30px; width:525px;">
                                            <option value='' disabled>Select Room</option>
                                            <?php

                                            foreach ($room_list as $key => $value) {
                                                if ($room_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <!-- <input type="text" name="floor_name" class="form-control"> -->

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Seat Number</label>
                                    <div class="col-sm-6">
                                        <input readonly="readonly" type="text" name="seat_no" value="<?php echo $seat_no; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Select Student Name</label>
                                    <div class="col-sm-6">
                                        <select name="student_id" id="student_id" style="height:30px; width:525px;">
                                            <option value='' disabled>Choose Student</option>
                                            <?php
                                            foreach ($student_list as $key => $value) {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                            ?>
                                            ?>
                                        </select>
                                        <!-- <input type="text" name="floor_name" class="form-control"> -->

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="seat_allotment" value="Confirm Seat Allotment" class="btn btn-info">
                                        <input type="hidden" name="seat_id" value="<?php echo $seat_id; ?>" class="btn btn-info">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- col-lg-12-->
                </div>



                <!-- /row -->
            </section>
            <!-- /wrapper -->
        </section>
        <!-- /MAIN CONTENT -->
        <!--main content end-->
        <!--footer start-->

        <!--footer end-->
    </section>

    <?php include('footer_resources.php');  ?>
    <script src="js/dependent_dropdown.js"></script>

</body>

</html>