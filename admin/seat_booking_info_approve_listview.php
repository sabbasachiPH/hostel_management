<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include('connection.php');  ?>

<head>
    <?php $title = "Seat List Pending For Approval";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');
        include('function.php');

        $hall_list  = hall_list();
        $floor_list = floor_list();
        $room_list  = room_list();
        $student_list = student_list();

        // echo "<pre>";
        // print_r($student_list);
        // die;

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
                    <div class="div1">Seat List Pending For Approval</div>
                    <div class="div2">
                        <!-- <a href="seat_info_entry.php" class="button1">Add New Seat</a> -->
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">
                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>
                            <!-- <hr> -->

                            <table border='1' class='table' cellpadding='0' align='center'>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Hall Name</th>
                                        <th>Room No</th>
                                        <th>Seat No</th>
                                        <th>Student Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;

                                    $sql = "SELECT * FROM seat_information
                                    WHERE seat_status = 2
                                    order by hall_id,room_id";
                                    $result = $conn->query($sql); ?>

                                    <?php while ($row = mysqli_fetch_array($result)) : ?>
                                        <?php

                                        $i++;
                                        $seat_id       = $row['seat_id'];
                                        $student_id    = $row['student_id'];
                                        $hall_name     = $hall_list[$row['hall_id']];
                                        $room_no       = $room_list[$row['room_id']];
                                        $seat_no       = $row['seat_no'];
                                        $student_name  = $student_list[$student_id]; ?>
                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $hall_name; ?>
                                            </td>
                                            <td>
                                                <?php echo $room_no; ?>
                                            </td>
                                            <td>
                                                <?php echo $seat_no; ?>
                                            </td>
                                            <td>
                                                <?php echo $student_name; ?>
                                            </td>

                                            <td>
                                                <a href="seat_booking_info_approve.php?seat_id=<?php echo $seat_id; ?>&student_id=<?php echo $student_id; ?>" class='button2'>Approve</a>
                                                <a href="seat_booking_info_reject.php?seat_id=<?php echo $seat_id; ?>&student_id=<?php echo $student_id; ?>" class='button2'>Reject</a>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>

                                </tbody>

                            </table>

                        </div>
                        <!-- <a href='seat_booking_info_entry.php?seat_id=$seat_id'  class='button2'>Apply</a>
							<a href='seat_info_edit.php?seat_id=$seat_id'  class='button2'>Edit</a>
							<a href='seat_info_view.php?seat_id=$seat_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?seat_id=$seat_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
							<a href='seat_info_edit_1.php?seat_id=$seat_id'  class='button2'>Edit Dropdown</a> -->
                    </div>
                </div>
            </section>
        </section>
        <!--footer end-->
    </section>
    <?php include('footer_resources.php');  ?>
</body>

</html>