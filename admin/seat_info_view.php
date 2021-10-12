<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');
include('function.php');

$hall_list = hall_list();
$room_list = room_list();

if (isset($_GET['seat_id'])) {
    $seat_id = $_GET['seat_id'];

    $sql = "select * from seat_information where seat_id = '$seat_id'";
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        $seat_id    = $row['seat_id'];
        $hall_id    = $row['hall_id'];
        $room_id    = $row['room_id'];
        $seat_no    = $row['seat_no'];
    }
}
?>

<head>
    <?php $title = "Seat Information View Page";
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
                <h3> Seat Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="seat_info_edit.php" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <?php

                                        foreach ($hall_list as $key => $value) {
                                            if ($hall_id == $key) { ?>
                                                <input readonly type="text" name="room_id" value="<?php echo $value; ?>" class="form-control">
                                        <?php }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Room No</label>
                                    <div class="col-sm-6">

                                        <?php

                                        foreach ($room_list as $key => $value) {
                                            if ($room_id == $key) { ?>
                                                <input readonly type="text" name="room_id" value="<?php echo $value; ?>" class="form-control">
                                        <?php }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Seat No</label>
                                    <div class="col-sm-6">
                                        <input readonly type="text" name="seat_no" value="<?php echo $seat_no; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <a href="seat_info_listview.php" class="btn btn-info">Back To List View</a>
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


</body>

</html>