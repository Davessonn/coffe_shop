<?php
require_once 'startSession.php';
$title = 'All coffee recipe';
require_once 'header.php';


include 'db_config.php';
$conn = mysqli_connect(HOST, USER, PASSWD, DB);
$sql = "SELECT * FROM coffees";
$result = mysqli_query($conn, $sql);
$coffees = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php if (isset($_SESSION['username'])) : ?>
    <p><a class="links" href="add_coffee.php">Add Coffee</a></p>
    <p><a class="links" href="logout.php">Logout</a></p>
<?php else : ?>
    <p><a class="links" href="login.php">Login</a></p>
    <p><a class="links" href="register.php">Sign up</a></p>
<?php endif; ?>

<?php if (count($coffees) == 0) : ?>
    <p>No coffees found</p>
<?php else : ?>
    <ul class="coffe-list">
        <?php foreach ($coffees as $coffee) : ?>
            <li>
                <h2><?php echo $coffee['name']; ?></h2>
                <p><?php echo $coffee['description']; ?></p>
                <p>Price: $<?php echo number_format($coffee['price'], 2); ?></p>
                <?php if (isset($_SESSION['user_id']) && isset($_COOKIE['isAdmin']) && $_COOKIE['isAdmin'] == 1) : ?>
                    <p>
                        <a href="edit_coffee.php?id=<?php echo $coffee['id']; ?>">Edit</a>
                        <a href="delete_coffee.php?id=<?php echo $coffee['id']; ?>">Delete</a>
                    </p>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>