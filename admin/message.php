<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        $title= "Message";
        include('header_resources.php');
    ?>
    
</head>
<body>
<div class="container">
	<div class="row ">		
		<div class="col-md-4 offset-md-4">
			<?php if (isset($_SESSION['message-fail'])) : ?>
				<div class="alert alert-danger">
					<?php echo $_SESSION['message-fail']; ?>
				</div>
			<?php endif; ?>
        </div>
    </div>
</body>
</html>