<?php
// Database configuration
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASSWD', '12345'); /* In case you have no user_password, the following expression is required: define('PASSWD', ''); */
	define('DB', 'coffeedb');

// Create connection
$conn = mysqli_connect(HOST, USER, PASSWD, DB);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>