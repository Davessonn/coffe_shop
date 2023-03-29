<?php

session_start();
$title = 'Log in';
require_once('header.php');

$error = "";
require_once ('db_config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $conn = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
    // Sanitize user input to prevent SQL injection
    $user_username = mysqli_real_escape_string ($conn, $_POST['username']);
    $user_password = mysqli_real_escape_string ($conn, $_POST['password']);

    // Check if user exists in the database


    if(!empty($user_username) && !empty($user_password)) {
        $sql = "SELECT * FROM users WHERE username='$user_username' AND password = SHA('$user_password')";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_array($result);
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            setcookie('user_id', $user['user_id'], time() + (60 * 60 * 24));
            setcookie('username', $user['username'], time() + (60 * 60 * 24));
            if ($user['is_admin'] == 1) {
                $_SESSION['isAdmin'] = 1;
                setcookie('isAdmin', 1, time() + (60 * 60 * 24));
            } else {
                $_SESSION['isAdmin'] = 0;
                setcookie('isAdmin', 0, time() + (60 * 60 * 24));
            }
            header("Location: index.php");
            exit();
        } else {
            $error = 'Please enter a valid username and password to log in.';
        }
    } else {
        $error = 'Please enter your username and password to log in.';
    }
}

?>


<form class="login-form" method="post">
    <?php if ($error != "") : ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <label>Username</label>
    <input type="text" name="username" required>
    <br>
    <label>Password</label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Login</button>
</form>

