<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>

<!DOCTYPE html>
<html lang="en">

<?php include('connection.php');  ?>

<head>
    <?php $title = "Available Seat List";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">

        <?php

        include('header.php');
        include('nav.php');

        if (isset($_GET['seat_id'])) {
            $seat_id = $_GET['seat_id'];
            $sql = "delete from seat_information where seat_id = '$seat_id'";
            $conn->query($sql);
            header("Location: seat_info_listview.php");
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
                    <div class="div1">Available Seat List For Allotment</div>
                    <!-- <div class="div2">
                        <a href="seat_info_entry.php" class="button1">Add New Seat</a>
                    </div> -->
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">

                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>

                            <hr>
                            <?php
                            $hall_info = array();
                            $sql2 = "select * from hall_information";
                            $result2 = $conn->query($sql2);
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $hall_info[$row2['hall_id']] = $row2['hall_name'];
                            }

                            $room_info = array();
                            $sql3 = "SELECT * FROM room_information";
                            $result3 = $conn->query($sql3);

                            while ($row3 = mysqli_fetch_array($result3)) {
                                $room_info[$row3['room_id']] = $row3['room_no'];
                            }

                            echo "<table border='1' class='table' cellpadding='0' align='center'>";
                            echo "<thead>
					<tr>
					<th>SL</th>
					<th>Hall Name</th>
					<th>Room No</th>
					<th>Seat No</th>
					<th>Action</th>
					</tr>
					</thead>";
                            echo "<tbody>";

                            $i = 0;

                            $sql = "SELECT * FROM seat_information 
                                    WHERE seat_status = 1 AND student_id IS NULL
                                    ORDER BY hall_id,room_id";
                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $seat_id  = $row['seat_id'];
                                $hall_name  = $hall_info[$row['hall_id']];
                                $room_no  = $room_info[$row['room_id']];
                                $seat_no  = $row['seat_no'];
                                echo "<tr>
						<td>$i</td>
						<td>$hall_name</td>
						<td>$room_no</td>
						<td>$seat_no</td>
					
						<td>
							<a href='seat_booking_info_entry.php?seat_id=$seat_id'  class='button2'>Apply</a>
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