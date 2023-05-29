<?php 
const SERVERNAME = "localhost";
const USERNAME = "root";
const PWD = "";
const PDO = new PDO("mysql:host=".SERVERNAME.";dbname=mikd08", USERNAME, PWD);

function sql($query, $params, $error = null) {
    $stmt = PDO->prepare($query);
    $data = array_keys($params);
    for ($i=1; $i <= count($params); $i++) { 
        $stmt->bindValue($i,$data[$i-1],$params[$data[$i-1]]);
    }
    try {
        $stmt->execute();
    } catch (\Throwable $th) {
        return $error ?? $th;
    }
}

function customFetch($query, $params, $fetchAll = true){
    $stmt = PDO->prepare($query);
    $data = array_keys($params);
    for ($i=1; $i <= count($params); $i++) { 
        $stmt->bindValue($i,$data[$i-1],$params[$data[$i-1]]);
    }
    $stmt->execute();
    return $fetchAll ? $stmt->fetchAll() : $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
