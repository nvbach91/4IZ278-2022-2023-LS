<?php
require('database.php');



$users->create(['name' => 'Osoba 1', 'age' => 12, 'avatar' => 'https://i1.sndcdn.com/avatars-000525223683-bljdao-t240x240.jpg']);
$users->create(['name' => 'Osoba 2', 'age' => 12, 'avatar' => 'https://pm1.narvii.com/7225/b84a28efca874aa78f571e910a8357f7d2f666f2r1-500-500v2_00.jpg']);
$users->create(['name' => 'Osoba 3', 'age' => 99, 'avatar' => 'https://www.nicepng.com/png/detail/373-3735458_attachments-earthbound-starman-jr.png']);

$products->create(['name' => 'Hamburger', 'price' => '$14']);
$products->create(['name' => 'Pizza', 'price' => '$48']);
$products->create(['name' => 'Cookie', 'price' => '$7']);
$orders->create(['date' => '27-07-1989']);
$orders->create(['date' => '27-08-1994']);
$orders->create(['date' => '20-04-2006']);




header('location: index.php');

exit();


?>