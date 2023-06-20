<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Function to delete a user by ID
function deleteUser($userId) {
    global $pdo;
    try {
        $query = "DELETE FROM users WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$userId]);
    } catch (PDOException $e) {
        die("Error executing the query: " . $e->getMessage());
    }
}

try {
    $query = "SELECT * FROM users";
    $statement = $pdo->query($query);
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}

// Check if a delete request has been made
if (isset($_POST['delete'])) {
    $userId = $_POST['user_id'];
    deleteUser($userId);
    // Redirect to refresh the page after deleting
    header("Location: manageUsers.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" type="text/css" href="./styles/manage.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h1>Manage Users</h1>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>ZIP</th>
                    <th>Admin</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['first_name']; ?></td>
                        <td><?php echo $user['last_name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo $user['city']; ?></td>
                        <td><?php echo $user['zip']; ?></td>
                        <td><?php echo $user['admin']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <button type="submit" name="delete" class="btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>
</html>
