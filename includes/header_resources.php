<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">

    <link rel="stylesheet" href="fontawesome/fontawesome.min.css">
    <link rel="stylesheet" href="fontawesome/all.min.css">

    <link rel="stylesheet" href="s-style.css">


    <script defer src="bootstrap5/js/bootstrap.min.js"></script>
    <script src="fontawesome/fontawesome.min.js"></script>

    <script type="text/javascript" src="js/jquery-1.11.3-jquery.min.js"></script>
    <script type="text/javascript" src="js/validation.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

    <script type="text/javascript">
        function valid() {
            if (document.registration.password.value != document.registration.cpassword.value) {
                alert("Password and Re-Type Password Field do not match  !!");
                document.registration.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>


    <title><?php echo $title; ?></title>



</head>

<body>