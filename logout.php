<?php
session_start();

// Unset session variables and destroy session
if(isset($_SESSION['user_id']))
{
    $_SESSION = array();

    if(isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(), '', time() - 10);
    }
    session_destroy();
}

setcookie('user_id', '', time() - 10);
setcookie('username', '', time() - 10);
setcookie('isAdmin', 0, time() - 10);

// Redirect to index page
header('Location: index.php');
exit();
?>
