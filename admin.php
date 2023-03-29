<?php
require_once 'template.php';

// Check if user is logged in
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

// Fetch coffees from database
$db = new PDO('mysql:host=localhost;dbname=coffee_shop;charset=utf8', 'root', '');
$statement = $db->query('SELECT * FROM coffees');
$coffees = $statement->fetchAll(PDO::FETCH_ASSOC);
$statement->closeCursor();

// Build table of coffees
$table = '<table>
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Price</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>';
foreach ($coffees as $coffee) {
    $table .= '<tr>
					<td>' . $coffee['name'] . '</td>
					<td>' . $coffee['description'] . '</td>
					<td>$' . $coffee['price'] . '</td>
					<td><form action="delete_coffee.php" method="post">
							<input type="hidden" name="id" value="' . $coffee['id'] . '">
							<input type="submit" value="Delete">
						</form></td>
				</tr>';
}
$table .= '</tbody>
		</table>';

// Add form to add a new coffee
$form = '<form action="add_coffee.php" method="post">
			<h2>Add New Coffee</h2>
			<label>Name: <input type="text" name="name"></label>
			<label>Description: <textarea name="description"></textarea></label>
			<label>Price: $<input type="text" name="price"></label>
			<input type="submit" value="Add Coffee">
		</form>';

// Set content variable and echo template
$content = $table . $form;
echo $template;
?>