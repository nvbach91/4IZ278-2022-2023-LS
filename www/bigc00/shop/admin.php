<?php
session_start();
require_once "db.php";

// Check if the user is logged in as an admin

// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     header("Location: login.php"); // Redirect to the login page or display an access denied message
//     exit();
// }

// Handle form submission for updating zbozi table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_zbozi'])) {
        $id = $_POST['id'];
        $nazev = $_POST['nazev'];
        $popis = $_POST['popis'];
        $cena = $_POST['cena'];

        $query = "UPDATE zbozi SET nazev = '$nazev', popis = '$popis', cena = $cena WHERE id = $id";

        if (mysqli_query($connection, $query)) {
            $message = "Zboží úspěšně aktualizováné!";
        } else {
            echo "Error updating zbozi: " . mysqli_error($connection);
        }
        echo $message;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $orderId = $_POST['order_id'];
    $query = "DELETE FROM objednavky WHERE id = $orderId";

    if (mysqli_query($connection, $query)) {
        $message = "Produkt byl odstraněn!";
    } else {
        echo "Error při odstranění: " . mysqli_error($connection);
    }
    echo $message;


}
// Fetch the data for the zbozi table
$query = "SELECT * FROM zbozi";
$req = mysqli_query($connection, $query);
$data_from_db = [];

while ($result = mysqli_fetch_assoc($req)) {
    $data_from_db[] = $result;
}

// Fetch the data for the objednavky table sorted by objednavky.id
$query = "SELECT * FROM objednavky ORDER BY orderID";
$req = mysqli_query($connection, $query);
$objednavky_data = [];

while ($result = mysqli_fetch_assoc($req)) {
    $objednavky_data[] = $result;
}

?>

<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin panel</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <a href="index.php" class="cart-link">Home</a>
    <h1>Admin Panel</h1>

    <h2>Update Zbozi</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nazev</th>
            <th>Popis</th>
            <th>Cena</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data_from_db as $row) : ?>
            <form method="POST">
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><input type="text" name="nazev" value="<?php echo $row['nazev']; ?>"></td>
                    <td><input type="text" name="popis" value="<?php echo $row['popis']; ?>"></td>
                    <td><input type="number" name="cena" value="<?php echo $row['cena']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="update_zbozi" value="Update">
                    </td>
                </tr>
            </form>
        <?php endforeach; ?>
    </table>

    <h2>List of Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>orderID</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Course Name</th>
            <th>Course Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($objednavky_data as $objednavka) : ?>
            <tr>
                <td><?php echo $objednavka['id']; ?></td>
                <td><?php echo $objednavka['orderID']; ?></td>
                <td><?php echo $objednavka['jmeno']; ?></td>
                <td><?php echo $objednavka['cislo_mobilu']; ?></td>
                <td><?php echo $objednavka['nazev_kurzu']; ?></td>
                <td><?php echo $objednavka['cena_kurzu']; ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
                        <input type="hidden" name="order_id" value="<?php echo $objednavka['id']; ?>">
                        <button type="submit" name="delete_order">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>