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

if (isset($_POST['save_floor'])) {
    $hall_id     = $_POST['hall_id'];
    $floor_name  = $_POST['floor_name'];

    $sql = "insert into floor_information(floor_name,hall_id) 
          values ('$floor_name','$hall_id')";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "Successfully Inserted!";
        header("Location: floor_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Floor Entry Page";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');
        ?>
        <section id="main-content">
            <section class="wrapper">
                <h3> Floor Information</h3>
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" action="floor_info_entry.php" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <select name="hall_id" style="height:30px; width:525px;">
                                            <?php
                                            foreach ($hall_list as $key => $value) {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Floor Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="floor_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="save_floor" class="btn btn-info">
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
</body>

</html>