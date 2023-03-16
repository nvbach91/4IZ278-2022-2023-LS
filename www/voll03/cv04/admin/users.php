<?php

include '../utils.php';

$pageTitle = "Card Tournament | Admin page";
$heading = "List of registered users";
$cssFile = "../css/output.css";

$users = DatabaseService::fetchUsers();
?>

<?php include '../head.php' ?>

<body>
    <main class="flex flex-col items-center p-6 box-border font-sans h-screen bg-gradient-to-br from-black via-[#00031b] to-[#090018]">
        <h1 class="text-3xl text-center font-heading text-white"><?php echo $heading ?></h1>
        <div class="flex flex-col content-center flex-wrap mt-12 px-4 py-2 text-white  bg-[#333333]/20">
            <table class="border-collapse">
                <tr class="text-left ">
                    <th class="p-2">Name</th>
                    <th class="p-2">E-mail</th>
                    <th class="p-2">Password</th>
                    <th class="p-2">Phone</th>
                    <th class="p-2">Gender</th>
                    <th class="p-2">Deck</th>
                    <th class="p-2">Card count</th>
                    <th class="p-2">Avatar</th>
                </tr>
                <?php foreach ($users as $user) :  ?>
                    <tr>
                        <?php
                        $fields = explode(';', $user);
                        if (count($fields) === 8) : ?>
                            <td class="px-2"> <?php echo $fields[0]; ?> </td>
                            <td class="px-2"> <?php echo $fields[1]; ?> </td>
                            <td class="px-2"> <?php echo $fields[2]; ?> </td>
                            <td class="px-2"> <?php echo $fields[3]; ?> </td>
                            <td class="px-2"> <?php echo $fields[4]; ?> </td>
                            <td class="px-2"> <?php echo $fields[5]; ?> </td>
                            <td class="px-2"> <?php echo $fields[6]; ?> </td>
                            <td class="px-2"> <?php echo $fields[7]; ?> </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>


            </table>

        </div>
    </main>
</body>

<?php include '../footer.php' ?>