<?php
// $arr = array(1, 2, 3, 4);
// foreach ($calandrier as &$value) {
//     $value = $value * 2;
// }
$calandrier = [];
for ($i = 0; $i <= 41; $i++) {
    $calandrier[$i] = '';
}

// USER INPUT VARIABLES HERE:
// is the chooosed section line 32

// PRIMARY AFFECTIONS :

// $currentMonth     --> to affect header
// $currentYear     --> to affect header
// $currentDay       --> to affect the addtitions and background-selected


$choosedYear = $_GET['year'];
$choosedMonth = $_GET['month'];
$choosedDate = new DateTime("$choosedYear-$choosedMonth-1"); // could future add $choosedDay || it would be related to JS effects -> affection to object

$choosedMonthLiteral = $choosedDate->format('F');
$choosedMonthTotalDays = $choosedDate->format('t'); // 28-31
$choosedMonthFirstWeekDay = $choosedDate->format('N'); // 1 for monday, 7 for sunday

//a for to fill the actual month days
$dayCounter = $choosedMonthFirstWeekDay - 1;
for ($i = 1; $i <= $choosedMonthTotalDays; $i++) {
    $calandrier[$dayCounter] = $i;
    $dayCounter++;
}
// details v2.0
//-- a for to fill the days before (need to verify month before month days number)
//-- a for to fill the days after
//-- on click you change for the month of the days
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Calendar</title>
</head>

<body>
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
            <tr>
                <?php
                for ($i = 0; $i <= 6; $i++) { ?>
                    <td><?= $calandrier[$i] ?></td>
                <?php } ?>
            </tr>
            <tr>
                <?php
                for ($i = 7; $i <= 13; $i++) { ?>
                    <td><?= $calandrier[$i] ?></td>
                <?php } ?>
            </tr>
            <tr>
            <?php
                for ($i = 14; $i <= 20; $i++) { ?>
                    <td><?= $calandrier[$i] ?></td>
                <?php } ?>
            </tr>
            <tr>
            <?php
                for ($i = 21; $i <= 27; $i++) { ?>
                    <td><?= $calandrier[$i] ?></td>
                <?php } ?>
            </tr>
            <tr>
            <?php
                for ($i = 28; $i <= 34; $i++) { ?>
                    <td><?= $calandrier[$i] ?></td>
                <?php } ?>
            </tr>
            <tr>
            <?php
                for ($i = 35; $i <= 41; $i++) { ?>
                    <td><?= $calandrier[$i] ?></td>
                <?php } ?>
            </tr>
        </tbody>
    </table>
    <script src="./index.js"></script>
</body>
</html>