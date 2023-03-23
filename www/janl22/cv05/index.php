<?php

require_once __DIR__ . '/class/OrdersDB.php';
require_once __DIR__ . '/class/ProductsDB.php';
require_once __DIR__ . '/class/UsersDB.php';

function toHTML($string):void {

    echo str_replace(PHP_EOL, '<br>', $string);

}

use classes\OrdersDB;
use classes\ProductsDB;
use classes\UsersDB;

$ordersDB = new OrdersDB();
$productsDB = new ProductsDB();
$userDB = new UsersDB();

?>
<?php $htmlTitle = 'Database operations';
require_once 'template/htmlHeader.php'; ?>
	<main>

		<?php
            toHTML($userDB->getConfig());
		    toHTML($userDB->create(['id' => 1, 'name' => 'Luboš', 'surname' => 'Jánský']));
		    toHTML($userDB->create(['id' => 2, 'name' => 'Martin', 'surname' => 'Novák']));
		    toHTML($userDB->create(['id' => 3, 'name' => 'Petr', 'surname' => 'Pavel']));
	    	toHTML($userDB->fetch(1));
            toHTML($userDB->fetch(2));
            toHTML($userDB->fetch(3));
		    toHTML($userDB->save(1, ['name' => 'Josef', 'surname' => 'Novotný']));
		    toHTML($userDB->fetch(1));
            toHTML($userDB->fetch(2));
            toHTML($userDB->fetch(3));
		    toHTML($userDB->delete(1));
            toHTML($userDB->delete(2));
            toHTML($userDB->delete(3));
            toHTML($userDB->fetch(1));
            toHTML($userDB->fetch(2));
            toHTML($userDB->fetch(3));
        ?>

        <br>

		<?php
		toHTML($ordersDB->getConfig());
		toHTML($ordersDB->create(['id' => 1, 'table' => '01-112', 'spend' => 1000]));
		toHTML($ordersDB->fetch(1));
		toHTML($ordersDB->save(1, ['table' => '01-112', 'surname' => 2000]));
		toHTML($ordersDB->fetch(1));
		toHTML($ordersDB->delete(1));
		?>

        <br>

		<?php
		toHTML($productsDB->getConfig());
		toHTML($productsDB->create(['id' => 1, 'name' => 'Kofola', 'volume' => 0,5]));
		toHTML($productsDB->fetch(1));
		toHTML($productsDB->save(1, ['name' => 'Coca-Cola', 'surname' => '1,5']));
		toHTML($productsDB->fetch(1));
		toHTML($productsDB->delete(1));
		?>

	</main>
<?php require_once 'template/htmlFooter.php'; ?>