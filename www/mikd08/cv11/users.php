<?php
    session_start();
    require "db.php";
    $query = "SELECT * FROM user;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll();


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $UpdateQuery = "UPDATE user SET privilege = ? WHERE user_id = ?;
        ";
        $UpdateStmt = $pdo->prepare($UpdateQuery);
        $UpdateStmt->bindValue(1, current($_POST), PDO::PARAM_INT);
        $UpdateStmt->bindValue(2, key($_POST), PDO::PARAM_INT);
        $UpdateStmt->execute();

        header("Location: users.php");
        exit;
    }
?>

<?php require "header.php"?>


    <table>
        <tr>
            <td>user_id</td>
            <td>email</td>
            <td>privilege</td>
        </tr>
        <?php foreach($data as $user):?>
            <tr>
                <td><?php echo $user["user_id"]?></td>
                <td><?php echo $user["email"]?></td>
                <td>
                    <form action="users.php" method="POST">
                        <select name="<?php echo $user["user_id"]?>">
                            <option value="1" <?php echo $user["privilege"] == 1 ?  "selected" : ""?>>1</option>
                            <option value="2" <?php echo $user["privilege"] == 2 ?  "selected" : ""?>>2</option>
                            <option value="3" <?php echo $user["privilege"] == 3 ?  "selected" : ""?>>3</option>
                        </select>

                        <button type="submit">Change</button>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

<?php require "footer.php"?>