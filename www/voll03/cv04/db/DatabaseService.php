<?php 

class DatabaseService
{
    public static function checkConnection(): bool
    {
        return file_exists(DB_FILE_PATH);
    }

    public static function fetchUser(string $email)
    {
        $users = explode(PHP_EOL, file_get_contents(DB_FILE_PATH));

        foreach ($users as $user) {
            $fields = explode(';', $user);

            if (count($fields) === 8) {
                $user = [
                    "name" => $fields[0],
                    "email" => $fields[1],
                    "password" => $fields[2],
                    "phone" => $fields[3],
                    "gender" => $fields[4],
                    "deck" => $fields[5],
                    "cardCount" => $fields[6],
                    "avatar" => $fields[7]
                ];
    
                if ($user['email'] === $email) {
                    return $user;
                }
            }
        }

        return null;
    }

    public static function fetchUsers() {
        return explode(PHP_EOL, file_get_contents(DB_FILE_PATH));
    }

    public static function registerNewUser(array $userData)
    {
        $userRecord = implode(';', $userData) . PHP_EOL;
        file_put_contents(DB_FILE_PATH, $userRecord, FILE_APPEND);
    }
}
