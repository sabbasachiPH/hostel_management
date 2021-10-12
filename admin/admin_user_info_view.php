<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('connection.php');
include('function.php');

$subject_list = subject_list();
$user_level_list = user_level_list();


if (isset($_GET['admin_user_id'])) {
    $admin_user_id = $_GET['admin_user_id'];

    $sql = "select * from admin_registration where admin_id ={$admin_user_id}";
    $output = [];
    $result = $conn->query($sql);

    if ($row = mysqli_fetch_array($result)) {
        // echo "<pre>";
        // print_r($row);
        // die;
        $admin_user_id = $row['admin_id'];
        $admin_user_level = $row['admin_user_level'];
        $subject_id   = $row['subject_id'];
        $fname        = $row['firstName'];
        $mname        = $row['middleName'];
        $lname        = $row['lastName'];
        $gender       = $row['gender'];
        $contact_no   = $row['contactNo'];
        $address      = $row['address'];
        $email        = $row['email'];
        $password     = $row['password'];
    }
}

?>

<head>
    <?php $title = "View Admin User's Details";
    include('header_resources.php'); ?>
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
                <h3>View Admin User Information</h3>
                <!-- BASIC FORM ELELEMNTS -->
                <div class="row mt">
                    <div class="col-lg-12">
                        <div class="form-panel">
                            <form class="form-horizontal style-form" action="admin_user_info_entry.php" method="post" name="registration" onSubmit="return valid();">
                                <fieldset disabled="disabled">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Admin User Level : </label>
                                        <div class="col-sm-6">
                                            <select name="user_level_id" id="user_level_id" style="height:30px; width:525px;">
                                                <option value='' selected disabled>Select user Level</option>
                                                <?php
                                                foreach ($user_level_list as $key => $value) {
                                                    if ($admin_user_level == $key) {
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
                                            <input type="text" name="fname" value="<?php echo $row['firstName']; ?>" class="form-control" required="required">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Middle Name : </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="mname" value="<?php echo $row['middleName']; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Last Name : </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="lname" value="<?php echo $row['lastName']; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Gender : </label>
                                        <div class="col-sm-6">
                                            <!-- <input type="text" name="gender" class="form-control"> -->
                                            <select name="gender" class="form-control" required="required">
                                                <option value="" selected disabled>Select Gender</option>
                                                <option <?php echo $row['gender'] == 'M' ? 'selected' : ''; ?> value="M">Male</option>
                                                <option <?php echo $row['gender'] == 'F' ? 'selected' : ''; ?> value="F">Female</option>
                                                <option <?php echo $row['gender'] == 'others' ? 'selected' : ''; ?> value="others">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Contact Number : </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="contact_no" value="<?php echo $row['contactNo']; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">Address : </label>
                                        <div class="col-sm-6">
                                            <input type="text" name="address" value="<?php echo $row['address']; ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label">E-mail Address : </label>
                                        <div class="col-sm-6">
                                            <!-- <input type="text" name="contact_no" class="form-control"> -->
                                            <input type="email" name="email" value="<?php echo $row['email']; ?>" id="email" class="form-control" onBlur="check_admin_availability()" required="required">
                                            <span id="user-availability-status" style="font-size:12px;"></span>
                                            <?php if (isset($_SESSION['message-fail'])) : ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $_SESSION['message-fail']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-8" align="center">
                                            <a href='admin_user_info_listview.php' class='button2'>Go Bank to Listview</a>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </section>
    </section>

    <?php include('footer_resources.php');  ?>
    <!-- <script src="dependent_dropdown.js"></script> -->

</body>

</html>