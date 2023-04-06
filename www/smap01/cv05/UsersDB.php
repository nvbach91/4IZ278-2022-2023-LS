<?php
class UsersDB extends Database
{
    public function create($args)
    {
        echo "<br>User " . $args['name'] . " with email " . $args['email'] . " was created.</br>" . PHP_EOL;
        $this->save($args);
    }
    public function fetch()
    {
        $users = [];
        $userDatabase = file_get_contents($this->getFilePath());
        $userDatabase = explode(PHP_EOL, $userDatabase);
        foreach ($userDatabase as $user) {
            if (strlen($user) > 0) {
                $user = explode($this->separator, $user);
                array_push($users, $user);
            }
        }
        return $users;
    }
    public function save($args)
    {
        file_put_contents($this->getFilePath(), $args['name'] . $this->separator . $args['email'] . PHP_EOL, FILE_APPEND);
        echo "<br>User was saved!</br>" . PHP_EOL;
    }
    public function delete()
    {
        echo "Sorry users cannot be deleted at the moment";
    }
}
