<?php

require_once __DIR__ . '/../functions.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - users</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          crossorigin="anonymous">
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-6">
            <h1 class="text-center">Admin - users</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Full name</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach (fetchAllUsers() as $user) {
                        ?> <tr>
                            <td><?= $user[0] ?></td>
                            <td><?= $user[2] ?></td>
                        </tr> <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
