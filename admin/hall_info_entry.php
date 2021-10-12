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
$university_list = university_list();

if (isset($_POST['save_hall'])) {
    $hall_name     = $_POST['hall_name'];
    $university_id     = $_POST['university_id'];

    $sql = "insert into hall_information(hall_name,university_id) 
          values ('$hall_name','$university_id')";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "Successfully Inserted!";
        header("Location: hall_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Hall Entry Page";
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
                            <form class="form-horizontal style-form" action="hall_info_entry.php" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">University Name</label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="university_id" class="form-control"> -->
                                        <select name="university_id" style="height:30px; width:525px;">
                                            <?php
                                            foreach ($university_list as $key => $value) {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Hall Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="hall_name" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="save_hall" class="btn btn-info">
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