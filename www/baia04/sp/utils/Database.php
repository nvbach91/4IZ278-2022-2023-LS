<?php 
require('../utils/IDatabase.php');
class Database implements IDatabase {
    private $pdo;
    public function __construct() {
        $this -> pdo = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE . ';charset=utf8mb4', DB_USERNAME, DB_PASSWORD
        );
        $this -> pdo -> setAttribute (
            PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
        );
        $this -> pdo -> setAttribute(
            PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
        );
    }

    public function execute(string $sql, array $args = null) {
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute($args);
        return $statement -> fetchAll();
    }

    public function getUserByEmail(string $email) {
        return $this -> getUserByField($email, 'email');
    }

    public function getUserByPhone(string $phoneNumber) {
        return $this -> getUserByField($phoneNumber, 'phoneNumber');
    }

    public function getUserByField(string $param, string $field) {
        $sql = "SELECT * FROM `users` WHERE `" . $field . "` = '" . $param . "'";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
        return $statement -> fetchAll();
    }

    public function fetchAllPosts() {
        $sql = "SELECT * FROM `posts` ORDER BY `post_id` DESC";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute();
        return $statement -> fetchAll();
    }

    public function fetchAllPostsFromUser(int $userID) {
        $sql = "SELECT * FROM `posts` WHERE `author_id` = :user_id ORDER BY `post_id` DESC";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'user_id' => $userID,
        ]);
        return $statement -> fetchAll();
    }

    public function getPostByID(int $postID) {
        $sql = "SELECT * FROM `posts` WHERE `post_id` = :postID";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            'postID' => $postID
        ]);
        return $statement -> fetchAll()[0];
    }

    public function getProfile(int $userID) {
        $sql = "SELECT * FROM `profiles` WHERE `user_id` = :userID";
        $statement = $this -> pdo -> prepare($sql);
        $statement -> execute([
            "userID" => $userID
        ]);
        return $statement -> fetchAll();
    }

    public function likeAmount(int $postID) {
        $statement = $this -> pdo -> prepare("SELECT count(`user_id`) AS 'count' FROM `likes` WHERE `post_id` = :postID");
        $statement -> execute([
            'postID' => $postID,
        ]);
        $result = $statement -> fetch();
        return $result['count'];
    }

    public function getComments(int $postID) {
        $statement = $this -> pdo -> prepare("SELECT * FROM `comments` WHERE `post_id` = :postID");
        $statement -> execute([
            'postID' => $postID,
        ]);
        return $statement -> fetchAll();
    }

    public function commentAmount(int $postID) {
        $statement = $this -> pdo -> prepare("SELECT count(`author_id`) AS 'count' FROM `comments` WHERE `post_id` = :postID");
        $statement -> execute([
            'postID' => $postID,
        ]);
        $result = $statement -> fetch();
        return $result['count'];
    }

}

?>