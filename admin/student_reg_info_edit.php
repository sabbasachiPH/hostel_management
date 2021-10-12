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

$subject_list = subject_list();
$gender_list = gender_list();

if (isset($_GET['student_reg_id'])) {
    $student_reg_id = $_GET['student_reg_id'];

    $sql = "select * from userregistration where id ={$student_reg_id}";
    $output = [];
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        $student_reg_id = $row['id'];
        $regNo        = $row['regNo'];
        $subject_id   = $row['subject_id'];
        $firstName    = $row['firstName'];
        $middleName   = $row['middleName'];
        $lastName     = $row['lastName'];
        $gender       = $row['gender'];
        $contactNo    = $row['contactNo'];
        $address      = $row['address'];
        $email        = $row['email'];
        $password     = $row['password'];
    }
}

if (isset($_POST['update_student'])) {
    $student_reg_id = $_POST['student_reg_id'];
    $regNo        = $_POST['regNo'];
    $subject_id   = $_POST['subject_id'];
    $firstName    = $_POST['firstName'];
    $middleName   = $_POST['middleName'];
    $lastName     = $_POST['lastName'];
    $gender       = $_POST['gender'];
    $contactNo    = $_POST['contactNo'];
    $address      = $_POST['address'];
    $email        = $_POST['email'];
    $updationDate = date("Y-m-d H:i:s");

    $sql = "UPDATE userregistration 
            SET regNo       = '$regNo',
                subject_id  = '$subject_id',
                firstName   = '$firstName',
                middleName  = '$middleName',
                lastName    = '$lastName',
                gender      = '$gender',
                contactNo   = '$contactNo',
                address     = '$address',
                email       = '$email',
                updationDate= '$updationDate'               
            WHERE id={$student_reg_id}   ";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "<script>alert('Student Succssfully registered');</script>";
        header("Location: student_reg_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Update Registration Information";
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
                <h3> Student's Registration Information Entry</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">

                            <form class="form-horizontal style-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="registration" onSubmit="return valid();">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Registration No : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="regNo" value="<?php echo $regNo; ?>" class="form-control" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Subject : </label>
                                    <div class="col-sm-6">
                                        <select name="subject_id" id="subject_id" style="height:30px; width:525px;">
                                            <option value='' selected disabled>Select your Subject</option>
                                            <?php
                                            foreach ($subject_list as $key => $value) {
                                                if ($subject_id == $key) {
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
                                    <label class="col-sm-2 col-sm-2 control-label">First Name : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="firstName" value="<?php echo $firstName; ?>" class="form-control" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Middle Name : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="middleName" value="<?php echo $middleName; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Last Name : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lastName" value="<?php echo $lastName; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Gender : </label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="gender" class="form-control"> -->
                                        <select name="gender" class="form-control" required="required">
                                            <?php foreach ($gender_list as $key => $value) {
                                                if ($gender == $key) {
                                                    echo "<option value='$key' selected>$value</option>";
                                                } else {
                                                    echo "<option value='$key' >$value</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Contact Number : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contactNo" value="<?php echo $contactNo; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Address : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="address" value="<?php echo $address; ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">E-mail Address : </label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" onBlur="checkAvailability()" required="required">
                                        <span id="user-availability-status" style="font-size:12px;"></span>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="update_student" value="Update" class="btn btn-info">
                                        <input type="hidden" name="student_reg_id" value="<?php echo $student_reg_id; ?>" class="btn btn-info">
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
    <script>
        function checkAvailability() {

            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'email=' + $("#email").val(),
                type: "POST",
                success: function(data) {
                    console.log(data);
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {
                    event.preventDefault();
                    alert('error');
                }
            });
        }
    </script>

</body>

</html>