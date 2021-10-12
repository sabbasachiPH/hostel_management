<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>

<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connection.php');
include('function.php');

$subject_list = subject_list();
$user_level_list = user_level_list();

if (isset($_POST['save_admin_user'])) {
    $subject_id   = $conn->real_escape_string($_POST['subject_id']);
    $fname        = $conn->real_escape_string($_POST['fname']);
    $mname        = $conn->real_escape_string($_POST['mname']);
    $lname        = $conn->real_escape_string($_POST['lname']);
    $gender       = $conn->real_escape_string($_POST['gender']);
    $contact_no   = $conn->real_escape_string($_POST['contact_no']);
    $address      = $conn->real_escape_string($_POST['address']);
    $email        = $conn->real_escape_string($_POST['email']);
    $password     = $conn->real_escape_string($_POST['password']);
    $cpassword    = $conn->real_escape_string($_POST['cpassword']);

    $sql_email = "SELECT email FROM `admin_registration` WHERE `email` ='{$email}'";
    $result_email = $conn->query($sql_email);

    if ($result_email->num_rows > 0) {
        $_SESSION['message-fail'] = "Duplicate email is not allowed.";
        header("location:message.php");
    } else {
        $sql = "INSERT INTO admin_registration (subject_id,firstName,middleName,lastName,gender,contactNo,address,email,password)
                VALUES('$subject_id','$fname','$mname','$lname','$gender','$contact_no','$address','$email','$password')
               ";
        $result = $conn->query($sql);

        if ($result == 1) {
            $_SESSION['message-success'] = "Registration successfull.";
            header("location:admin_user_info_listview.php");
        }
    }
}
?>

<head>
    <?php $title = "Create Admin User";
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
                <h3> Admin User Entry</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" action="admin_user_info_entry.php" method="post" name="registration" onSubmit="return valid();">
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Admin User Level : </label>
                                    <div class="col-sm-6">
                                        <select name="user_level_id" id="user_level_id" style="height:30px; width:525px;">
                                            <option value='' selected disabled>Select user Level</option>
                                            <?php
                                            foreach ($user_level_list as $key => $value) {
                                                echo "<option value='$key'>$value</option>";
                                            }
                                            ?>
                                        </select>
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
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
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
                                        <input type="email" name="email" id="email" class="form-control" onBlur="check_admin_availability()" required="required">
                                        <span id="user-availability-status" style="font-size:12px;"></span>
                                        <?php if (isset($_SESSION['message-fail'])) : ?>
                                            <div class="alert alert-danger">
                                                <?php echo $_SESSION['message-fail']; ?>
                                            </div>
                                        <?php endif; ?>

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
                                        <input type="submit" name="save_admin_user" class="btn btn-info">
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
        function check_admin_availability() {

            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_admin_availability.php",
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