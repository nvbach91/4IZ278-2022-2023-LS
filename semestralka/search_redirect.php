<?php
if (!isset($_GET['query'])) {
    
    header('Location: index.php');
    exit;
}

$query = strtolower(trim($_GET['query']));

if ($query === 'iphone') {
    header('Location: product_details.php?category_id=1');  
    exit;
}

if ($query === 'android') {
    header('Location: product_details.php?category_id=2');  
    exit;
}

if ($query === 'samsung') {
    header('Location: product_details.php?category_id=3');  
    exit;
}


header('Location: index.php');
exit;
?>
