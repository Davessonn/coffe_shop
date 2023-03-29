<?php
session_start();
$title = 'Delete coffee';
require_once('header.php');

// Redirect non-admin user to index.php
if ($_SESSION['isAdmin'] == 0) {
    header("Location: index.php");
    exit();
}

$error = "";
require_once 'db_config.php';
$conn = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Delete coffee from the database
    $sql = "DELETE FROM coffees WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        header("Location: coffees.php");
        exit();
    } else {
        $error = "Error deleting coffee";
    }
} else {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
}

?>

<?php if ($error != "") : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<form class="delete-coffee-form" method="post">
    <p>Are you sure you want to delete this coffee?</p>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <button type="submit">Yes</button>
    <a href="coffees.php">No</a>
</form>