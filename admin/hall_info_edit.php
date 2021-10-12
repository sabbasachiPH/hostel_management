<!DOCTYPE html>
<html lang="en">
<?php
include('connection.php');
include('function.php');
$university_list = university_list();
if (isset($_GET['hall_id'])) {
    $hall_id = $_GET['hall_id'];
    $sql = "select * from hall_information where hall_id = '$hall_id'";

    $result = $conn->query($sql);
    if ($row = mysqli_fetch_array($result)) {
        $hall_name    = $row['hall_name'];
        $university_id    = $row['university_id'];
        $hall_id      = $row['hall_id'];
    }
}

if (isset($_POST['update_hall'])) {

    $hall_name     = $_POST['hall_name'];
    $university_id     = $_POST['university_id'];
    $hall_id       = $_POST['hall_id'];

    $sql = "UPDATE hall_information 
            SET hall_name='$hall_name',university_id='$university_id' 
            WHERE hall_id=$hall_id";

    $result = $conn->query($sql);

    if ($result) {
        echo "Update Successfully!";
        echo "<meta http-equiv='refresh' content='0.5;url=hall_info_listview.php'>";
    }
}
?>

<head>
    <?php $title = "Edit hall Information";
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
                                    <label class="col-sm-2 col-sm-2 control-label">University Name</label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="university_id" value="<?php echo $university_id;  ?>" class="form-control"> -->
                                        <select name="university_id" style="height:30px; width:525px;">
                                            <?php
                                            foreach ($university_list as $key => $value) {
                                                if ($university_id == $key) {
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
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="hall_name" value="<?php echo $hall_name;  ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="update_hall" value="Update" class="btn btn-info">

                                        <input type="hidden" name="hall_id" value="<?php echo $hall_id;  ?>" class="btn btn-info">
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