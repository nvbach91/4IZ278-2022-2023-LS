<?php 
session_start();
include_once('database.php');
if(!isset($_SESSION['login']) && $_SESSION['privilege'] <= 1){
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Users Table</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border: 1px solid #ddd;
		}
		th {
			background-color: #f2f2f2;
			color: #333;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<h1>Users Table</h1>
	<table>
		<thead>
			<tr>
				<th>User ID</th>
				<th>Registration Date</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Address</th>
				<th>Privilege</th>
			</tr>
		</thead>
		<tbody>
    <?php
        try {
            // Query to get data from users table
            $query = "SELECT * FROM users";

            // Execute the query and fetch the data
            $stmt = $pdo->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Loop through the data and display it in the table
             foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['registration_date']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>
                        <form method='post'>
                            <input type='hidden' name='user_id' value='<?php echo $row['user_id']; ?>'>
                            <input type='hidden' name='old_privilege' value='<?php echo $row['privilege']; ?>'>
                            <select name='new_privilege' >
                                <option value='1'<?php echo $row['privilege'] == 0 ? " selected" : ""; ?>>User</option>
                                <option value='2'<?php echo $row['privilege'] == 1 ? " selected" : ""; ?>>Manager</option>
                                <option value='3'<?php echo $row['privilege'] == 2 ? " selected" : ""; ?>>Admin</option>
                            </select>
                            <a href="privilege.php?id=<?php echo $row['user_id']; ?>&newprivilege=0">User</a>
                            <a href="privilege.php?id=<?php echo $row['user_id']; ?>&newprivilege=1">Manager</a>
                            <a href="privilege.php?id=<?php echo $row['user_id']; ?>&newprivilege=2">Admin</a>
                        </form>
                    </td>
                </tr>
                <?php endforeach;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
</tbody>
	</table>
    <a class="nav-link" href="index.php">index</a>
</body>
</html>
