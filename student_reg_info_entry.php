<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./admin/connection.php');
include('./admin/function.php');

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

    $sql_email = "SELECT email FROM `userregistration` WHERE `email` ='{$email}'";
    $result_email = $conn->query($sql_email);

    if ($result_email->num_rows > 0) {
        $_SESSION['message-fail'] = "Duplicate email is not allowed.";
    } else {
        $sql = "INSERT INTO userregistration(regno,subject_id,firstName,middleName,lastName,gender,contactNo,address,email,password)
                VALUES('$regno','$subject_id','$fname','$mname','$lname','$gender','$contact_no','$address','$email','$password')
               ";
        $result = $conn->query($sql);

        if ($result == 1) {
            $_SESSION['message-success'] = "You have Registered successfully";
            header("location:index.php");
        }
    }
}
?>

<head>
    <?php
    $title = "Student's Registration Page";
    include('includes/header_resources.php'); ?>
    <?php include('includes/navTop.php'); ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h2 class="page-title">Student Registration Form </h2>
                    Fill all Informations carefully.
                </div>
                <div class="">
                    <form class="form-horizontal style-form" action="student_reg_info_entry.php" method="post" name="registration" onSubmit="return valid();">
                        <div class="form-group col-md-8 m-auto">
                            <label class="col-sm-2 col-sm-2 control-label">Registration No : </label>

                            <input type="text" name="regno" class="form-control" value="<?php echo isset($_POST['regno']) ? $_POST['regno'] : ''; ?>" required="required">

                        </div>

                        <div class="form-group col-md-8 m-auto">
                            <label class="col-sm-2 col-sm-2 control-label">Subject : </label>

                            <select name="subject_id" id="subject_id" style="height:30px; width:100%;">
                                <option value='' selected disabled>Select your Subject</option>
                                <?php foreach ($subject_list as $key => $value) : ?>
                                    <option <?php if (isset($_POST['subject_id']) && $_POST['subject_id'] == $key) { ?>selected="true" <?php }; ?>value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <!--  -->
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-8 m-auto">
                            <label class="col-sm-2 col-sm-2 control-label">First Name : </label>

                            <input type="text" name="fname" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>" class="form-control" required="required">

                        </div>

                        <div class="form-group col-md-8 m-auto">
                            <label class="col-sm-2 col-sm-2 control-label">Middle Name : </label>
                            <input type="text" name="mname" class="form-control" value="<?php echo isset($_POST['mname']) ? $_POST['mname'] : ''; ?>">
                        </div>
                </div>

                <div class="form-group col-md-8 m-auto">
                    <label class="col-sm-2 col-sm-2 control-label">Last Name : </label>
                    <input type="text" name="lname" class="form-control" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
                </div>
            </div>

            <div class="form-group col-md-8 m-auto">
                <label class="col-sm-2 col-sm-2 control-label">Gender : </label>

                <!-- <input type="text" name="gender" class="form-control"> -->
                <select name="gender" class="form-control" required="required">
                    <option value='' selected disabled>Select Gender</option>
                    <option <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Male') { ?>selected="true" <?php }; ?>value="Male">Male</option>
                    <option <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Female') { ?>selected="true" <?php }; ?>value="Female">Female</option>
                    <option <?php if (isset($_POST['gender']) && $_POST['gender'] == 'Others') { ?>selected="true" <?php }; ?>value="Others">Others</option>
                </select>
            </div>
        </div>

        <div class="form-group col-md-8 m-auto">
            <label class="col-sm-4  control-label">Contact Number : </label>
            <input type="text" name="contact_no" class="form-control" value="<?php echo isset($_POST['contact_no']) ? $_POST['contact_no'] : ''; ?>">
        </div>


        <div class="form-group col-md-8 m-auto">
            <label class="col-sm-2 col-sm-2 control-label">Address : </label>
            <input type="text" name="address" class="form-control" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
        </div>


        <div class="form-group col-md-8 m-auto">
            <label class="col-sm-2 col-sm-2 control-label">E-mail Address : </label>
            <input type="email" name="email" id="email" class="form-control" onBlur="checkAvailability()" required="required" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            <span id="user-availability-status" style="font-size:12px;"></span>
            <?php if (isset($_SESSION['message-fail'])) : ?>
                <div class="alert alert-danger ">
                    <?php echo $_SESSION['message-fail']; ?>
                </div>
            <?php endif; ?>
            <?php unset($_SESSION['message-fail']); ?>
        </div>


        <div class="form-group col-md-8 m-auto">
            <label class="col-sm-2 col-sm-2 control-label">Password : </label>
            <input type="password" name="password" id="password" class="form-control" required="required">
        </div>


        <div class="form-group col-md-8 m-auto">
            <label class="col-sm-4 control-label">Confirm Password : </label>

            <input type="password" name="cpassword" id="cpassword" class="form-control" required="required">
        </div>

        <div class="form-group col-md-8 m-auto p-2">
            <div class="col-sm-8" align="center">
                <!-- <input type="submit" name="submit"  value="save_student" class="btn btn-info"> -->
                <input type="submit" name="save_student" class="btn btn-info">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </div>

    </form>
    </div>


    </section>
    </section>


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
    <?php include('./admin/footer_resources.php');  ?>