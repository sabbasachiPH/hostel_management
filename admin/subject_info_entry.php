<!DOCTYPE html>
<html lang="en">
<?php
include('connection.php');
if (isset($_POST['save_subject'])) {
    $subject_name     = $_POST['subject_name'];
    $subject_code     = $_POST['subject_code'];

    $sql = "insert into subject_information(subject_name,subject_code) 
          values ('$subject_name','$subject_code')";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "Successfully Inserted!";
        header("Location: subject_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Subject Entry Page";
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
                            <form class="form-horizontal style-form" action="subject_info_entry.php" method="post">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Subject Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="subject_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Subject Code</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="subject_code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="save_subject" class="btn btn-info">
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