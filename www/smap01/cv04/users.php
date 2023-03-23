<?php
include("./includes/header.php");
require("utils.php");
$users=fetchUsers();
?>

<table>
<tbody>
<tr>
	<th>Email</th>
	<th>Name</th>
</tr>

<?php
foreach($users as $user){
echo "<tr><td>".$user['email']."</td><td>".$user['name']."</td></tr>";
}


?>
</tbody>
</table>