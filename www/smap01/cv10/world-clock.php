<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php
function getTime($tz)
{
    $tz_obj = new DateTimeZone($tz);
    $today = new DateTime("now", $tz_obj);
    return $today;
}

?>
<main>
    <style>
        table>tbody>tr>td {
            border: 1px;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            border-left-style: none;
            border-style: solid;
        }
    </style>
    <table>
        <tbody>
            <tr>
                <td>City</td>
                <td>Date</td>
                <td>Time</td>
                <td>Difference from Prague</td>
            </tr>
            <tr>
                <td>Prague</td>
                <td><?php echo getTime('Europe/Prague')->format('d-m-Y') ?></td>
                <td><?php echo getTime('Europe/Prague')->format('h:i:s') ?></td>
                <td style="text-align:right;"><?php echo getTime('Europe/Prague')->diff(getTime('Europe/Prague'))->format("%h hours") ?></td>
            </tr>
            <tr>
                <td>New York</td>
                <td><?php echo getTime('EDT')->format('m-d-Y') ?></td>
                <td><?php echo getTime('EDT')->format('h:i:s') ?></td>
                <td style="text-align:right;"><?php echo getTime('America/New_York')->diff(getTime('Europe/Prague'))->format("%h hours") ?></td>
            </tr>
            <tr>
                <td>London</td>
                <td><?php echo getTime('Europe/London')->format('d-m-Y') ?></td>
                <td><?php echo getTime('Europe/London')->format('H:i:s') ?></td>
                <td style="text-align:right;"><?php echo getTime('Europe/London')->diff(getTime('Europe/Prague'))->format("%h hours") ?></td>
            </tr>
            <tr>
                <td>Sofia</td>
                <td><?php echo getTime('Europe/Sofia')->format('d-m-Y') ?></td>
                <td><?php echo getTime('Europe/Sofia')->format('H:i:s') ?></td>
                <td style="text-align:right;"><?php echo getTime('Europe/Sofia')->diff(getTime('Europe/Prague'))->format("%h hours") ?></td>
            </tr>
            <tr>
                <td>Tokyo</td>
                <td><?php echo getTime('Asia/Tokyo')->format('Y-m-d') ?></td>
                <td><?php echo getTime('Asia/Tokyo')->format('H:i:s') ?></td>
                <td style="text-align:right;"><?php echo getTime('Asia/Tokyo')->diff(getTime('Europe/Prague'))->format("%h hours") ?></td>
            </tr>
        </tbody>
    </table>
</main>
<?php require_once __DIR__ . '/incl/footer.php'; ?>