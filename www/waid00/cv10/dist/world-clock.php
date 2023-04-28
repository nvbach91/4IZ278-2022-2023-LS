<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>World Clock</title>
</head>
<body>
    <h1>World Clock</h1>
    <?php
    // set the default timezone to Europe/Prague
    date_default_timezone_set('Europe/Prague');

    // define the cities and timezones
    $cities = array(
        'New York' => 'America/New_York',
        'London' => 'Europe/London',
        'Sydney' => 'Australia/Sydney',
        'Tokyo' => 'Asia/Tokyo',
        'Dubai' => 'Asia/Dubai'
    );

    // loop through the cities and display the time
    foreach ($cities as $city => $timezone) {
        // set the timezone for this city
        date_default_timezone_set($timezone);

        // format the time using the local date and time formats
        $date = date('l, F j, Y');
        $time = date('h:i A');

        // get the time difference from Prague
        $prague_time = new DateTime("now", new DateTimeZone('Europe/Prague'));
        $city_time = new DateTime("now", new DateTimeZone($timezone));
        $diff = $prague_time->getOffset() - $city_time->getOffset();

        // calculate the sign of the time difference
        $sign = ($diff < 0 ? '-' : '+');

        // convert the time difference to hours and minutes
        $diff_hours = abs(floor($diff / 3600));
        $diff_minutes = abs(floor(($diff % 3600) / 60));

        // display the city name, date, time, and time difference from Prague
        echo "<h2>{$city}</h2>";
        echo "<p>Date: {$date}</p>";
        echo "<p>Time: {$time}</p>";
        echo "<p>Time difference from Prague: {$sign}{$diff_hours}h {$diff_minutes}m</p>";
    }
    ?>
    <a class="nav-link" href="index.php">index</a>
</body>
</html>
