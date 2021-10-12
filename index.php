<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$stmt = $mysqli->prepare("SELECT email,password, id,firstName,middleName,lastName FROM userregistration WHERE email=? and password=? ");
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($email, $password, $id, $firstName, $middleName, $lastName);
	$rs = $stmt->fetch();
	$stmt->close();
	$_SESSION['id'] = $id;
	$_SESSION['login'] = $email;
	$_SESSION['userName'] = $firstName . " " . $middleName . " " . $lastName;
	$uip = $_SERVER['REMOTE_ADDR'];
	$ldate = date('d/m/Y h:i:s', time());
	if ($rs) {
		$uid = $_SESSION['id'];
		$uemail = $_SESSION['login'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
		$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
		$city = $addrDetailsArr['geoplugin_city'];
		$country = $addrDetailsArr['geoplugin_countryName'];
		$log = "insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
		$mysqli->query($log);
		if ($log) {
			header("Location:dashboard.php");
		}
	} else {
		echo "<script>alert('Invalid Username/Email or password');</script>";
	}
}
?>

<?php
$title = "HMS Student Log In";
include('includes/header_resources.php');
include('includes/navTop.php');

?>

<div class="container-fluid">
	<div class="row formContainer">
		<h2 class="page-title text-center">Student Login Page </h2>
		<div class="col-md-4 offset-md-4 formCenter">
			<?php if (isset($_SESSION['message-success'])) : ?>
				<div class="alert alert-success">
					<?php echo $_SESSION['message-success']; ?>
				</div>
			<?php endif; ?>
			<?php unset($_SESSION['message-success']); ?>

			<form action="" class="mt" method="post">
				<label for="" class="text-uppercase text-sm">Email</label>
				<input type="text" placeholder="Email" name="email" class="form-control mb" required>

				<label for="" class="text-uppercase text-sm">Password</label>
				<input type="password" placeholder="Password" name="password" class="form-control mb" required>

				<input type="submit" name="login" class="form-control my-1 btn btn-primary btn-block" value="login">
			</form>
			<div class="d-grid gap-2 my-1">
				<a href="forgot-password.php" class="btn btn-secondary">Forgot password ?</a>
				<a href="student_reg_info_entry.php" class="btn btn-info">New ? Sign Up here</a>
			</div>
		</div>
	</div>
</div>

<?php
include('includes/footer_resources.php');
include('includes/footer.php');
?>