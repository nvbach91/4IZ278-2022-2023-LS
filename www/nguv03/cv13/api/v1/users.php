<?php
    require './UsersDB.php';
    $users = new UsersDB();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $data = $users->fetchAll();
        echo json_encode($data);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newUser = ['name' => $_POST['name'], 'age' => $_POST['age']];
        $user_id = $users->create($newUser);
        echo json_encode(['success' => true, 'user_id' => $user_id]);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        parse_str(file_get_contents("php://input"), $input);
        $user = ['name' => $input['name'], 'age' => $input['age']];
        $data = $users->update($input['user_id'], $user);
        echo json_encode(['success' => true]);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        parse_str(file_get_contents("php://input"), $input);
        $data = $users->delete($input['user_id']);
        echo json_encode(['success' => true]);
    }
