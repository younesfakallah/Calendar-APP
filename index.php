<?php

    $months = array('01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre');
    $years = array(2000, 2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022);
    $days = array('Monday' => 'Lundi', 'Tuesday' => 'Mardi', 'Wednesday' => 'Mercredi', 'Thursday' => 'Jeudi', 'Friday' => 'Vendredi', 'Saturday' => 'Samedi', 'Sunday' => 'Dimanche');

    if(isset($_POST['submit'])) {
        function returnMonth($arr) {
            foreach($arr as $monthKey => $monthVal) {
                if($monthVal === $_POST['month']) {
                    return $monthKey;
                }
            }
        }
        $date = new DateTime($_POST['year'] . '-' . returnMonth($months) . '-01');
        $dayName = $date->format('l');

        $maxDays = cal_days_in_month(CAL_GREGORIAN, returnMonth($months), $_POST['year']);
    }
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css">
    <title>TP - PARTIE 9</title>
</head>
<body>
    <form action="" method="post">
        <label for="month">Mois : </label>
        <select name="month">
            <?php foreach($months as $monthKey => $monthVal): ?>
                <option value='<?= $monthVal; ?>'><?= $monthVal; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="year">Années : </label>
        <select name="year">
            <?php foreach($years as $year): ?>
                <option value='<?= $year; ?>'><?= $year; ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="submit">Valider</button>
    </form>
    <?php if(isset($_POST['submit'])): ?>
        <h1><?= $_POST['month']; ?> <?= $_POST['year']; ?></h1>
    <?php endif; ?>
    <table class="table">
            <thead>
                <tr>
                <?php foreach($days as $dayKey => $dayVal): ?>
                    <th scope="col"><?= $dayVal; ?></th>
                <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                    <?php if(isset($_POST['submit'])): ?>
                        <?php $i = 0; ?>
                        <?php for($row = 1; $row < 7; $row++): ?>
                            <?php if($row != 1): ?>
                                <tr>
                                    <?php foreach($days as $dayKey => $dayVal): ?>
                                        <?php while($dayKey == $dayName AND $i === 0): ?>
                                            <?php $i++; ?>
                                            <td><?= $i; ?></td>
                                        <?php endwhile; ?>
                                        <?php if($i === 0): ?>
                                            <td></td>
                                        <?php elseif($i === $maxDays): ?>
                                            
                                            <?php break; ?>
                                        <?php else: ?>
                                            <?php $i++; ?>
                                            <td><?= $i; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                            <?php else: ?>
                                <tr>
                                    <?php foreach($days as $dayKey => $dayVal): ?>
                                        <?php if($dayKey == "Sunday"): ?>
                                            <?php if($i == 0): ?>
                                                <?php $i++; ?>
                                                <td><?= $i; ?></td>
                                                <?php break; ?>
                                            <?php else: ?>
                                                <?php break; ?>
                                            <?php endif; ?>
                                                    <?php $i++; ?>
                                                    <td><?= $i; ?></td>
                                                    <?php break; ?>
                                        <?php endif; ?>
                                        <?php while($dayKey == $dayName AND $i === 0): ?>
                                                    <?php $i++; ?>
                                                    <td><?= $i; ?></td>
                                        <?php endwhile; ?>
                                        <?php if($i === 0): ?>
                                            <td></td>
                                        <?php elseif($i === $maxDays): ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <?php break; ?>
                                        <?php else: ?>
                                            <?php $i++; ?>
                                            <td><?= $i; ?></td>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endif; ?>
                            
                        <?php endfor; ?>
                    <?php else: ?>
                        <?php for($i = 1; $i < 6; $i++): ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
            </tbody>
    </table>
</body>
</html>