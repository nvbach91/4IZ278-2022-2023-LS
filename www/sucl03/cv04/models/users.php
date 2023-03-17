<?php
// file:cv04/models/users.php
require_once(__DIR__ . '/../libs/utils.php');

function fetchUsers()
{
	return (read_parse_csv(DB_FILE_USERS, DELIMITER));
};

function fetchUser($email)
{
	$user = array_values(array_filter(fetchUsers(), fn($arr) => $arr['email'] == $email));
	return (!empty($user[0]) ? $user[0] : null);
};

function registerNewUser($payload_arr)
{
	if (array_search($payload_arr['email'], array_column(fetchUsers(), 'email')) !== false)
		return (['ok' => false, 'msg' => 'E-mail already exists, use another or login']);
	if (!create_append_csv($payload_arr, DB_FILE_USERS, DELIMITER))
		return (['ok' => false, 'msg' => 'Cannot write to DB']);
	return (['ok' => true, 'msg' => 'Registration successful']);
}

function authenticate($email, $password)
{
	$user = fetchUser($email);
    if (empty($user))
		return (['ok' => false, 'msg' => 'E-mail does not exist']);
    if ($user['password'] != $password)
		return (['ok' => false, 'msg' => 'Wrong password']);
    return (['ok' => true, 'msg' => 'Login successful']);
};
?>