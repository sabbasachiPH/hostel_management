<?php
session_start();
include('includes/config.php');
date_default_timezone_set('Asia/Kolkata');
include('includes/checklogin.php');
check_login();

$title = "Change Password";
include("includes/header_resources.php");

$ai = $_SESSION['id'];
// code for change password
if (isset($_POST['changepwd'])) {
    $op = $_POST['oldpassword'];
    $np = $_POST['newpassword'];
    $udate = date('d-m-Y h:i:s', time());;
    $sql = "SELECT password FROM userregistration where password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('s', $op);
    $chngpwd->execute();
    $chngpwd->store_result();
    $row_cnt = $chngpwd->num_rows;;
    if ($row_cnt > 0) {
        $con = "update userregistration set password=?,passUdateDate=?  where id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('ssi', $np, $udate, $ai);
        $chngpwd1->execute();
        $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
        $_SESSION['msg'] = "Old Password not match !!";
    }
}
?>


<div class="dashboard">
    <div class="dasHeader"><?php include("includes/header.php"); ?></div>
    <div class="dasSidebar"><?php include("includes/sidebar.php"); ?></div>
    <div class="dasMain d-flex flex-wrap align-items-start p-3">
        <div class="row">
            <h2>Change Password </h2>
            <div>
                <?php $result = "SELECT passUdateDate FROM userregistration WHERE id=?";
                $stmt = $mysqli->prepare($result);
                $stmt->bind_param('i', $ai);
                $stmt->execute();
                $stmt->bind_result($result);
                $stmt->fetch(); ?>
                Last Update Date:&nbsp;<?php echo $result; ?>
            </div>
        </div>

        <div class="col-md-6 offset-md-3 formCenter ">
            <form method="post" class="form-horizontal" name="changepwd" id="change-pwd" onSubmit="return valid();">
                <?php if (isset($_POST['changepwd'])) { ?>
                    <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                <?php } ?>
                <div class="hr-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">old Password </label>
                    <div class="col-sm-12">
                        <input type="password" value="" name="oldpassword" id="oldpassword" class="form-control" onBlur="checkpass()" required="required">
                        <span id="password-availability-status" class="help-block m-b-none" style="font-size:12px;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">New Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" name="newpassword" id="newpassword" value="" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Confirm Password</label>
                    <div class="col-sm-12">
                        <input type="password" class="form-control" value="" required="required" id="cpassword" name="cpassword">
                    </div>
                </div>

                <div class="">
                    <a class="btn btn-secondary" href="dashboard.php">Cancel</a>
                    <input type="submit" name="changepwd" Value="Change Password" class="btn btn-primary">
                </div>

            </form>





        </div>
    </div>
</div>







</div>
</div>
<div class="dasfooter">
    <?php include('includes/footer_resources.php'); ?>
    <?php include("includes/footer.php"); ?></div>
</div>