<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');

if (isset($_GET['hall_id'])) {
    $hall_id = $_GET['hall_id'];
    $sql = "select * from hall_information where hall_id = '$hall_id'";
    $result = $conn->query($sql);
    if ($row = mysqli_fetch_array($result)) {
        $hall_name    = $row['hall_name'];
        $hall_code    = $row['hall_code'];
        $hall_id      = $row['hall_id'];
    }
}
?>

<head>
    <?php $title = "View Hall Information";
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
                <h3> Hall Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="hall_info_edit.php" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <input readonly type="text" name="hall_name" value="<?php echo $hall_name;  ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Code</label>
                                    <div class="col-sm-6">
                                        <input readonly type="text" name="hall_code" value="<?php echo $hall_code;  ?>" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <a href="hall_info_listview.php" class="btn btn-info">Back To Hall List</a>
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