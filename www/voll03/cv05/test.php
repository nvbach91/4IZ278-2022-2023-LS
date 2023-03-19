<?php

function testUserDB(UsersDB $users)
{
    $users->create([
        "name" => "Jack O'Neill",
        "age" => 52
    ]);

    $users->create([
        "name" => "Ronon Dex",
        "age" => 32
    ]);

    assert($users->create(["name" => "Ronon Dex", "age" => 32]) === Database::ERROR_RECORD_ALREADY_EXISTS, "ERROR: record already exists and can't be saved twice!");

    $users->create([
        "name" => "Samantha Carter",
        "age" => 38
    ]);

    assert(count($users->getTableRows()) === 3, "ERROR: Inner array is not the same as the database file!");

    // fetch by id
    $fetchResult = $users->fetchByID(2);

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching by ID returns nothing!");
    assert($fetchResult['name'] === "Ronon Dex" && $fetchResult['age'] === 32, "ERROR: Fetching by ID does not work properly!");

    // fetch by name
    $fetchResult = $users->fetchByName("Jack O'Neill");

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching by NAME returns nothing!");
    assert($fetchResult['name'] === "Jack O'Neill" && $fetchResult['age'] === 52, "ERROR: Fetching by NAME does not work properly!");

    // fetch All
    $fetchResult = $users->fetchAll();

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching ALL RECORDS returns nothing!");
    assert(count($fetchResult) === 3, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[0]['id'] === 1 && $fetchResult[0]['name'] === "Jack O'Neill" && $fetchResult[0]['age'] === 52, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[1]['id'] === 2 && $fetchResult[1]['name'] === "Ronon Dex" && $fetchResult[1]['age'] === 32, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[2]['id'] === 3 && $fetchResult[2]['name'] === "Samantha Carter" && $fetchResult[2]['age'] === 38, "ERROR: Fetching ALL RECORDS does not work properly!");

    // update
    $update = $users->update(1, [
        "name" => "Meredith Rodney McKay",
        "age" => 38
    ]);

    $updatedResult = $users->fetchByID(1);

    assert($update === Database::RESULT_SUCCESS, "ERROR: Updating is not successful!");
    assert($updatedResult['name'] === "Meredith Rodney McKay" && $updatedResult['age'] === 38, "ERROR: Updating does not work properly!");

    // delete one
    $deletion = $users->delete(2);

    assert($deletion === Database::RESULT_SUCCESS, "ERROR: Deletion is not successful!");

    $resultAfterDeletion = $users->fetchAll();

    assert(count($resultAfterDeletion) === 2, "ERROR: Deleting ONE RECORD does not work properly!");
    assert($resultAfterDeletion[0]['id'] === 1 && $resultAfterDeletion[0]['name'] === "Meredith Rodney McKay" && $resultAfterDeletion[0]['age'] === 38, "Deleting ONE RECORD does not work properly!");
    assert($resultAfterDeletion[1]['id'] === 3 && $resultAfterDeletion[1]['name'] === "Samantha Carter" && $resultAfterDeletion[1]['age'] === 38, "Deleting ONE RECORD does not work properly!");


    // add new with id = 4
    assert($users->create(["name" => "Daniel Jackson", "age" => 42]) === Database::RESULT_SUCCESS, "ERROR: new record was not saved properly after deletion!");

    $newRecord = $users->fetchByID(4);

    assert($newRecord["id"] === 4 && $newRecord['name'] === "Daniel Jackson" && $newRecord['age'] === 42, "ERROR: new record saved after deletion has invalid data!");

    // delete all
    $deleteAll = $users->deleteAll();

    assert($deleteAll === Database::RESULT_SUCCESS, "ERROR: Deletion is not working properly!");
    assert(count($users->getTableRows()) === 0, "ERROR: Internal array is still not completely erased!");
    assert(empty(file_get_contents($users->getDbPath())), "ERROR: File content is still not completely erased!");
}

function testProductsDB(ProductsDB $products)
{
    $products->create([
        "name" => "Coca-cola",
        "price" => 100
    ]);

    $products->create([
        "name" => "Döner Kebab",
        "price" => 120
    ]);

    assert($products->create(["name" => "Döner Kebab", "price" => 120]) === Database::ERROR_RECORD_ALREADY_EXISTS, "ERROR: record already exists and can't be saved twice!");

    $products->create([
        "name" => "Staff weapon",
        "price" => 1500
    ]);

    assert(count($products->getTableRows()) === 3, "ERROR: Inner array is not the same as the database file!");

    // fetch by id
    $fetchResult = $products->fetchByID(2);

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching by ID returns nothing!");
    assert($fetchResult['name'] === "Döner Kebab" && $fetchResult['price'] === 120, "ERROR: Fetching by ID does not work properly!");

    // fetch by name
    $fetchResult = $products->fetchByName("Coca-cola");

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching by NAME returns nothing!");
    assert($fetchResult['name'] === "Coca-cola" && $fetchResult['price'] === 100, "ERROR: Fetching by NAME does not work properly!");

    // fetch All
    $fetchResult = $products->fetchAll();

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching ALL RECORDS returns nothing!");
    assert(count($fetchResult) === 3, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[0]['id'] === 1 && $fetchResult[0]['name'] === "Coca-cola" && $fetchResult[0]['price'] === 100, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[1]['id'] === 2 && $fetchResult[1]['name'] === "Döner Kebab" && $fetchResult[1]['price'] === 120, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[2]['id'] === 3 && $fetchResult[2]['name'] === "Staff weapon" && $fetchResult[2]['price'] === 1500, "ERROR: Fetching ALL RECORDS does not work properly!");

    // update
    $update = $products->update(1, [
        "name" => "Zat'nik'tel",
        "price" => 480
    ]);

    $updatedResult = $products->fetchByID(1);

    assert($update === Database::RESULT_SUCCESS, "ERROR: Updating is not successful!");
    assert($updatedResult['name'] === "Zat'nik'tel" && $updatedResult['price'] === 480, "ERROR: Updating does not work properly!");

    // delete one
    $deletion = $products->delete(2);

    assert($deletion === Database::RESULT_SUCCESS, "ERROR: Deletion is not successful!");

    $resultAfterDeletion = $products->fetchAll();

    assert(count($resultAfterDeletion) === 2, "ERROR: Deleting ONE RECORD does not work properly!");
    assert($resultAfterDeletion[0]['id'] === 1 && $resultAfterDeletion[0]['name'] === "Zat'nik'tel" && $resultAfterDeletion[0]['price'] === 480, "Deleting ONE RECORD does not work properly!");
    assert($resultAfterDeletion[1]['id'] === 3 && $resultAfterDeletion[1]['name'] === "Staff weapon" && $resultAfterDeletion[1]['price'] === 1500, "Deleting ONE RECORD does not work properly!");


    // add new with id = 4
    assert($products->create(["name" => "Wraith stunner", "price" => 960]) === Database::RESULT_SUCCESS, "ERROR: new record was not saved properly after deletion!");

    $newRecord = $products->fetchByID(4);

    assert($newRecord["id"] === 4 && $newRecord['name'] === "Wraith stunner" && $newRecord['price'] === 960, "ERROR: new record saved after deletion has invalid data!");

    // delete all
    $deleteAll = $products->deleteAll();

    assert($deleteAll === Database::RESULT_SUCCESS, "ERROR: Deletion is not working properly!");
    assert(count($products->getTableRows()) === 0, "ERROR: Internal array is still not completely erased!");
    assert(empty(file_get_contents($products->getDbPath())), "ERROR: File content is still not completely erased!");
}

function testOrdersDB(UsersDB $users, ProductsDB $products, OrdersDB $orders)
{
    $users->create([
        "name" => "Jack O'Neill",
        "age" => 52
    ]);

    $users->create([
        "name" => "Ronon Dex",
        "age" => 32
    ]);

    $products->create([
        "name" => "Coca-cola",
        "price" => 100
    ]);

    $products->create([
        "name" => "Döner Kebab",
        "price" => 120
    ]);


    $orders->create([
        "number" => 42,
        "date" => "2023-03-02",
        "user_id" => 1,
        "product_id" => 2
    ]);

    $orders->create([
        "number" => 43,
        "date" => "2023-03-02",
        "user_id" => 1,
        "product_id" => 1
    ]);

    assert($orders->create([
        "number" => 43,
        "date" => "2023-03-02",
        "user_id" => 1,
        "product_id" => 1
    ]) === Database::ERROR_RECORD_ALREADY_EXISTS, "ERROR: record already exists and can't be saved twice!");

    $orders->create([
        "number" => 48,
        "date" => "2023-04-04",
        "user_id" => 2,
        "product_id" => 2
    ]);

    assert(count($orders->getTableRows()) === 3, "ERROR: Inner array is not the same as the database file!");

    // fetch by id
    $fetchResult = $orders->fetchByID(2);

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching by ID returns nothing!");
    assert($fetchResult['id'] === 2 && $fetchResult['number'] === 43 && $fetchResult['date'] === "2023-03-02"
        && $fetchResult['user_id'] === 1 && $fetchResult['product_id'] === 1, "ERROR: Fetching by ID does not work properly!");

    // fetch by name
    $fetchResult = $orders->fetchByName(48);

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching by NAME returns nothing!");
    assert($fetchResult['id'] === 3 && $fetchResult['number'] === 48 && $fetchResult['date'] === "2023-04-04"
        && $fetchResult['user_id'] === 2 && $fetchResult['product_id'] === 2, "ERROR: Fetching by ID does not work properly!");

    // fetch All
    $fetchResult = $orders->fetchAll();

    assert($fetchResult !== Database::RESULT_NOTHING, "ERROR: Fetching ALL RECORDS returns nothing!");
    assert(count($fetchResult) === 3, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[0]['id'] === 1 && $fetchResult[0]['number'] === 42 && $fetchResult[0]['date'] === "2023-03-02"
        && $fetchResult[0]['user_id'] === 1  && $fetchResult[0]['product_id'] === 2, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[1]['id'] === 2 && $fetchResult[1]['number'] === 43 && $fetchResult[1]['date'] === "2023-03-02"
        && $fetchResult[1]['user_id'] === 1  && $fetchResult[1]['product_id'] === 1, "ERROR: Fetching ALL RECORDS does not work properly!");
    assert($fetchResult[2]['id'] === 3 && $fetchResult[2]['number'] === 48 && $fetchResult[2]['date'] === "2023-04-04"
        && $fetchResult[2]['user_id'] === 2  && $fetchResult[2]['product_id'] === 2, "ERROR: Fetching ALL RECORDS does not work properly!");

    // update
    $update = $orders->update(1, [
        "number" => 125,
        "date" => "2023-10-03",
        "user_id" => 2,
        "product_id" => 1
    ]);

    $updatedResult = $orders->fetchByID(1);

    assert($update === Database::RESULT_SUCCESS, "ERROR: Updating is not successful!");
    assert($updatedResult['id'] === 1 && $updatedResult['number'] === 125 && $updatedResult['date'] === "2023-10-03"
        && $updatedResult['user_id'] === 2 && $updatedResult['product_id'] === 1, "ERROR: Updating does not work properly!");

    // delete one
    $deletion = $orders->delete(2);

    assert($deletion === Database::RESULT_SUCCESS, "ERROR: Deletion is not successful!");

    $resultAfterDeletion = $orders->fetchAll();

    assert(count($resultAfterDeletion) === 2, "ERROR: Deleting ONE RECORD does not work properly!");
    assert($resultAfterDeletion[0]['id'] === 1 &&  $resultAfterDeletion[0]['number'] === 125 && $resultAfterDeletion[0]['date'] === "2023-10-03"
        && $resultAfterDeletion[0]['user_id'] === 2 && $resultAfterDeletion[0]['product_id'] === 1, "Deleting ONE RECORD does not work properly!");
    assert($resultAfterDeletion[1]['id'] === 3 && $resultAfterDeletion[1]['number'] === 48 && $resultAfterDeletion[1]['date'] === "2023-04-04"
        && $resultAfterDeletion[1]['user_id'] === 2 && $resultAfterDeletion[1]['product_id'] === 2, "Deleting ONE RECORD does not work properly!");


    // add new with id = 4
    assert($orders->create([
        "number" => 73,
        "date" => "2023-01-19",
        "user_id" => 1,
        "product_id" => 1
    ]) === Database::RESULT_SUCCESS, "ERROR: new record was not saved properly after deletion!");

    $newRecord = $orders->fetchByID(4);

    assert($newRecord["id"] === 4 && $newRecord['number'] === 73 && $newRecord['date'] === "2023-01-19"
        && $newRecord["user_id"] === 1 && $newRecord["product_id"] === 1, "ERROR: new record saved after deletion has invalid data!");

    // delete all
    $deleteAll = $orders->deleteAll();

    assert($deleteAll === Database::RESULT_SUCCESS, "ERROR: Deletion is not working properly!");
    assert(count($orders->getTableRows()) === 0, "ERROR: Internal array is still not completely erased!");
    assert(empty(file_get_contents($orders->getDbPath())), "ERROR: File content is still not completely erased!");
}

$users = new UsersDB();
$products = new ProductsDB();
$orders = new OrdersDB();

echo "<br>";

// check config
$users->configInfo();
$products->configInfo();
$orders->configInfo();

// check connection
assert($users->checkConnection(), "ERROR: connection is not working for UsersDB!");
assert($products->checkConnection(), "ERROR: connection is not working for ProductsDB!");
assert($orders->checkConnection(), "ERROR: connection is not working for OrdersDB!");

// reset previously loaded data (to start with a clean test)
$users->deleteAll();
$products->deleteAll();
$orders->deleteAll();

testUserDB($users);
testProductsDB($products);
testOrdersDB($users, $products, $orders);
