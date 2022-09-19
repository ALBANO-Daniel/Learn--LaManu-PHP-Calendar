<?php

$calandrier = [];
for ($i = 0; $i <= 41; $i++) {
    $calandrier[$i] = '';
}

$currentYear = Date('Y');
$currentMonth = Date('n');

$choosedLanguage = false;
# first index value need to be null for use with native PHP function Date, and objet DateTime
$fr = [null, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$en = [null, 'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Julliet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

$monthsList = !$choosedLanguage ? $en : $fr;

$choosedYear = $_GET['year'] ?? $currentYear;
$choosedMonth = $_GET['month'] ?? $currentMonth;

$choosedDate = new DateTime("$choosedYear-$choosedMonth-1");
// v2.0 --> could future add $choosedDay || it would be related to JS effects -> affection to object

$choosedMonthLiteral = $choosedDate->format('F');
$choosedMonthTotalDays = $choosedDate->format('t'); // 28-31
$choosedMonthFirstWeekDay = $choosedDate->format('N'); // 1 for monday, 7 for sunday

$fillUpCalendar = $choosedMonthFirstWeekDay - 1;
for ($i = 1; $i <= $choosedMonthTotalDays; $i++) {
    $calandrier[$fillUpCalendar] = $i;
    $fillUpCalendar++;
}
//--> v2.0
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
        <select name="month" id="month" tabindex="1">
            <?php
            foreach ($monthsList as $key => $value) {
                if ($key != $choosedMonth) {
                    echo "<option value='$key'>$value</option>";
                } else {
                    echo "<option selected value='$key'>$value</option>";
                }
            } ?>
        </select>
        <label for="year">Year :</label>
        <select name="year" id="year" tabindex="2">
            <?php
            // selected as var
            for ($i = $currentYear - 120; $i < $currentYear + 80; $i++) {
                // also for day, this way you can change background color for current day

                // o$selected = '';
                // if($i == $currentYear){$selected = 'selected';}
                // echo "<optin $selected><?= $i ></option>";

                // VS 

                if ($i != $currentYear) { ?>
                    <option><?= $i ?></option> <!-- no need for value prop as value can be option content -->
                <?php } else { ?>
                    <option selected><?= $currentYear ?></option>
            <?php }
            } ?>
        </select>
        <input tabindex="3" type="submit" value="Search!">
    </form>
    <table class="calendarTable">
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
            $filler = 0;
            $index = 0;
            $tabindexAssign = '4';
            while ($filler <= 41) {
                if ($filler % 7 == 0) echo '<tr>';
                $filler++;
                while ($filler % 7 != 0) {
                    echo "<td tabindex='$tabindexAssign'><p class='dayNumber'>$calandrier[$index]</p></td>";
                    $tabindexAssign++;
                    $index++;
                    $filler++;
                };
                echo "<td tabindex='$tabindexAssign'><p class='dayNumber'>$calandrier[$index]</p></td>";
                $tabindexAssign++;
                $index++;
                echo '</tr>';
            };
            ?>
        </tbody>
    </table>
</body>

</html>