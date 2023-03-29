<?php
$title = 'Enter your username and password to sign up!';
require_once('header.php');
require_once('db_config.php');

$dbc = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');

if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
?>
<div class="registered">
<?php
    if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2))
    {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $data = mysqli_query($dbc, $query);

        if(mysqli_num_rows($data) == 0)
        {
                $query = "INSERT INTO users (username, password) VALUES('$username', SHA('$password1'))";
                mysqli_query($dbc, $query);
                echo '<h3>Your account is created. You can <a href="login.php">log in</a> and edit your profile.</h3>';
                echo '<h2><a class="links" href = "index.php">Home</a></h2>';
                mysqli_close($dbc);
                exit();
        }else{ echo '<h4>There is an account for this username, plesase use a different one.</h4>'; $username = ""; }
    }else{ echo '<h4>Each data has to be entered (password twice).</h4>';}
?>
</div>
<?php
}
mysqli_close($dbc);
?>

<form class="signup-form" id = "formId" method = "post" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
        <p>username: <input type = "text" name = "username" value = "<?php if(!empty($username)){echo $username;} ?>"/></p>
        <p>password: <input type = "password" name = "password1"/></p>
        <p>password (retype): <input type = "password" name = "password2"/></p>
    </fieldset>
    <fieldset id = "last">
        <p id = "buttons">
            <button type = "submit" value = "Sign up" name = "submit">Sign up</button>
        <h3><a href = "index.php">Home</a></h3>
        </p>
    </fieldset>
</form>



</body>
</html>