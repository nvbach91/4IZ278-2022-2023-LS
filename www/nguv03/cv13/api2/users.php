<?php

$users = new UsersDB();

// C = CREATE = vlozeni noveho zazamu  == POST metoda
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUser = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
    ];
    $id = $users->create($newUser);
    if ($id) {
        echo json_encode([
            'success' => true,
            'id' => $id,
        ]);
    } else {
        
        echo json_encode([
            'success' => false,
            'msg' => 'something went wrong',
        ]);
    }
}

// R = READ = cteni zaznamu  == GET metoda
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    if (!$id) {
        $response = $users->fetchAll();
    } else {
        $response = $users->fetchById($id);
    }
    echo json_encode($response);
}

// U = UPDATE = aktualizace zaznamu == PUT metoda
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    $user = [
        'name' => $input['name'],
        'age' => $input['age'],
        'gender' => $input['gender'],
    ];
    $user_id = $input['user_id'];
    $success = $users->update($user_id, $user);
    echo json_encode([
        'success' => $success,
    ]);
}

// D = DELETE = mazani zaznamu == DELETE metoda
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $input);
    $user_id = $input['user_id'];
    $success = $users->delete($user_id);
    echo json_encode([
        'success' => $success,
    ]);
}
?>