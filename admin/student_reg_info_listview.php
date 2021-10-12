<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>

<!DOCTYPE html>
<html lang="en">
<?php include('connection.php');  ?>

<head>
    <?php $title = "Student List";
    include('header_resources.php');
    include('function.php');   ?>
</head>

<body>
    <section id="container">

        <?php

        include('header.php');
        include('nav.php');

        if (isset($_GET['student_reg_id'])) {
            $student_reg_id = $_GET['student_reg_id'];
            $sql = "delete from userregistration where id = '$student_reg_id'";
            $conn->query($sql);
            header("Location: student_reg_info_listview.php");
        }


        ?>

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <div>
                    <div class="div1">Student List View</div>
                    <div class="div2">
                        <a href="student_reg_info_entry.php" class="button1">Add New Student</a>
                    </div>
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
                                        <th>Registrant No.</th>
                                        <th>Student Name</th>
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

                                    $i = 0;
                                    $sql = "select * from userregistration order by regNO";
                                    $result = $conn->query($sql);

                                    while ($row = mysqli_fetch_array($result)) {
                                        // echo "<pre>";
                                        // print_r($row);
                                        // die();

                                        $i++;
                                        $student_reg_id   = $row['id'];
                                        $sutdent_reg_no   = $row['regNo'];
                                        $subject_id       = $subject_list[$row['subject_id']];
                                        $student_name     = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
                                        $email            = $row['email'];
                                        $contactNo        = $row['contactNo'];
                                        $address          = $row['address'];


                                        echo "<tr>
						<td>$i</td>
 						
<td>$sutdent_reg_no</td>
<td>$student_name  </td>
<td>$subject_id   </td>
<td>$email       </td>
<td>$contactNo    </td>
<td>$address      </td>
						

						<td>
							<a href='student_reg_info_edit.php?student_reg_id=$student_reg_id'  class='button2'>Edit</a>
							<a href='student_reg_info_view.php?student_reg_id=$student_reg_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?student_reg_id=$student_reg_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
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


        <!--footer end-->
    </section>

    <?php include('footer_resources.php');  ?>

</body>

</html>