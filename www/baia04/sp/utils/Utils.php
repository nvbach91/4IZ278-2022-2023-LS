<?php 
require('../utils/IUtils.php');
require_once('../utils/Database.php');
require_once('../config/config.php');
class Utils implements IUtils {
    private static $instances = [];
    private static $db;
    public static function getInstance() {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }
        self::$db = new Database();
        return self::$instances[$cls];
    }

    public function getDB() {
        return Utils::$db;
    }

    public function saveUser(Form $form) {
        $db = Utils::$db;
        $userByEmail = $db -> getUserByEmail($form -> getEmail());
        $userByPhone = $db -> getUserByPhone($form -> getPhoneNumber());
        if (count($userByEmail) || count($userByPhone)) {
            return false;
        }

        $email = $form -> getEmail();
        $sql = "INSERT INTO `users`(`email`, `phoneNumber`, `password`, `is_admin`) 
            VALUES (:email, :phoneNumber, :password, :is_admin)";
        $user = [
            'email' => $email,
            'phoneNumber' => $form -> getPhoneNumber(),
            'password' => password_hash($form -> getPassword(), PASSWORD_BCRYPT),
            'is_admin' => 0
        ];
        $db -> execute($sql, $user);

        $userID = $db -> getUserByEmail($email)[0]['user_id'];
        $date = new DateTime($form -> getDateOfBirth());
        $sql = "INSERT INTO `profiles`(`user_id`, `name`, `surname`, `description`, `date_birth`) 
            VALUES (:user_id, :name, :surname, :description, :date_birth)";
        $profile = [
            'user_id' => $userID,
            'name' => $form -> getFirstName(),
            'surname' => $form -> getLastName(),
            'description' => '',
            'date_birth' => $date -> format('Y-m-d')
        ];
        $db -> execute($sql, $profile);
        return true;
    }

    public function validateLogin(array $form) {
        $db = Utils::$db;
        $login = $form['emailOrPhone'];
        $password = $form['password'];
        $user = $db -> getUserByEmail($login);
        if (!$user) {
            $user = $db -> getUserByPhone($login);
        }
        if (!$user) {
            return ['userNotFound'];
        }
        $isCorrect = password_verify($password, $user[0]['password']);
        if (!$isCorrect) {
            return ['wrongPassword'];
        }
        return $user[0]['user_id'];
    }

    public function newPost(int $userID) {
        $db = Utils::$db;
        if (!$_POST['text']) {
            return;
        }
        $text = htmlspecialchars(trim($_POST['text']));
        $now = new DateTime();
        $post = [
            'authorID' => $userID,
            'text' => $text,
            'date' => $now -> format('Y-m-d H:i:s')
        ];

        $sql = "INSERT INTO `posts`(`author_id`, `text`, `date`) VALUES ( :authorID, :text, :date)";
        $db -> execute($sql, $post);

        $sql = "SELECT * FROM `posts` WHERE `author_id` = :authorID AND `text` = :text AND `date` = :date";
        $postID = $db -> execute($sql, $post)[0]['post_id'];
        $path = "../uploads/" . 'post_' . basename($postID) . '.png';
        if (file_exists($path)) {
            unlink($path);
        }
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $path);
    }

    public function getUser(int $userID)  {
        $user = Utils::$db -> getUserByField($userID, 'user_id')[0];
        $profile = Utils::$db -> getProfile($userID)[0];
        $date = new DateTime($profile['date_birth']);
        return [
            'name' => $profile['name'],
            'surname' => $profile['surname'],
            'description' => $profile['description'],
            'phoneNumber' => $user['phoneNumber'],
            'is_admin' => $user['is_admin'],
            'avatar' => $this -> getUserAvatar($userID),
            'dateOfBirth' => $date -> format('Y-m-d') 
        ];
    }

    public function getUserAvatar(int $userID) {
        $fileStr = '../uploads/' . 'avatar_' . $userID . '.png';
        $defaultAvatar = '../uploads/' . 'defaultAvatar.png';
        if (file_exists($fileStr)) {
            return $fileStr;
        } else {
            return $defaultAvatar;
        }
    }
    
    public function getPostImage(int $postID) {
        $img = '../uploads/post_' . $postID . '.png';
        return file_exists($img) ? $img : '';
    }

    public function getTime(string $dateTime) {
        $now = new DateTime();
        $posted = new DateTime($dateTime);
        $difference = date_diff($now, $posted);
        $time = $posted->format('d.m.Y');;
        if ($difference -> h >= 12 ) {
            $time = $posted->format('d.m.Y');
        } else if ($difference -> h > 0) {
            $time = $difference -> h . ' hours ago';
        } else if ($difference -> i > 0) {
            $time = $difference -> i . ' minutes ago';
        } else if ($difference -> s >= 0) {
            $time = $difference -> s . ' seconds ago';
        }
        return $time;
    }

    public function changeProfile(int $userID) {
        $db = Utils::$db;
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $date = new DateTime($_POST['dateOfBirth']);
        $description = $_POST['description'];
        $now = new DateTime();

        $difference = date_diff($date, $now) -> y;
        if (!$name || !$surname || !$date || $difference < 14 || $difference > 90 || $now <= $date) {
            return;
        }

        $sql = "UPDATE `profiles` SET `name`= :name, `surname`= :surname,`description`= :description,`date_birth`= :dateOfBirth
            WHERE `user_id` = :userID";
        $db -> execute(
            $sql,
            [
                'userID' => $userID,
                'name' => $name,
                'surname' => $surname,
                'description' => $description,
                'dateOfBirth' => $date -> format('Y-m-d')
            ]
        );
        $path = "../uploads/" . 'avatar_' . basename($userID) . '.png';
        $newFile = $_FILES['fileToUpload']["tmp_name"];
        if ($newFile && file_exists($path)) {
            unlink($path);
        }
        move_uploaded_file($newFile, $path);
    }

    public function isLiked(int $userID, int $postID) {
        $db = Utils::$db;
        $sql = "SELECT * FROM `likes` WHERE `user_id` = :userID AND `post_id` = :postID";

        return $db -> execute(
            $sql,
            [
                'userID' => $userID,
                'postID' => $postID
            ]
        );
    }

    public function getAllMessages(array $users) {
        $sql = "SELECT * FROM `messages` 
            JOIN `chats` 
            ON (messages.chat_id = chats.chat_id) 
            AND ((chats.user1_id = :user1ID AND chats.user2_id = :user2ID) 
            OR (chats.user1_id = :user2ID AND chats.user2_id = :user1ID))";
        return Utils::$db -> execute($sql, $users);
    }

    public function isAdmin(int $userID) {
        $sql = "SELECT `is_admin` FROM `users` WHERE `user_id` = :userID";
        $result = Utils::getInstance() -> getDB() -> execute(
            $sql,
            ['userID' => $userID]
        );
        return $result[0]['is_admin'] === 1 ? true : false;
    }
}

?>