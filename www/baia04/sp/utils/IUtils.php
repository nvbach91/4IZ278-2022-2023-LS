<?php 
interface IUtils {
    public static function getInstance();
    public function saveUser(Form $form);
    public function validateLogin(array $form);
    public function newPost(int $userID);
    public function getUser(int $userID);
    public function getUserAvatar(int $userID);
    public function getPostImage(int $postID);
    public function getTime(string $dateTime);
    public function changeProfile(int $userID);
    public function isLiked(int $userID, int $postID);
    public function getAllMessages(array $users);
}
?>