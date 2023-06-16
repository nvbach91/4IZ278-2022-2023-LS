<?php require_once './ChatDatabase.php'; ?>
<?php

if (isset($_POST['message']) && isset($_POST['sender_id']) && isset($_POST['receiver_id']) && isset($_POST['listing_id'])) {
    $chatDb = new ChatDatabase();
    $chatDb->sendMessage($_POST['sender_id'], $_POST['receiver_id'], $_POST['listing_id'], $_POST['message']);
}
?>
