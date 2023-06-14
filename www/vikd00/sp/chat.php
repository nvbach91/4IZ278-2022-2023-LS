<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php require_once './ChatDatabase.php'; ?>
<?php if (requirePrivilege(1)) ?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<?php

$db = new ChatDatabase();
$conversations = $db->getConversations($_SESSION['user']['user_id']);

if (isset($_GET['reciever_id']) &&  isset($_GET['listing_id'])) {
    $reciever_id = $_GET['reciever_id'];
    $listing_id = $_GET['listing_id'];
    $sender_id = $_SESSION['user']['user_id'];

    $chatDetails = $db->getChatDetails($listing_id, $_SESSION['user']['user_id']);

    if ($chatDetails) {
        $recipient_name = $chatDetails['partner_xname'];
        $manufacturer = $chatDetails['manufacturer'];
        $model = $chatDetails['model'];
        $price = $chatDetails['price'];
    } else {
        $recipient_name = $db->getUserNameById($reciever_id);
        $listingDetails = $db->getListingDetailsById($listing_id);
        $manufacturer = $listingDetails['manufacturer'];
        $model = $listingDetails['model'];
        $price = $listingDetails['price'];
    }
} else {
    $reciever_id = $listing_id = $sender_id = null;
}
?>

<div class="chatbox">
    <h3 class="m-4">Správy</h3>
    <div class="container-fluid h-100 pb-4">
        <div class="row px-4 h-100">
            <div class="col-4">
                <ul class="list-group">
                    <?php foreach ($conversations as $conversation) : ?>
                        <li class="list-group-item m-2">
                            <form method="GET" class="mb-0">
                                <div class="row">
                                    <div class="col-8">
                                        <input type="hidden" name="reciever_id" value="<?php echo $conversation['partner_id']; ?>">
                                        <input type="hidden" name="listing_id" value="<?php echo $conversation['listing_id']; ?>">
                                        <p><b><?php echo $conversation['partner_xname'] ?></b></p>
                                        <p><i><?php echo $conversation['manufacturer'] . ' ' . $conversation['model'] . ' - ' . $conversation['price'] . '€'; ?></i></p>
                                    </div>
                                    <div class="col-4 m-auto">
                                        <button class="btn btn-outline-dark" type="submit">Otvor</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-8 verticalLine h-100 d-flex flex-column">
                <?php if (!isset($_GET['reciever_id']) ||  !isset($_GET['listing_id'])) : ?>
                    <p>Nie je vybraná žiadna konverzácia</p>
                <?php else : ?>
                    <h4 class="placeholder"><b><?php echo $recipient_name; ?></b></h4>
                    <p><i><?php echo $manufacturer . ' ' . $model . ' - ' . $price . '€'; ?></i></p>
                    <div class="flex-grow-1 conversations pb-2 mb-4 px-2" id="chat"></div>
                    <form id="messages" class="flex-shrink-0 w-100 d-flex">
                        <input oninput="toggleButton(this)" class="form-control me-2" type="text" id="message" placeholder="Odpoveď...">
                        <button class="btn btn-outline-dark" type="button" id="send" disabled>Odoslať</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require './footer.php'; ?>

<script>
    $(document).ready(function() {
        var senderId = <?php echo json_encode($sender_id); ?>;
        var receiverId = <?php echo json_encode($reciever_id); ?>;
        var listingId = <?php echo json_encode($listing_id); ?>;
        var messageLength = 0;

        function sendMessage() {
            var message = $('#message').val();
            $.ajax({
                url: './send-message.php',
                method: 'POST',
                data: {
                    message: message,
                    sender_id: senderId,
                    receiver_id: receiverId,
                    listing_id: listingId
                },
                success: function() {
                    $('#message').val('');
                }
            });
        }

        function pollMessages() {
            console.log("polling")
            $.ajax({
                url: './get-messages.php',
                method: 'GET',
                data: {
                    receiver_id: receiverId,
                    listing_id: listingId
                },
                dataType: 'json',
                success: function(response) {
                    if (response && response.length > 0) {
                        var shouldScroll = isScrolledToBottom();
                        $('#chat').empty();
                        response.forEach(function(message) {
                            $('#chat').append("<div class='" + (message.sender_id == senderId ? "chat-bubble-me bg-primary" : "chat-bubble-other bg-dark") + "'>" + message.text + "</div>")
                        });
                        if (messageLength != response.length) {
                            autoScrollDown();
                        }
                        messageLength = response.length;
                    }
                    setTimeout(pollMessages, 2000); // Poll every 2.5 second
                },
            });
        }

        function isScrolledToBottom() {
            var chatElement = document.getElementById('chat');
            return chatElement.scrollHeight - chatElement.scrollTop === chatElement.clientHeight;
        }

        function autoScrollDown() {
            var chatElement = document.getElementById('chat');
            chatElement.scrollTop = chatElement.scrollHeight;
        }

        $('#send').on('click', function(e) {
            e.preventDefault();
            sendMessage();
        });

        if ($('#messages')) $('#messages').on('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });

        $('#message').on('input', function() {
            toggleButton($('#message').val());
        });

        function toggleButton(inputValue) {
            $('#send').prop('disabled', inputValue.trim() === '');
        }


        pollMessages();
    });
</script>