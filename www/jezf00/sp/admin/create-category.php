<?php
session_start();
require_once '../auth.php';
requireLogin();
requirePrivilege(2);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['category_id']) && !empty($_POST['name'])) {
        $category_id = $_POST['category_id'];
        $name = $_POST['name'];

        require_once '../dbconfig.php';
        $pdo = new PDO(
            'mysql:host=' . DB_HOST .
            ';dbname=' . DB_NAME .
            ';charset=utf8mb4',
            DB_USERNAME,
            DB_PASSWORD
        );

        // Sanitize the input
        $category_id = htmlspecialchars($_POST['category_id'], ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');

        // Validate the input
        if (!preg_match('/^[0-9]+$/', $category_id)) {
            $message = 'Invalid category ID. Please enter a valid number.';
        } else {
            $stmt = $pdo->prepare('SELECT * FROM sp_categories WHERE category_id = :category_id OR name = :name');
            $stmt->execute(['category_id' => $category_id, 'name' => $name]);
            $existingCategory = $stmt->fetch();

            if ($existingCategory) {
                $message = 'Category ID or name already exists. Please choose a different category ID or name.';
            } else {
                $stmt = $pdo->prepare('INSERT INTO sp_categories (category_id, name) VALUES (:category_id, :name)');
                $stmt->execute(['category_id' => $category_id, 'name' => $name]);

                header('Location: ../index.php');
                exit;
            }
        }
    } else {
        $message = 'Category ID and name are required.';
    }
}
?>

<?php require '../header.php'; ?>

<body class="container">
    <?php require '../navbar.php'; ?>
    <h1>Create Category</h1>

    <?php if (!empty($message)) : ?>
        <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="category_id">Category ID:</label>
        <input type="text" name="category_id" id="category_id" pattern="[0-9]+" title="Please enter only numbers" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br>

        <input type="submit" value="Create">
    </form>
</body>

<?php require '../footer.php'; ?>
