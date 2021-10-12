<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">
<?php include('connection.php');  ?>

<head>
    <?php $title = "Floor List";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');
        if (isset($_GET['floor_id'])) {
            $floor_id = $_GET['floor_id'];
            $sql = "delete from floor_information where floor_id = '$floor_id'";
            $conn->query($sql);
            header("Location: floor_info_listview.php");
        }
        ?>

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div>
                    <div class="div1">Floor List View</div>
                    <div class="div2">
                        <a href="floor_info_entry.php" class="button1">Add New Floor</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">
                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>
                            <hr>
                            <?php
                            $sql = "select * from floor_information order by hall_id,floor_name";
                            $result = $conn->query($sql);
                            $hall_info = array();
                            $sql2 = "select * from hall_information";
                            $result2 = $conn->query($sql2);
                            while ($row2 = mysqli_fetch_array($result2)) {
                                $hall_info[$row2['hall_id']] = $row2['hall_name'];
                            }
                            echo "<table border='1' class='table' cellpadding='0' align='center'>";
                            echo "<thead>
					<tr>
					<th>SL</th>
					<th>Floor Name</th>
					<th>Hall Name</th>
					<th>Action</th>
					</tr>
					</thead>";
                            echo "<tbody>";
                            $i = 0;
                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $floor_id    = $row['floor_id'];
                                $floor_name  = $row['floor_name'];
                                $hall_name     = $hall_info[$row['hall_id']];
                                echo "<tr>
						<td>$i</td>
						<td>$floor_name</td>
						<td>$hall_name</td>

						<td>
							<a href='floor_info_edit.php?floor_id=$floor_id' class='button2'>Edit</a>
							<a href='floor_info_view.php?floor_id=$floor_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?floor_id=$floor_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
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