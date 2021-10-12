<?php
session_start();
include('connection.php');
$title = "User Forgot Password";
include('includes/header_resources.php');
if (isset($_POST['find_password'])) {
    $email = $_POST['email'];
    $contact = $_POST['contactNo'];
    $stmt = $mysqli->prepare("SELECT email,contactNo,password FROM admin_registration WHERE (email=? && contactNo=?) ");
    $stmt->bind_param('ss', $email, $contact);
    $stmt->execute();
    $stmt->bind_result($username, $email, $password);
    $rs = $stmt->fetch();
    if ($rs) {
        $pwd = $password;
    } else {
        echo "<script>alert('Invalid Email/Contact no or password');</script>";
    }
}
?>
<head>
	<?php
	$title = "Hostel Management System_PGDICT Batch # 38_Group2";
	include('header_resources.php');   ?>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		a {
			text-decoration: none;
			color: #000;
		}

		.formContainer {
			height: 90vh;
			display: grid;
			align-content: center;
		}

		.formCenter {
			padding: 2rem;
			box-shadow: 5px 5px 20px rgba(179, 176, 176, 0.822);
		}
	</style>
</head>

<body>
	<?php include('header.php');
	?>

    <div class="row formContainer">
        <h2 class="page-title text-center">Forgot Password </h2>
        <div class="col-md-6 col-md-offset-3 formCenter">

            <?php if (isset($_POST['find_password'])) { ?>
                <p class="bg-dark p-3 text-light">Yuor Password is <?php echo $pwd; ?><br> Change the Password After login</p>
            <?php }  ?>
            <form action="" class="mt" method="post">
                <label for="" class="text-uppercase text-sm">Your Email</label>
                <input type="text" placeholder="Email" name="email" class="form-control mb" required>

                <label for="" class="text-uppercase text-sm">Your Contact Number</label>
                <input type="text" placeholder="Contact Number" name="contactNo" class="form-control mb" required>

                <input type="submit" name="find_password" class="form-control my-1 btn btn-secondary btn-block" value="Find Password">
            </form>
            <div class="d-grid gap-2 my-1">
                <a href="index.php" class="btn btn-info">LogIn</a>
            </div>
        </div>
    </div>
</div>
<!-- 
<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold text-light mt-4x">Forgot Password</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <div class="col-md-8 col-md-offset-2">
                            <?php if (isset($_POST['login'])) { ?>
                                <p>Yuor Password is <?php echo $pwd; ?><br> Change the Password After login</p>
                            <?php }  ?>
                            <form action="" class="mt" method="post">
                                <label for="" class="text-uppercase text-sm">Your Email</label>
                                <input type="email" placeholder="Email" name="email" class="form-control mb">
                                <label for="" class="text-uppercase text-sm">Your Contact no</label>
                                <input type="text" placeholder="Contact no" name="contact" class="form-control mb">


                                <input type="submit" name="login" class="btn btn-primary btn-block" value="login">
                            </form>
                        </div>
                    </div>
                    <div class="text-center text-light">
                        <a href="index.php" class="text-light">Sign in?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<?php include('includes/footer_resources.php'); ?>