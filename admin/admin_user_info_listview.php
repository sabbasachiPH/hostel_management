<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include('connection.php');  ?>

<head>
    <?php $title = "Admin User List";
    include('header_resources.php');
    include('function.php');   ?>
</head>
<?php
include('header.php');
include('nav.php');
if (isset($_GET['admin_user_id'])) {
    $admin_user_id = $_GET['admin_user_id'];
    $sql = "delete from admin_registration where admin_id = '$admin_user_id'";
    $conn->query($sql);
    header("Location: admin_user_info_listview.php");
}
?>

<body>
    <section id="container">
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div>
                    <div class="div1">Admin User List View</div>
                    <div class="div2">
                        <a href="admin_user_info_entry.php" class="button1">Add New User</a>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    <?php if (isset($_SESSION['message-success'])) : ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['message-success']; ?>
                        </div>
                        <?php unset($_SESSION['message-success']); ?>
                    <?php endif; ?>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">
                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>
                            <hr>
                            <table border='1' class='table' cellpadding='0' align='center'>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User Level</th>
                                        <th>Admin User Name</th>
                                        <th>Subject Name</th>
                                        <th>E-mail Address</th>
                                        <th>Contact No.</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subject_list = subject_list();
                                    $user_level_list = user_level_list();

                                    $i = 0;
                                    $sql = "select * from admin_registration order by admin_user_level";
                                    $result = $conn->query($sql);

                                    while ($row = mysqli_fetch_array($result)) {
                                        $i++;
                                        $admin_user_id    = $row['admin_id'];
                                        $admin_user_level = $user_level_list[$row['admin_user_level']];
                                        $subject_id       = $subject_list[$row['subject_id']];
                                        $admin_user_name  = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
                                        $email            = $row['email'];
                                        $contactNo        = $row['contactNo'];
                                        $address          = $row['address'];
                                        echo "<tr>
    <td>$i</td>
    <td>$admin_user_level</td>
    <td>$admin_user_name</td>
    <td>$subject_id</td>
    <td>$email</td>
    <td>$contactNo</td>
    <td>$address</td>
    <td>
        <a href='admin_user_info_edit.php?admin_user_id=$admin_user_id'  class='button2'>Edit</a>
        <a href='admin_user_info_view.php?admin_user_id=$admin_user_id' class='btn btn-primary'>View</a>
        <a href='$_SERVER[SCRIPT_NAME]?admin_user_id=$admin_user_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
    </td>
	</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    ?>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </section>
    <?php include('footer_resources.php');  ?>
</body>

</html>