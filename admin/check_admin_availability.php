<?php
require_once("connection.php");

if (!empty($_POST["email"])) {
    $email = $_POST["email"];
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "error : You did not enter a valid email.";
    } else {
        $query = "SELECT email FROM admin_registration WHERE email='$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<span style='color:red; font-size:20px;'> $result->num_rows Email already exist .</span>";
        } else {
            echo "<span style='color:green'> Email available for registration .</span>";
        }
    }
}
