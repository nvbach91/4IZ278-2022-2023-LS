<?php require_once './Database.php'; ?>
<?php
class ChatDatabase extends Database
{
    public function getMessages($userId, $listingId)
    {
        $query = 'SELECT * FROM sp_messages WHERE 
         (receiver_id = :user_id OR sender_id = :user_id) 
         AND listing_id = :listing_id 
         ORDER BY sent_at ASC';
        $statement = $this->pdo->prepare($query);
        $params = [
            'user_id' => $userId,
            'listing_id' => $listingId,
        ];
        $statement->execute($params);
        $messages = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $messages;
    }

    public function markAsRead($userId, $listingId)
    {
        $updateQuery = 'UPDATE sp_messages SET is_read = 1 WHERE receiver_id = :user_id AND listing_id = :listing_id';
        $updateStatement = $this->pdo->prepare($updateQuery);
        $updateStatement->execute([
            'user_id' => $userId,
            'listing_id' => $listingId,
        ]);
    }


    public function getListingDetailsById($listingId)
    {
        $query = 'SELECT 
        sp_listings.price, 
        sp_vehicles.manufacturer, 
        sp_vehicles.model
        FROM 
            sp_listings
        JOIN 
            sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id
        WHERE 
            sp_listings.listing_id = :listing_id';

        $statement = $this->pdo->prepare($query);
        $params = ['listing_id' => $listingId];
        $statement->execute($params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getConversations($userId)
    {
        $query = 'SELECT 
            sp_listings.listing_id, 
            sp_listings.price, 
            sp_vehicles.manufacturer, 
            sp_vehicles.model, 
            sp_messages.sender_id,
            sp_messages.receiver_id,
            CASE
                WHEN sp_messages.sender_id = :user_id THEN sp_messages.receiver_id
                ELSE sp_messages.sender_id
            END AS partner_id,
            CASE
                WHEN sp_messages.sender_id = :user_id THEN (SELECT xname FROM sp_users WHERE user_id = sp_messages.receiver_id)
                ELSE (SELECT xname FROM sp_users WHERE user_id = sp_messages.sender_id)
            END AS partner_xname
            FROM 
                sp_messages
            JOIN 
                sp_listings ON sp_messages.listing_id = sp_listings.listing_id
            JOIN 
                sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id
            WHERE 
                sp_messages.sender_id = :user_id OR sp_messages.receiver_id = :user_id
            GROUP BY
                sp_listings.listing_id';

        $statement = $this->pdo->prepare($query);
        $params = ['user_id' => $userId];
        $statement->execute($params);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChatDetails($listingId, $userId)
    {
        $query = 'SELECT 
            sp_listings.listing_id, 
            sp_listings.price, 
            sp_vehicles.manufacturer, 
            sp_vehicles.model, 
            sp_messages.sender_id,
            sp_messages.receiver_id,
            CASE
                WHEN sp_messages.sender_id = :user_id THEN sp_messages.receiver_id
                ELSE sp_messages.sender_id
            END AS partner_id,
            CASE
                WHEN sp_messages.sender_id = :user_id THEN (SELECT xname FROM sp_users WHERE user_id = sp_messages.receiver_id)
                ELSE (SELECT xname FROM sp_users WHERE user_id = sp_messages.sender_id)
            END AS partner_xname
            FROM 
                sp_messages
            JOIN 
                sp_listings ON sp_messages.listing_id = sp_listings.listing_id
            JOIN 
                sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id
            WHERE 
                (sp_messages.sender_id = :user_id OR sp_messages.receiver_id = :user_id)
                AND sp_listings.listing_id = :listing_id
            GROUP BY
                sp_listings.listing_id';

        $statement = $this->pdo->prepare($query);
        $params = ['user_id' => $userId, 'listing_id' => $listingId];
        $statement->execute($params);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserNameById($userId)
    {
        $query = 'SELECT xname FROM sp_users WHERE user_id = :user_id';
        $statement = $this->pdo->prepare($query);
        $params = [
            'user_id' => $userId
        ];
        $statement->execute($params);
        return $statement->fetchColumn();
    }

    public function hasUnreadMessages($userId)
    {
        $query = 'SELECT COUNT(*) FROM sp_messages WHERE receiver_id = :user_id AND is_read = 0';
        $statement = $this->pdo->prepare($query);
        $params = [
            'user_id' => $userId,
        ];
        $statement->execute($params);
        $count = $statement->fetchColumn();
        return $count;
    }

    public function sendMessage($senderId, $receiverId, $listingId, $text)
    {
        $query = 'INSERT INTO sp_messages (sender_id, receiver_id, listing_id, text) VALUES (:sender_id, :receiver_id, :listing_id, :text)';
        $statement = $this->pdo->prepare($query);
        $params = [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'listing_id' => $listingId,
            'text' => $text,
        ];
        $statement->execute($params);
    }
}
