<?php
session_start();
include_once("by_database.php");
include_once("by_detection.php");

if ($_SESSION["privilege"] == 0) {
  header("Location: main_news.php");
  exit();
}

if (!isset($_SESSION['user_id'])) {
    $query = "SELECT * FROM `_dmp_booking` WHERE `_dmp_users_ID` = :iduser";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':iduser', $_SESSION['iduser']);
    $stmt->execute();
    $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = "SELECT * FROM `_dmp_booking` WHERE `oauth` = :oauth";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':oauth', $_SESSION['email']);
    $stmt->execute();
    $lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if($lesson['week'] == 0){
    $week = "This week";
}
if($lesson['week'] == 1){
    $week = "The next week";
}

$todayLessons = [];
$tomorrowLessons = [];
$otherLessons = [];

// Categorize the lessons based on their day
$today = date('N'); // Current day of the week (1 = Monday, 7 = Sunday)
foreach ($lessons as $lesson) {
    if ($lesson['day'] == $today) {
        $todayLessons[] = $lesson;
    } elseif ($lesson['day'] == ($today % 7) + 1) {
        $tomorrowLessons[] = $lesson;
    } else {
        $otherLessons[] = $lesson;
    }
}

echo "<h2>Today's Lessons:</h2>";
if (count($todayLessons) > 0) {
    echo "<table>";
    echo "<tr><th>Day</th><th>Time</th><th>Week</th></tr>";
    foreach ($todayLessons as $lesson) {
        echo "<tr>";

        echo "<td>" . date('l', strtotime("Sunday +{$lesson['day']} days")) . "</td>";
                echo "<td>" . $lesson['time'] . "</td>";
        echo "<td>" . $week . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No lessons found for today.";
}

echo "<h2>Tomorrow's Lessons:</h2>";
if (count($tomorrowLessons) > 0) {
    echo "<table>";
    echo "<tr><th>Day</th><th>Time</th><th>Week</th></tr>";
    foreach ($tomorrowLessons as $lesson) {
        echo "<tr>";
        echo "<td>" . $lesson['day'] . "</td>";
        echo "<td>" . $lesson['time'] . "</td>";
        echo "<td>" . $week . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No lessons found for tomorrow.";
}

echo "<h2>Other Lessons:</h2>";
if (count($otherLessons) > 0) {
    echo "<table>";
    echo "<tr><th>Day</th><th>Time</th><th>Week</th></tr>";
    foreach ($otherLessons as $lesson) {
        echo "<tr>";
        echo "<td>" . date('l', strtotime("Sunday +{$lesson['day']} days")) . "</td>";
        echo "<td>" . $lesson['time'] . "</td>";
        echo "<td>" . $week . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No other lessons found.";
}


?>

<button class="" onclick="window.location.href='main_booking.php'">Back</button>