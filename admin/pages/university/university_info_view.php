<!DOCTYPE html>
<html lang="en">

<?php

include('connection.php');

if (isset($_GET['university_id'])) {
	$university_id = $_GET['university_id'];
	$sql = "select * from university_information where id = '$university_id'";
	$result = $conn->query($sql);
	if ($row = mysqli_fetch_array($result)) {
		$university_name    = $row['university_name'];
		$establishment_year = $row['establishment_year'];
		$address            = $row['address'];
		$world_ranking      = $row['world_ranking'];
		$university_id      = $row['id'];
	}
}
?>

<head>
	<?php include('header_resources.php');   ?>
</head>

<body>
	<section id="container">

		<?php

		include('header.php');

		include('nav.php');


		?>

		<!--main content start-->
		<section id="main-content">
			<section class="wrapper">
				<h3> University Information</h3>
				<!-- BASIC FORM ELELEMNTS -->
				<div class="row mt">
					<div class="col-lg-12">
						<div class="form-panel">

							<form class="form-horizontal style-form" action="university_info_edit.php" method="post">
								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">University Name</label>
									<div class="col-sm-6">
										<input readonly type="text" name="university_name" value="<?php echo $university_name;  ?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">Establishment Year</label>
									<div class="col-sm-6">
										<input readonly type="text" name="establishment_year" value="<?php echo $establishment_year;  ?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">Address`</label>
									<div class="col-sm-6">
										<input readonly type="text" name="address" value="<?php echo $address;  ?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-2 col-sm-2 control-label">World Ranking Position</label>
									<div class="col-sm-6">
										<input readonly type="text" name="world_ranking" value="<?php echo $world_ranking;  ?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-8" align="center">
										<a href="index.php" class="btn btn-info">Back To University List</a>
									</div>
								</div>

							</form>
						</div>
					</div>
					<!-- col-lg-12-->
				</div>



				<!-- /row -->
			</section>
			<!-- /wrapper -->
		</section>
		<!-- /MAIN CONTENT -->
		<!--main content end-->
		<!--footer start-->

		<!--footer end-->
	</section>

	<?php include('footer_resources.php');  ?>

</body>

</html>