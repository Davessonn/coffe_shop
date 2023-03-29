<?php
// Database configuration
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASSWD', ''); /* In case you have no user_password, the following expression is required: define('PASSWD', ''); */
	define('DB', 'coffeeshop');

// Create connection
$conn = mysqli_connect(HOST, USER, PASSWD, DB);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>