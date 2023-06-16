<?php require_once './Database.php'; ?>
<?php

class UserDatabase extends Database
{
    public function getUserByEmail($email)
    {
        $query = 'SELECT * FROM sp_users WHERE email = :email';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['email' => $email]);
        return $statement->fetch();
    }

    public function getUserById($id)
    {
        $query = 'SELECT * FROM sp_users WHERE user_id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['id' => $id]);
        return $statement->fetch();
    }

    public function getAllUsers()
    {
        $query = 'SELECT * FROM sp_users';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUserByFbId($fbId)
    {
        $query = 'SELECT * FROM sp_users WHERE fb_id = :fb_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['fb_id' => $fbId]);
        return $statement->fetch();
    }

    public function registerUserFromFb($fbId, $email, $fbName)
    {
        $existingUser = $this->getUserByFbId($fbId);
        if ($existingUser) {
            return $existingUser;
        }

        $query = 'INSERT INTO sp_users (fb_id, xname, email, role) VALUES (:fb_id, :xname, :email, :role)';

        $statement = $this->pdo->prepare($query);
        $statement->execute(['fb_id' => $fbId, 'xname' => $fbName, 'email' => $email, 'role' => 1]);

        return $this->getUserByFbId($fbId);
    }


    public function registerUser($email, $password)
    {
        $xname = substr($email, 0, strpos($email, '@'));
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 1;

        $query = 'INSERT INTO sp_users (xname, email, password, role) VALUES (:xname, :email, :password, :role)';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['xname' => $xname, 'email' => $email, 'password' => $hashed_password, 'role' => $role]);
    }

    public function updateUser($userId, $xname, $email, $password = null)
    {
        $query = 'UPDATE sp_users SET xname = :xname, email = :email' . ($password ? ', password = :password' : '') . ' WHERE user_id = :user_id';
        $parameters = [
            'xname' => $xname,
            'email' => $email,
            'user_id' => $userId
        ];
        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $parameters['password'] = $hashed_password;
        }
        $statement = $this->pdo->prepare($query);
        $statement->execute($parameters);
    }

    public function deleteUser($userId)
    {
        $query = 'DELETE FROM sp_messages WHERE sender_id = :user_id OR receiver_id = :user_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['user_id' => $userId]);

        $query = 'SELECT listing_id FROM sp_listings WHERE user_id = :user_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['user_id' => $userId]);
        $listings = $statement->fetchAll();

        foreach ($listings as $listing) {
            $query = 'DELETE FROM sp_images WHERE listing_id = :listing_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['listing_id' => $listing['listing_id']]);

            $query = 'DELETE FROM sp_listings WHERE listing_id = :listing_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['listing_id' => $listing['listing_id']]);

            $query = 'SELECT vehicle_id FROM sp_listings WHERE listing_id = :listing_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['listing_id' => $listing['listing_id']]);
            $vehicle = $statement->fetch();

            $query = 'DELETE FROM sp_vehicles WHERE vehicle_id = :vehicle_id';
            $statement = $this->pdo->prepare($query);
            $statement->execute(['vehicle_id' => $vehicle['vehicle_id']]);
        }

        $query = 'DELETE FROM sp_users WHERE user_id = :user_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['user_id' => $userId]);
    }
}
