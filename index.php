<?php

$calandrier = [];
for ($i = 0; $i <= 41; $i++) {
    $calandrier[$i] = '';
}

$currentYear = Date('Y');
$currentMonth = Date('n');

$choosedYear = $_GET['year'] ?? $currentYear;
$choosedMonth = $_GET['month'] ?? $currentMonth;

$choosedDate = new DateTime("$choosedYear-$choosedMonth-1");
// could future add $choosedDay || it would be related to JS effects -> affection to object

$choosedMonthLiteral = $choosedDate->format('F');
$choosedMonthTotalDays = $choosedDate->format('t'); // 28-31
$choosedMonthFirstWeekDay = $choosedDate->format('N'); // 1 for monday, 7 for sunday

//an for to fill the actual month days i.e. $calandrier[]
$dayCounter = $choosedMonthFirstWeekDay - 1;
for ($i = 1; $i <= $choosedMonthTotalDays; $i++) {
    $calandrier[$dayCounter] = $i;
    $dayCounter++;
}
// details v2.0
//-- a for to fill the days before  // using NewDate negative
//-- a for to fill the days after
//-- on click => go to the month of cliked day    choosedMonth -1/+1
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&display=swap" rel="stylesheet">
    <title>Calendar</title>
</head>

<body>
    <h1>Calendar: choose a date</h1>
    <form action="./" method="get">
        <label for="month">Month :</label>
        <select name="month" id="month">
            <option value="1">Janvier</option>
            <option value="2">Fevrier</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Julliet</option>
            <option value="8">Aout</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Decembre</option>
        </select>
        <label for="year">Year :</label>
        <input type="number" name="year" id="year" min="1000" max="3000" required>
        <input type="submit" value="Search!">
    </form>
    <div>
        <form action="get"><input type="number" value="12" name="ok"></form>
    </div>
    <!-- CALENDAR TABLE  -->
    <table>
        <caption><?= $choosedMonthLiteral . ' - ' . $choosedYear ?></caption>
        <thead>
            <tr class='week'>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th class="saturday">Samedi</th>
                <th class="sunday">Dimanche</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $index = 0;
            while ($i <= 41) {
                if ($i % 7 == 0) echo '<tr>';
                $i++;
                while ($i % 7 != 0) {
                    echo '<td>' . $calandrier[$index] . '</td>';
                    $index++;
                    $i++;
                };
                echo '<td>' . $calandrier[$index] . '</td>';
                $index++;
                echo '</tr>';
            };
            ?>
        </tbody>
    </table>
</body>

</html>