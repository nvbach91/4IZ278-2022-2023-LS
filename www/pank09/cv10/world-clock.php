<?php
    $cities = [
        [
            'name' => 'Tokyo',
            'datetime' => new DateTime('now', new DateTimeZone('Asia/Tokyo')),
            'format' => 'Y年m月d日 H:i'
        ],
        [
            'name' => 'Hong Kong',
            'datetime' => new DateTime('now', new DateTimeZone('Asia/Hong_Kong')),
            'format' => 'Y-m-d H:i'
        ],
        [
            'name' => 'Prague',
            'datetime' => new DateTime('now', new DateTimeZone('Europe/Prague')),
            'format' => 'd.m.Y H:i'
        ],
        [
            'name' => 'London',
            'datetime' => new DateTime('now', new DateTimeZone('Europe/London')),
            'format' => 'd/m/Y H:i'
        ],
        [
            'name' => 'New York',
            'datetime' => new DateTime('now', new DateTimeZone('America/New_York')),
            'format' => 'm/d/y H:i'
        ]
    ];
?>

<?php include "./components/base/head.php"; ?>

<main class="container">
    <ul>
        <?php foreach($cities as $city): ?>
        <li>
            <b><?php echo $city['name']; ?></b><br>
            <?php
                echo $city['datetime']->format($city['format']);
            ?>
        </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php include "./components/base/foot.php"; ?>