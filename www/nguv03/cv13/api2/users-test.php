<?php

// C = CREATE = vlozeni noveho zazamu  == POST metoda
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUser = [
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
    ];
    echo json_encode($newUser);
}

// R = READ = cteni zaznamu  == GET metoda
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    echo json_encode($_GET);
}

// U = UPDATE = aktualizace zaznamu == PUT metoda
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $input);
    // var_dump($input);
    $user = [
        'name' => $input['name'],
        'age' => $input['age'],
        'gender' => $input['gender'],
    ];
    echo json_encode($user);
}

// D = DELETE = mazani zaznamu == DELETE metoda
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $input);
    echo json_encode($input);
}
?>