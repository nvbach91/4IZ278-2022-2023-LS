<?php
$file = "./users.db";
$sep = ";";
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/head.php" ?>
<?php require "includes/utils.php" ?>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Phone Number</th>
                                <th>Gender</th>
                                <th>Avatar_url</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach( fetchUsers() as $line ):
                                if( !empty($line) ):
                                    $currentUser = explode( $sep, $line );
                            ?>
                                    <tr>
                                        <td><?php echo $currentUser[0]; ?></td>
                                        <td><?php echo $currentUser[1]; ?></td>
                                        <td><?php echo $currentUser[2]; ?></td>
                                        <td><?php echo $currentUser[3]; ?></td>
                                        <td><?php echo $currentUser[4]; ?></td>
                                        <td><?php echo $currentUser[5]; ?></td>
                                    </tr>
                            <?php
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>