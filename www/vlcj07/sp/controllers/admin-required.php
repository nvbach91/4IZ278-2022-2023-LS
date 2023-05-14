<?php
if ($current_user['role'] !== 'admin') {
    header("Location: ../views/access-forbidden.php");
    exit();
}
?>