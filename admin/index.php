<?php
session_start();
include('connection.php');
include("function.php");

if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$sql = "SELECT email,password, admin_id,admin_user_level,firstName,middleName,lastName 
			 FROM admin_registration 
			 WHERE email='$email' and password='$password' 
			";
	$result = $conn->query($sql);
	while ($row = $result->fetch_array()) {
		$username = $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'];
		$_SESSION['id'] = $row['admin_id'];
		$_SESSION['admin_user_level'] = $row['admin_user_level'];
		$_SESSION['login'] = $row['email'];
		$_SESSION['userName'] = $username;

		header("Location:dashboard.php");
	}
	echo "<script>alert('Invalid Username/Email or password');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<link href="../s-style.css" rel="stylesheet">
	<?php
	$title = "Admin Log In";
	include('header_resources.php');
	include('header.php');
	?>

</head>

<body>
	<!-- <div class="container-fluid "> -->
	<section id="main-content">
		<div class="col-md-2 ">" " </div>
		<div class="row formContainer">
			<h2 class="page-title">Admin Login Page </h2>
			<div class="col-md-6 formCenter">
				<form action="" class="" method="post">
					<label for="" class="text-uppercase text-sm">Email</label>
					<input type="text" placeholder="Email" name="email" class="form-control mb" required>

					<label for="" class="text-uppercase text-sm">Password</label>
					<input type="password" placeholder="Password" name="password" class="form-control mb" required>

					<input type="submit" name="login" class=" my-1 px-5 btn btn-success" value="Log In">
					<a href="forgot-password.php" class="btn btn-info">Forgot password ?</a>
				</form>
			</div>
		</div>

	</section>
	</div>
	<?php
	include('footer_resources.php');
	include('../includes/footer.php');
	?>


</body>

</html>