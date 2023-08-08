<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>PHP Calendar Example</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    table {
      border-collapse: collapse;
      border: 1px solid black;
    }
    th, td {
      border: 1px solid black;
      padding: 5px;
      text-align: center;
    }
    .highlight {
      background-color: lightblue;
    }
  </style>
</head>
<body>
  <h1>PHP Calendar Example</h1>
  <?php
function generateCalendar($month, $year)
{
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $firstDay    = date('w', strtotime("{$year}-{$month}-01"));
    $tableHTML = '<table>';
    $tableHTML .= '<tr><th colspan="7">' . date('F Y', strtotime("{$year}-{$month}-01")) . '</th></tr>';
    $tableHTML .= '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
    $dayCount = 1;
    $tableHTML .= '<tr>';
    for ($i = 0; $i < $firstDay; $i++) {
        $tableHTML .= '<td></td>';
    }
    while ($dayCount <= $daysInMonth) {
        if ($firstDay > 6) {
            $tableHTML .= '</tr><tr>';
            $firstDay = 0;
        }
        $tableHTML .= '<td' . ($month == date('m') && $year == date('Y') && $dayCount == date('j') ? ' class="highlight"' : '') . '>' . $dayCount . '</td>';
        $dayCount++;
        $firstDay++;
    }
    while ($firstDay > 0 && $firstDay <= 6) {
        $tableHTML .= '<td></td>';
        $firstDay++;
    }
    $tableHTML .= '</tr>';
    $tableHTML .= '</table>';
    return $tableHTML;
}
$currentMonth = date('m');
$currentYear  = date('Y');
$month = $currentMonth;
$year  = $currentYear;
for ($j = 1; $j < 3; $j++) {
    echo "<h2>" . $year . "</h2>";
    $p = 0;
    for ($i = 1; $i < 13; $i++) {
        if ($p % 3 == 0) {
        }
        if ($month > $i && $currentYear == $year) {
            echo '<div class="col-md-4"></div>';
        } else {
            echo '<div class="col-md-4">';
            echo generateCalendar($i, $year);
            echo '</div>';
        }
        $p++;
    }
    $year++;
}
echo '</div>';
?>
</body>
</html>
