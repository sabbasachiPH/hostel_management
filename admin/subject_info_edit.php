<!DOCTYPE html>
<html lang="en">
<?php
include('connection.php');

if (isset($_GET['subject_id'])) {
    $subject_id = $_GET['subject_id'];
    $sql = "select * from subject_information where subject_id = '$subject_id'";

    $result = $conn->query($sql);
    if ($row = mysqli_fetch_array($result)) {
        $subject_name    = $row['subject_name'];
        $subject_code    = $row['subject_code'];
        $subject_id      = $row['subject_id'];
    }
}

if (isset($_POST['update_subject'])) {
    $subject_name     = $_POST['subject_name'];
    $subject_code     = $_POST['subject_code'];
    $subject_id       = $_POST['subject_id'];

    $sql = "UPDATE subject_information 
            SET subject_name='$subject_name',subject_code='$subject_code' 
            WHERE subject_id=$subject_id";

    $result = $conn->query($sql);

    if ($result) {
        echo "Update Successfully!";
        echo "<meta http-equiv='refresh' content='0.5;url=subject_info_listview.php'>";
    }
}
?>

<head>
    <?php $title = "Edit subject Information";
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
                <h3> Subject Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" action="subject_info_edit.php" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Subject Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="subject_name" value="<?php echo $subject_name;  ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Subject Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="subject_code" value="<?php echo $subject_code;  ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="update_subject" value="Update" class="btn btn-info">
                                        <input type="hidden" name="subject_id" value="<?php echo $subject_id;  ?>" class="btn btn-info">
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