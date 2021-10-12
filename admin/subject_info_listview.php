<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('connection.php');  ?>

<head>
    <?php $title = "Subject List";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');

        if (isset($_GET['subject_id'])) {
            $subject_id = $_GET['subject_id'];
            $sql = "delete from subject_information where subject_id = '$subject_id'";
            $conn->query($sql);
            header("Location: subject_info_listview.php");
        }
        ?>
        <style>
            .div1 {
                width: 80%;
                font-size: 24px;
                font-weight: bold;
                color: #3d5170;
                display: inline-block;
            }

            .div2 {
                width: 17%;
                display: inline-block;
            }

            .button1 {
                background-color: skyblue;
                /* Green */
                border: none;
                color: white;
                padding: 8px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                border-radius: 8px;


            }

            .button2 {
                background-color: #4CAF50;
                /* Green */
                border: none;
                color: white;
                padding: 8px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 4px 2px;
                border-radius: 8px;


            }
        </style>

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">

                <div>
                    <div class="div1">Subject List View</div>
                    <div class="div2">
                        <a href="subject_info_entry.php" class="button1">Add New Subject</a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">

                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>

                            <hr>
                            <?php

                            $sql = "select * from subject_information";
                            $result = $conn->query($sql);

                            echo "<table border='1' class='table' cellpadding='0' align='center'>";
                            echo "<thead>
					<tr>
					<th>SL</th>
					<th>Subject Name</th>
					<th>Subject Code</th>
					<th>Action</th>
					</tr>
					</thead>";
                            echo "<tbody>";

                            $i = 0;

                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $subject_id       = $row['subject_id'];
                                $subject_name     = $row['subject_name'];
                                $subject_code     = $row['subject_code'];
                                echo "<tr>
						<td>$i</td>
						<td>$subject_name</td>
						<td>$subject_code</td>

						<td>
							<a href='subject_info_edit.php?subject_id=$subject_id' class='button2'>Edit</a>
							<a href='subject_info_view.php?subject_id=$subject_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?subject_id=$subject_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
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