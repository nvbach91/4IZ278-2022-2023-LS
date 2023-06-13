<?php
require 'authorization.php';
require '../models/OrdersDB.php';

$ordersDatabase = new OrdersDatabase();

$orders = $ordersDatabase->fetchAllByUserId($current_user['user_id']);
