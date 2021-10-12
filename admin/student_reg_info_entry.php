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

if (isset($_POST['save_student'])) {
    $regno        = $_POST['regno'];
    $subject_id   = $_POST['subject_id'];
    $fname        = $_POST['fname'];
    $mname        = $_POST['mname'];
    $lname        = $_POST['lname'];
    $gender       = $_POST['gender'];
    $contact_no   = $_POST['contact_no'];
    $address      = $_POST['address'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];
    $cpassword    = $_POST['cpassword'];

    $sql = "INSERT INTO userregistration(
                            regno       ,
                            subject_id  ,
                            firstName   ,
                            middleName  ,
                            lastName    ,
                            gender      ,
                            contactNo  ,
                            address     ,
                            email       ,
                            password    
                              )
            VALUES(
               '$regno',
               '$subject_id',
               '$fname',
               '$mname',
               '$lname',
               '$gender',
               '$contact_no',
               '$address',
               '$email',
               '$password',
               )";

    $result = $conn->query($sql);

    if ($result == 1) {
        echo "<script>alert('Student Succssfully registered');</script>";
        header("Location: student_reg_info_listview.php");
    }
}
?>

<head>
    <?php $title = "Student's Registration Page";
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
                            <form class="form-horizontal style-form" action="student_reg_info_entry.php" method="post" name="registration" onSubmit="return valid();">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Registration No : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="regno" class="form-control" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Subject : </label>
                                    <div class="col-sm-6">
                                        <select name="subject_id" id="subject_id" style="height:30px; width:525px;">
                                            <option value='' selected disabled>Select your Subject</option>
                                            <?php
                                            foreach ($subject_list as $key => $value) {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">First Name : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="fname" class="form-control" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Middle Name : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="mname" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Last Name : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="lname" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Gender : </label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="gender" class="form-control"> -->
                                        <select name="gender" class="form-control" required="required">
                                            <option value="" selected disabled>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Contact Number : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="contact_no" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Address : </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">E-mail Address : </label>
                                    <div class="col-sm-6">
                                        <!-- <input type="text" name="contact_no" class="form-control"> -->
                                        <input type="email" name="email" id="email" class="form-control" onBlur="checkAvailability()" required="required">
                                        <span id="user-availability-status" style="font-size:12px;"></span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Password : </label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" id="password" class="form-control" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Confirm Password : </label>
                                    <div class="col-sm-6">
                                        <input type="password" name="cpassword" id="cpassword" class="form-control" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-8" align="center">
                                        <input type="submit" name="save_student" class="btn btn-info">
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
    <!-- <script src="dependent_dropdown.js"></script> -->
</body>

</html>