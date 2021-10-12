<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('connection.php');  ?>

<head>
    <?php
    $title = "University List";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');

        if (isset($_GET['university_id'])) {
            $university_id = $_GET['university_id'];
            $sql = "delete from university_information where id = '$university_id'";
            $conn->query($sql);
            header("Location: university_info_listview.php");
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
                    <div class="div1">University List View</div>
                    <div class="div2">
                        <a href="university_info_entry.php" class="button1">Add New University</a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">
                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>
                            <hr>
                            <?php

                            $sql = "select * from university_information";
                            $result = $conn->query($sql);

                            echo "<table border='1' class='table' cellpadding='0' align='center'>";
                            echo "<thead>
					<tr>
					<th>SL</th>
					<th>University Name</th>
					<th>Establishment Year</th>
					<th>Address</th>
					<th>World Ranking</th>
					<th>Action</th>
					</tr>
					</thead>";
                            echo "<tbody>";
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $university_id         = $row['id'];
                                $university_name     = $row['university_name'];
                                $establishment_year = $row['establishment_year'];
                                $address             = $row['address'];
                                $world_ranking         = $row['world_ranking'];
                                echo "<tr>
						<td>$i</td>
						<td>$university_name</td>
						<td>$establishment_year</td>
						<td>$address</td>
						<td>$world_ranking</td>
						<td>
							<a href='university_info_edit.php?university_id=$university_id' class='button2'>Edit</a>
							<a href='university_info_view.php?university_id=$university_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?university_id=$university_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>
						
						
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