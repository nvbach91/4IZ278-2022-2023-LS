<?php
    require './UsersDB.php';
    $users = new UsersDB();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $data = $users->fetchAll();
        echo json_encode($data);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newUser = ['name' => $_POST['name'], 'age' => $_POST['age']];
        $id = $users->create($newUser);
        echo json_encode(['success' => true, 'id' -> $id]);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        parse_str(file_get_contents("php://input"), $input);
        $user = ['name' => $input['name'], 'age' => $input['age']];
        $data = $users->update($input['id'], $user);
        echo json_encode(['success' => true]);
    }



    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        parse_str(file_get_contents("php://input"), $input);
        $data = $users->delete($input['id']);
        echo json_encode(['success' => true]);
    }
