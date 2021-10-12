<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');
include('function.php');


$hall_list = hall_list();

if (isset($_GET['floor_id'])) {
    $floor_id = $_GET['floor_id'];

    $sql = "select * from floor_information where floor_id = '$floor_id'";
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        $floor_id      = $row['floor_id'];
        $floor_name    = $row['floor_name'];
        $hall_id       = $row['hall_id'];
    }
}

if (isset($_POST['update_floor'])) {
    // echo "<pre>";
    // print_r($_POST);
    // // die();
    $floor_id      = $_POST['floor_id'];
    $floor_name    = $_POST['floor_name'];
    $hall_id       = $_POST['hall_id'];

    $sql = "UPDATE floor_information 
            SET floor_name='$floor_name', hall_id='$hall_id'
            WHERE floor_id=$floor_id";

    // echo $sql;
    // die;

    $result = $conn->query($sql);

    if ($result) {
        //$sql2 = "update store_info set supplier_id='$supplier_id', product_id='$product_id', stock_in='$supplies_qty', date='$supply_date', unit_id='$unit_id' where supply_id=$supply_id";

        //echo $sql2; die;
        //$result2 = $conn->query($sql2);

        echo "Update Successfully!";
        echo "<meta http-equiv='refresh' content='0.5;url=floor_info_listview.php'>";
    }
}
?>

<head>
    <?php $title = "Edit Floor Information";
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
                <h3> Edit Floor Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="floor_info_edit.php" method="post">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <!-- <select name="hall_id" style="height:30px; width:525px;"> -->
                                        <?php

                                        foreach ($hall_list as $key => $value) {
                                            if ($hall_id == $key) { ?>
                                                <input readonly type="text" name="floor_name" value="<?php echo $value; ?>" class=" form-control">


                                        <?php }
                                        }


                                        ?>
                                        <!-- </select> -->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Floor Name</label>
                                    <div class="col-sm-6">
                                        <input readonly type="text" name="floor_name" value="<?php echo $floor_name; ?>" class=" form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <a href="floor_info_listview.php" class="btn btn-info">Back To Floor List View</a>
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