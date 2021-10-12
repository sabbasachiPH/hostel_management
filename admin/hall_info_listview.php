<?php
session_start();
include('connection.php');
include('../includes/checklogin.php');
check_login(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include('connection.php');  ?>

<head>
    <?php $title = "Hall List";
    include('header_resources.php');   ?>
</head>

<body>
    <section id="container">
        <?php
        include('header.php');
        include('nav.php');

        if (isset($_GET['hall_id'])) {
            $hall_id = $_GET['hall_id'];
            $sql = "delete from hall_information where hall_id = '$hall_id'";
            $conn->query($sql);
            header("Location: hall_info_listview.php");
        }

        $university_info = array();
        $sql2 = "select * from university_information";
        $result2 = $conn->query($sql2);
        while ($row2 = mysqli_fetch_array($result2)) {
            $university_info[$row2['id']] = $row2['university_name'];
        }
        ?>

        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div>
                    <div class="div1">Hall List View</div>
                    <div class="div2">
                        <a href="hall_info_entry.php" class="button1">Add New Hall</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-panel">

                            <?php /*?><tr style='background-color:purple; height:30px; text-align:center; color:black; font-weight:bold;'><?php */ ?>

                            <hr>
                            <?php
                            $sql = "select * from hall_information";
                            $result = $conn->query($sql);

                            echo "<table border='1' class='table' cellpadding='0' align='center'>";
                            echo "<thead>
					<tr>
					<th>SL</th>
					<th>University Name</th>
					<th>Hall Name</th>
					<th>Action</th>
					</tr>
					</thead>";
                            echo "<tbody>";

                            $i = 0;

                            while ($row = mysqli_fetch_array($result)) {
                                $i++;
                                $hall_id       = $row['hall_id'];
                                $hall_name     = $row['hall_name'];
                                $university_name     = $university_info[$row['university_id']];
                                echo "<tr>
						<td>$i</td>
						<td>$university_name</td>
						<td>$hall_name</td>

						<td>
							<a href='hall_info_edit.php?hall_id=$hall_id' class='button2'>Edit</a>
							<a href='hall_info_view.php?hall_id=$hall_id' class='btn btn-primary'>View</a>
							<a href='$_SERVER[SCRIPT_NAME]?hall_id=$hall_id' class='btn btn-danger' onClick=\"return confirm('Are You sure to Delete?')\">Delete</a>						
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