<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>

<!DOCTYPE html>
<html lang="en">
<?php include('connection.php');  ?>

<head>
    <?php $title = "Room List";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');

        if (isset($_GET['room_id'])) {
            $room_id = $_GET['room_id'];
            $sql = "delete from room_information where room_id = '$room_id'";
            $conn->query($sql);
            header("Location: room_info_listview.php");
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
                    <div class="div1">Room List View</div>
                    <div class="div2">
                        <a href="room_info_entry.php" class="button1">Add New Room</a>
                    </div>
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

                            $floor_info = array();
                            $sql3 = "select * from floor_information";
                            $result3 = $conn->query($sql3);
                            while ($row3 = mysqli_fetch_array($result3)) {
                                $floor_info[$row3['floor_id']] = $row3['floor_name'];
                            }
                            ?>

                            <table border='1' class='table' cellpadding='0' align='center'>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Room No.</th>
                                        <th>Hall Name</th>
                                        <th>Floor Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $sql = "select * from room_information order by hall_id,room_no";
                                    $result = $conn->query($sql);

                                    while ($row = mysqli_fetch_array($result)) {

                                        $i++;
                                        $room_id    = $row['room_id'];
                                        $room_no    = $row['room_no'];
                                        $hall_name  = $hall_info[$row['hall_id']];
                                        $floor_name = $floor_info[$row['floor_id']];
                                        echo "<tr>
						<td>$i</td>
						<td>$room_no</td>
						<td>$hall_name</td>
						<td>$floor_name</td>					
						<td>
							<a href='room_info_edit.php?room_id=$room_id'  class='button2'>Edit</a>
							<a href='room_info_view.php?room_id=$room_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?room_id=$room_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
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