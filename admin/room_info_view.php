<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');
include('function.php');

$hall_list = hall_list();
$floor_list = floor_list();

if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];

    $sql = "select * from room_information where room_id = '$room_id'";
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        $room_id    = $row['room_id'];
        $room_no    = $row['room_no'];
        $hall_id    = $row['hall_id'];
        $floor_id   = $row['floor_id'];
    }
}

?>

<head>
    <?php $title = "View Room Info";
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
                <h3> Room Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <!-- <select name="hall_id" style="height:30px; width:525px;"> -->
                                        <?php
                                        foreach ($hall_list as $key => $value) {
                                            if ($hall_id == $key) { ?>
                                                <input readonly type="text" name="hall_id" value="<?php echo $value; ?>" class="form-control">
                                        <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Floor Name</label>
                                    <div class="col-sm-6">


                                        <?php

                                        foreach ($floor_list as $key => $value) {
                                            if ($floor_id == $key) { ?>
                                                <input readonly type="text" name="room_no" value="<?php echo $value; ?>" class="form-control">
                                        <?php }
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Room Number</label>
                                    <div class="col-sm-6">
                                        <input readonly type="text" name="room_no" value="<?php echo $room_no; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <a href="room_info_listview.php" class="btn btn-info">Back To Room List View</a>
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