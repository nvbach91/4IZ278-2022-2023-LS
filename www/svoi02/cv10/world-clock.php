<?php
session_start();

// date_default_timezone_set('America/New_York');
$ny = new DateTime("now", new DateTimeZone('America/New_York'));
$prague = new DateTime("now", new DateTimeZone('Europe/Prague'));
$local = $prague->getOffset() / 3600;
$london = new DateTime("now", new DateTimeZone('Europe/London'));
$tokyo = new DateTime("now", new DateTimeZone('Asia/Tokyo'));
$hanoi = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World clocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/clocks.css" rel="stylesheet" />
</head>
<body>
    <?php require './CategoryDisplay.php'; ?>
    <div class="my-table">
        <h2>World clocks</h2>
        <table>
            <tr>
                <th>City</th>
                <th>Time</th>
                <th>Date</th>
                <th>Difference from Prague</th>
            </tr>
            <tr>
                <td>New York</td>
                <td><?php echo $ny->format('h:i A'); ?></td>
                <td><?php echo $ny->format('l, F j, Y'); ?></td>
                <td><?php echo $ny->getOffset() / 3600 - $local; ?></td>
            </tr>
            <tr>
                <td>Prague</td>
                <td><?php echo $prague->format('H:i');; ?></td>
                <td><?php echo $prague->format('l, j. F Y');; ?></td>
                <td>0</td>
            </tr>
            <tr>
                <td>London</td>
                <td><?php echo $london->format('h:i A');; ?></td>
                <td><?php echo $london->format('l, jS F Y');; ?></td>
                <td><?php echo $london->getOffset() / 3600 - $local; ?></td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td><?php echo $tokyo->format('H:i');; ?></td>
                <td><?php echo $tokyo->format('Y年m月d日 (D)');; ?></td>
                <td><?php echo $tokyo->getOffset() / 3600 - $local; ?></td>
            </tr>
            <tr>
                <td>Hanoi</td>
                <td><?php echo $hanoi->format('h:i A');; ?></td>
                <td><?php echo $hanoi->format('l, jS F Y');; ?></td>
                <td><?php echo $hanoi->getOffset() / 3600 - $local; ?></td>
            </tr>
        </table>
    </div>
</body>
</html>