<?php require './db.php'; ?>
<?php

session_start();

if (!$_SESSION['user_id']) {
    exit;
}
if (!$_SESSION['user_privilege'] < 2) {
    // ne exitovat, ale presmerovavat
    exit('You do not have the required privilege to open this page');
}

$pessimisticLockTimeLimit = 3600;

if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $name = $_POST['name'];
    $category_id = $_POST['id'];

    $statement = $db->prepare("
        SELECT * FROM categories WHERE category_id = :category_id LIMIT 1;
    ");
    $statement->execute([
        'category_id' => $category_id
    ]);

    $category = $statement->fetchAll()[0];

    $statement = $db->prepare("
        UPDATE categories SET name = :name,
                                date_modified = now()
                            WHERE category_id = :category_id;
    ");
    $statement->execute([
        'category_id' => $category_id,
        'name' => $category['name'],
    ]);

    exit('SUCCESS!');

} else if ('GET' == $_SERVER['REQUEST_METHOD']) {
    $category_id = $_GET['id'];

    $statement = $db->prepare("
        SELECT * FROM categories WHERE category_id = :category_id LIMIT 1;
    ");
    $statement->execute([
        'category_id' => $category_id
    ]);

    $category = $statement->fetchAll()[0];

    $edit_by = $category['edit_by'];

    if ($edit_by != $_SESSION['user_id']) {
        if (time() - time($category['edit_at']) < $pessimisticLockTimeLimit) {
            exit('someone else is editing, please wait up to 1 hour');
        }
    }
    
    $name = $category['name'];

    $statement = $db->prepare("
        UPDATE categories SET edit_by = :edit_by
                          WHERE category_id = :category_id;
    ");

    $statement->execute([
        'category_id' => $category_id,
        'edit_by' => $_SESSION['user_id'],
        'edit_at' => time(),
    ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input name="name" placeholder="name" value="<?php echo @$name; ?>">
        <input name="id" hidden value="<?php echo @$category_id; ?>">
        <input name="date_modified" hidden value="<?php echo @$date_modified; ?>">
        <button>Save</button>
    </form>
</body>
</html>