<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Function to delete a category by ID
function deleteCategory($categoryId) {
    global $pdo;
    try {
        $query = "DELETE FROM categories WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$categoryId]);
    } catch (PDOException $e) {
        die("Error executing the query: " . $e->getMessage());
    }
}

try {
    $query = "SELECT * FROM categories";
    $statement = $pdo->query($query);
    $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error executing the query: " . $e->getMessage());
}

// Check if a delete request has been made
if (isset($_POST['delete'])) {
    $categoryId = $_POST['category_id'];
    deleteCategory($categoryId);
    // Redirect to refresh the page after deleting
    header("Location: manageCategories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Categories</title>
    <link rel="stylesheet" type="text/css" href="./styles/manage.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h1>Manage Categories</h1>

    <section>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?php echo $category['id']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
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
