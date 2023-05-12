<?php
// CREATE = POST REQUEST
// READ * = GET REQUEST
// UPDATE = PUT REQUEST
// DELETE = DELETE REQUEST

$data = [
    ['id' => '1', 'name' => 'Ondrej'], 
    ['id' => '2', 'name' => 'David'], 
    ['id' => '3', 'name' => 'Karolina']
];
function findItemByKey ($key, $value, $data) {
    foreach ($data as $element) {
        if ($element[$key] == $value) {
            return $element;
        }
    }
    return null;
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo json_encode(findItemByKey('id', $id, $data));
    exit();
}
echo json_encode($data);

?>