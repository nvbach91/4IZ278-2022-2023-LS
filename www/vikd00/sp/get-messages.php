<?php require_once './ChatDatabase.php'; ?>
<?php

if (isset($_GET['receiver_id']) && isset($_GET['listing_id'])) {
    $chatDb = new ChatDatabase();
    $messages = $chatDb->getMessages($_GET['receiver_id'], $_GET['listing_id']);
    echo json_encode($messages);
}
