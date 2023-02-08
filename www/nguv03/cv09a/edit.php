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

    $date_modified = $category['date_modified'];

    if ($date_modified != $_POST['date_modified']) {
        exit('This record has been modified while you were editing');
    } else {
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
    }

} else if ('GET' == $_SERVER['REQUEST_METHOD']) {
    $category_id = $_GET['id'];

    $statement = $db->prepare("
        SELECT * FROM categories WHERE category_id = :category_id LIMIT 1;
    ");
    $statement->execute([
        'category_id' => $category_id
    ]);

    $category = $statement->fetchAll()[0];

    $name = $category['name'];
    $date_modified = $category['date_modified'];

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