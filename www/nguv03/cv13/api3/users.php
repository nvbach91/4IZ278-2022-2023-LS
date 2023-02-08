<?php

class UserDB {
    function fetchAll() {}
    function fetchById($id) {}
    function create($data) {}
    function deleteById($id) {}
    function updateById($id, $data) {}
}
$users = new UserDB();
/*
id  name    age     password    email
1   dave    10      abc         dave@vse.cz
2   jane    20      def         jane@vse.cz
3   bob     30      ghi         bob@vse.cz
4   jack    40      qwiej       jack@vse.cz
5   max     50      qweqwasd    max@vse.cz
*/

// CRUD = CREATE READ UPDATE DELETE


// CREATE = vytvoreni noveho zaznamu v tabulce
// === HTTP method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name'      => $_POST['name'],
        'age'       => $_POST['age'],
        'password'  => $_POST['password'],
        'email'     => $_POST['email'],
    ];
    // echo json_encode($data);
    // if ($errors) {
    //     return false;
    // }
    $id = $users->create($data);
    echo json_encode([
        'success' => true,
        'id' => $id,
    ]);
}

// READ = cteni/hledani existujiciho zaznamu
// === HTTP method GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    // echo json_encode(['id' => $id]);
    if (!$id) {
        $response = $users->fetchAll();
        echo json_encode($response);
    } else {
        $response = $users->fetchById($id);
        echo json_encode($response);
    }
}

// UPDATE = aktualizace existujiciho zaznamu
// === HTTP method PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $put_data);
    // echo json_encode($put_data);
    $data = [
        'name' => $put_data['name'],
        'email' => $put_data['name'],
        'password' => $put_data['name'],
        'age' => $put_data['age'],
    ];
    $id = $put_data['id'];
    $success = $users->updateById($id, $data);
    echo json_encode([
        'success' => $success,
    ]);
}

// DELETE = smazani existujicho zaznamu z tabulky podle id
// === HTTP method DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $delete_data);
    $id = $delete_data['id'];
    // echo $id;
    $success -> $users->deleteById($id);
    echo json_encode([
        'success' => $success,
    ]);
}
?>