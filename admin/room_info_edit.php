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

if (isset($_POST['update_room'])) {
    $room_id    = $_POST['room_id'];
    $room_no    = $_POST['room_no'];
    $hall_id    = $_POST['hall_id'];
    $floor_id   = $_POST['floor_id'];

    $sql = "UPDATE room_information
            SET hall_id='$hall_id',floor_id='$floor_id',room_no='$room_no'
            WHERE room_id = $room_id";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "Successfully Inserted!";
        header("Location: room_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Edit Room Info";
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
                <h3> Floor Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="room_info_edit.php" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <select name="hall_id" id="hall_id" style="height:30px; width:525px;">
                                            <?php

                                            foreach ($hall_list as $key => $value) {
                                                if ($hall_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                } else {
                                                    echo "<option value='$key'>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Floor Name</label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="floor_name" class="form-control"> -->
                                        <select name="floor_id" id="floor_id" style="height:30px; width:525px;">
                                            <?php

                                            foreach ($floor_list as $key => $value) {
                                                if ($floor_id == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                } else {
                                                    echo "<option value='$key'>$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Room Number</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="room_no" value="<?php echo $room_no; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="update_room" onclick="editRecord(<?php echo $room_id;  ?>)" value="Update Room" class="btn btn-info">
                                        <input type="hidden" name="room_id" value="<?php echo $room_id;  ?>" class="btn btn-info">
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
    <script src="dependent_dropdown.js"></script>
</body>

</html>