<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once "db.php";

// Check if the user is logged in as an admin

if ((!isset($_SESSION['admin']) || $_SESSION['admin'] !== true)) {
    header("Location: login.php"); // Redirect to the login page or display an access denied message
    exit();
}

//  Handle form submission for updating users table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_user'])) {
        $id = $_POST['id'];
        $jmeno = $_POST['jmeno'];
        $prijmeni = $_POST['prijmeni'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $cislo_mobilu = $_POST['cislo_mobilu'];
        $admin = false;
        if ($_POST['admin'] == 1 || $_POST['admin'] == $id) {
            $admin = true;
        }  // Check if the user is an admin

        $query = "UPDATE users SET name = '$jmeno', surname = '$prijmeni', password = '$password', email = '$email', phoneNumber = '$cislo_mobilu' WHERE id = $id";

        // Execute the update query
        mysqli_query($connection, $query);

        // Check if the user exists in the admins table
        $admin_query = "SELECT * FROM users WHERE admin = $id";
        $admin_req = mysqli_query($connection, $admin_query);
        $is_user_admin = mysqli_num_rows($admin_req) > 0;

        if ($admin && !$is_user_admin) {
            // User is an admin but not listed in the admins table, so insert a new record
            $admin_insert_query = "UPDATE users SET admin = '$id' where id = '$id'";
            mysqli_query($connection, $admin_insert_query);
        }
        if (!$admin) {
            // User is not an admin but listed in the admins table, so delete the record
            $admin_delete_query = "UPDATE users SET admin = 'null' where id = '$id'";
            mysqli_query($connection, $admin_delete_query);
        }
        if (mysqli_query($connection, $query)) {
            $message = "Uživatel úspěšně aktualizován!";
        } else {
            echo "Error updating user: " . mysqli_error($connection);
        }
        echo $message;
    } elseif (isset($_POST['update_zbozi']) || isset($_POST['create_item'])) {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $nazev = $_POST['nazev'];
        $popis = $_POST['popis'];
        $cena = $_POST['cena'];
        $akce = $_POST['akce'];
        if ($akce <= 0) {
            $akce = 0;
        }
        $categoryName = $_POST['category'];
        if (isset($id)) {
            $query = "UPDATE courses SET title = '$nazev', `description` = '$popis', price = $cena, discount = $akce, `category` = '$categoryName' WHERE id = $id";
            if (mysqli_query($connection, $query)) {
                $message = "Zboží úspěšně aktualizováno!";
                unset($_POST['create_item']);
            } else {
                echo "Error updating zbozi: " . mysqli_error($connection);
            }
        } else {
            $query = "INSERT INTO courses SET title = '$nazev', `description` = '$popis', price = $cena, discount = $akce, `category` = '$categoryName' ";
            if (mysqli_query($connection, $query)) {
                $message = "Zboží úspěšně aktualizováno!";
                unset($_POST['create_item']);
            } else {
                echo "Error updating zbozi: " . mysqli_error($connection);
            }
        }


        // Execute the update query
        
        echo $message;
    } elseif (isset($_POST['delete_order'])) {
        $order_id = $_POST['order_id'];

        $delete_query = "DELETE FROM orders WHERE orderID = $order_id";

        // Execute the delete query
        if (mysqli_query($connection, $delete_query)) {
            $message = "Objednávka úspěšně smazána!";
        } else {
            echo "Error deleting order: " . mysqli_error($connection);
        }
        echo $message;
    }
}

// Fetch the data for the users table
$query = "SELECT * FROM users";
$req = mysqli_query($connection, $query);
$users_data = [];

while ($result = mysqli_fetch_assoc($req)) {
    $users_data[] = $result;
}

// Fetch the data for the zbozi table
$query = "SELECT * FROM courses";
$req = mysqli_query($connection, $query);
$zbozi_data = [];

while ($result = mysqli_fetch_assoc($req)) {
    $zbozi_data[] = $result;
}

// Fetch the data for the objednavky table
$query = "SELECT orderinfo.id, orderinfo.orderID, users.name, users.email, courses.title AS title, courses.price AS price FROM orderinfo JOIN orders on orders.orderID = orderinfo.orderID JOIN users ON orders.userID = users.id JOIN courses ON orderinfo.courseID = courses.id ORDER BY orderinfo.id";
$req = mysqli_query($connection, $query);
$objednavky_data = [];

while ($result = mysqli_fetch_assoc($req)) {
    $objednavky_data[] = $result;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <a href="index.php" class="cart-link">Home</a>
    <h1>Admin Panel</h1>

    <h2>Update Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Jméno</th>
            <th>Příjmení</th>
            <th>Password</th>
            <th>Email</th>
            <th>Číslo mobilu</th>
            <th>Admin</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users_data as $row) : ?>
            <form method="POST">
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><input type="text" name="jmeno" value="<?php echo $row['name']; ?>"></td>
                    <td><input type="text" name="prijmeni" value="<?php echo $row['surname']; ?>"></td>
                    <td><input type="password" name="password" value="<?php echo $row['password']; ?>"></td>
                    <td><input type="email" name="email" value="<?php echo $row['email']; ?>"></td>
                    <td><input type="text" name="cislo_mobilu" value="<?php echo $row['phoneNumber']; ?>"></td>
                    <td><input type="text" name="admin" value="<?php echo $row['admin']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="update_user" value="Update">
                    </td>
                </tr>
            </form>
        <?php endforeach; ?>
    </table>

    <h2>Update Zbozi</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Název</th>
            <th>Popis</th>
            <th>Cena</th>
            <th>Akce</th>
            <th>Kategorie</th>
        </tr>
        <?php foreach ($zbozi_data as $row) : ?>
            <form method="POST">
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><input type="text" name="nazev" value="<?php echo $row['title']; ?>"></td>
                    <td><input type="text" name="popis" value="<?php echo $row['description']; ?>"></td>
                    <td><input type="number" name="cena" value="<?php echo $row['price']; ?>"></td>
                    <td><input type="number" name="akce" value="<?php echo $row['discount']; ?>"></td>
                    <td><input type="text" name="category" value="<?php echo $row['category']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="update_zbozi" value="Update">
                    </td>
                </tr>
            </form>
        <?php endforeach; ?>

    </table>
    <h2>Create Item</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Category</th>
        </tr>
        <form method="POST">
            <tr>
                <td><input type="text" name="nazev" required></td>
                <td><input type="text" name="popis" required></td>
                <td><input type="number" name="cena" required></td>
                <td><input type="number" name="akce" required></td>
                <td><input type="text" name="category" required></td>
                <td><input type="submit" name="create_item" value="Create Item"></td>
            </tr>
        </form>
    </table>
    <h2>List of Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>orderID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course Name</th>
            <th>Course Price</th>
            <th>Action</th>
        </tr>
        <?php foreach ($objednavky_data as $objednavka) : ?>
            <tr>
                <td><?php echo $objednavka['id']; ?></td>
                <td><?php echo $objednavka['orderID']; ?></td>
                <td><?php echo $objednavka['name']; ?></td>
                <td><?php echo $objednavka['email']; ?></td>
                <td><?php echo $objednavka['title']; ?></td>
                <td><?php echo $objednavka['price']; ?></td>
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