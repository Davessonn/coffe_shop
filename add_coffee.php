<?php
session_start();
$title = 'Add coffee';
require_once('header.php');

$error = "";
require_once 'db_config.php';
$conn = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user input to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    // Insert coffee into the database
    $sql = "INSERT INTO coffees (name, description, price) VALUES ('$name', '$description', '$price')";
    if (mysqli_query($conn, $sql)) {
        header("Location: coffees.php");
        exit();
    } else {
        $error = "Error adding coffee";
    }
}
?>

<?php if ($error != "") : ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form class="add-coffee-form" method="post">
    <label>Name</label>
    <input type="text" name="name" required>
    <br>
    <label>Description</label>
    <textarea name="description" required></textarea>
    <br>
    <label>Price</label>
    <input type="number" name="price" step="0.01" min="0" required>
    <br>
    <button type="submit">Add Coffee</button>
</form>