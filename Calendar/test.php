<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
<?php
setlocale(LC_ALL, 'es');

$month = $_GET['month'] ?? date('m');
$year = $_GET['year'] ?? date('Y');

if ($month < 1) {
    $month = 12;
    $year--;
} elseif ($month > 12) {
    $month = 1;
    $year++;
}

$daysOfWeek = array('Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do');
$firstDayOfMonth = mktime(0,0,0,$month,1,$year);
$numberDays = date('t',$firstDayOfMonth);
$dateComponents = getdate($firstDayOfMonth);
$monthName = ucfirst(strftime('%B',$firstDayOfMonth));
$dayOfWeek = $dateComponents['wday'];
$currentDay = date('j');
$currentYear = date('Y');

echo "<div class='calendar is-full'>";
echo "<div class='month has-background-primary is-flex is-justify-content-space-around'>
<div class='buttons'>
<a class='button is-success is-rounded' href='?month=" . ($month-1) . "&year=" . $year . "'><--</a>
<a class='button is-success is-rounded' href='?month=" . date('m') . "&year=" . date('Y') . "'>$monthName - $year</a>
<a class='button is-success is-rounded' href='?month=" . ($month+1) . "&year=" . $year . "'>--></a>
</div>
</div>";
foreach($daysOfWeek as $day) {
    echo "<div class='day has-background-primary'>$day</div>";
}
$currentDayOfWeek = ($dayOfWeek + 6) % 7;

$prevMonthDays = date('t', mktime(0,0,0,$month-1,1,$year));
for($i=$prevMonthDays-$currentDayOfWeek+1; $i<=$prevMonthDays; $i++){
    echo "<div class='othermonth'>$i</div>";
}

$currentDay = 1;
$currentMonth = date('m');
while ($currentDay <= $numberDays) {
    if ($currentDayOfWeek == 6) {
        echo "<div class='holiday'>$currentDay</div>";
    } elseif ($currentMonth == $month && $currentDay == date('j') && $year == date('Y')){
        echo "<div class='today is-rounded'>$currentDay</div>";
    } else {
        echo "<div class='daynum'>$currentDay</div>";
    }
    $currentDay++;
    $currentDayOfWeek++;
    if ($currentDayOfWeek > 6) {
        $currentDayOfWeek = 0;
    }
}

$nextMonthDay = 1;
while ($currentDayOfWeek <= 6) {
    echo "<div class='othermonth'>$nextMonthDay</div>";
    $nextMonthDay++;
    $currentDayOfWeek++;
}

echo "</div>";

?>
</br>
</body>
</html>