<?php if (!$_SESSION['id']) {
	include('navTop.php');
} else { ?>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark mr-auto sticky-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">User Name : <?php echo $_SESSION['userName']; ?></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ms-auto">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About Us</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Contact Information</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							Wellcome <?php echo $_SESSION['userName']; ?>
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">							
							<li><a class="dropdown-item" href="logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>
<?php } ?>