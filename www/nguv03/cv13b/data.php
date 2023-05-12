<?php
// CREATE = HTTP POST
// READ * = HTTP GET
// UPDATE = HTTP PUT/PATCH
// DELETE = HTTP DELETE


$data = [
    ['id' => '1', 'name' => 'Lamborghini'],
    ['id' => '2', 'name' => 'Mercedes'],
    ['id' => '3', 'name' => 'Porsche'],
    ['id' => '4', 'name' => 'Toyota'],
    ['id' => '5', 'name' => 'Lexus'],
];

function findItemByKey($key, $value, $data) {
    foreach ($data as $item) {
        if ($item[$key] == $value) {
            return $item;
        }
    }
    return null;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = findItemByKey('id', $id, $data);
    if ($result == null) {
        header("HTTP/1.0 404 Not Found");
        exit;
    }
    echo json_encode($result);
    exit;
}

echo json_encode($data);
?>