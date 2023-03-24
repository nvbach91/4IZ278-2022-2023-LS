<?php
// file:cv05/index.php

require_once(__DIR__ . '/libs/init.php');

require_once(__DIR__ . '/libs/html-header.php');
?>
	<main class="container">
		<h1 class="text-center">LXSX OOP</h1>
		<div class="row">
			<div class='col-md6 offset-md-3 col-sm-12 offset-sm-0'>
				<h5>Users</h5>
				<pre><?php
						$users = new UsersDB();
						$users->configInfo();
						$users->create(['name' => 'John Doe', 'age' => 22]);
						$users->create(['name' => 'Keyser Söze', 'age' => 45]);
						$users->fetch('Keyser Söze');
						$users->create(['name' => 'Keyser Söze', 'age' => 45]);
						$users->save(['name' => 'John Doe', 'age' => 28]);
						$users->fetch('John Doe');
						$users->delete('Keyser Söze');
						$users->fetch('Keyser Söze');
						$users->delete('John Doe');
						print PHP_EOL;
				?></pre>
			</div>
		</div>
		<div class="row">
			<div class='col-md6 offset-md-3 col-sm-12 offset-sm-0'>
				<h5>Products</h5>
				<pre><?php
						$products = new ProductsDB();
						$products->create(['name' => 'Lightsaber', 'price' => 100]);
						$products->fetch('Lightsaber');
						$products->create(['name' => 'Falcon', 'price' => 99000]);
						$products->fetch('Falcon');
						$products->save(['name' => 'Lightsaber', 'price' => 100.999]);
						$products->fetch('Lightsaber');
						$products->delete('Lightsaber');
						$products->fetch('Lightsaber');
						$products->delete('Falcon');
						echo $products, PHP_EOL;
						print PHP_EOL;
				?></pre>
			</div>
		</div>
		<div class="row">
			<div class='col-md6 offset-md-3 col-sm-12 offset-sm-0'>
				<h5>Orders</h5>
				<pre><?php
						$orders = new OrdersDB();
						echo $orders, PHP_EOL;
						$orders->create(['number' => 42, 'date' => '2023-03-26']);
						$orders->fetch(42);
						$orders->create(['number' => 21, 'date' => '02/27/2023']);
						$orders->fetch(21);
						$orders->save(['number' => 42, 'date' => '28.03.2023']);
						$orders->fetch(42);
						$orders->delete(42);
						$orders->fetch(42);
						$orders->delete(21);
						print PHP_EOL;
				?></pre>
			</div>
		</div>
	</main>
<?php
require(__DIR__ . '/libs/html-footer.php');
?>