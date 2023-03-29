<?php
session_start();
$title = 'Edit coffee';
require_once('header.php');
// Redirect non-admin user to coffees.php
if ($_SESSION['isAdmin'] == 0) {
    header("Location: coffees.php");
    exit();
}



// Check if coffee ID is set
if (isset($_GET['id'])) {
    require ('db_config.php');
    $conn = mysqli_connect(HOST, USER, PASSWD, DB) or die('Connection error...');
    $id = $_GET['id'];

    // Fetch coffee from database
    $sql = "SELECT * FROM coffees WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $coffee = mysqli_fetch_assoc($result);
    } else {
        // Redirect to coffees.php if coffee not found
        header("Location: coffees.php");
        exit();
    }
} else {
    // Redirect to coffees.php if ID is not set
    header("Location: coffees.php");
    exit();
}

// Check if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Update coffee in database
    $sql = "UPDATE coffees SET name = '$name', description = '$description', price = '$price' WHERE id = '$id'";
    mysqli_query($conn, $sql);

    // Redirect to coffees.php after successful update
    header("Location: coffees.php");
    exit();
}

?>

<form class="edit-coffee-form" method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $coffee['name']; ?>">

    <label for="description">Description:</label>
    <textarea id="description" name="description"><?php echo $coffee['description']; ?></textarea>

    <label for="price">Price:</label>
    <input type="number" id="price" name="price" step="0.01" value="<?php echo $coffee['price']; ?>">

    <button type="submit" value="Save">Save</button>
</form>