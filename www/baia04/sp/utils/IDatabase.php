<?php 
interface IDatabase {
    public function execute(string $sql, array $args);
    public function getUserByEmail(string $email);
    public function getUserByPhone(string $phone);
    public function getUserByField(string $param, string $field);
    public function fetchAllPosts();
    public function fetchAllPostsFromUser(int $user);
    public function getPostByID(int $id);
    public function getProfile(int $user_id);
    public function likeAmount(int $postID);
    public function getComments(int $postID);
    public function commentAmount(int $postID);
}
?>