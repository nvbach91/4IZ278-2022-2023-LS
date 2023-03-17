<?php
class User {
    public function __construct(
        public $email,
        public $phone,
        public $username,
        public $name,
        public $password,
        public $gender,
        public $avatar
    ){}

    public static function deserialize($userData) {
        if (trim($userData) == '') {
            return;
        }
        $fields = explode(';', $userData);
        if (count($fields) != 7) {
            return;
        }
        return new User(
            $fields[0],
            $fields[1],
            $fields[2],
            $fields[3],
            $fields[4],
            $fields[5],
            $fields[6],
        );
    }

    public function serialize() {
        return "$this->email;"
            . "$this->phone;"
            . "$this->username;"
            . "$this->name;"
            . "$this->password;"
            . "$this->gender;"
            . "$this->avatar" 
            . PHP_EOL;
    }
}
