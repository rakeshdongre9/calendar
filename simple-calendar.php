<style>
    td{
        height:30px;
        text-align:center;
    }
</style>
<?php


function build_calendar($year) {
    $months = [
        1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 
        5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 
        9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
    ];

    $daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    $calendar = '<div style="display: flex; flex-wrap: wrap; justify-content: space-around;">';

    foreach ($months as $monthNumber => $monthName) {
        $calendar .= '<div style="flex: 1; min-width: 300px; margin: 10px;">';
        $calendar .= '<table border="1" cellpadding="5" style="border-collapse: collapse;">';
        $calendar .= '<tr><th colspan="7">' . $monthName . ' ' . $year . '</th></tr>';
        $calendar .= '<tr>';
        
        foreach ($daysOfWeek as $day) {
            $calendar .= '<th>' . $day . '</th>';
        }
        
        $calendar .= '</tr><tr>';

        $firstDayOfMonth = mktime(0, 0, 0, $monthNumber, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $dayOfWeek = $dateComponents['wday'];

        $currentDay = 1;
        $cellCount = 0;

        // Print empty cells until the first day of the month
        for ($i = 0; $i < $dayOfWeek; $i++) {
            $calendar .= '<td></td>';
            $cellCount++;
        }

        // Print the days of the month
        while ($currentDay <= $numberDays) {
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= '</tr><tr>';
            }

            $calendar .= '<td>' . $currentDay . '</td>';
            $currentDay++;
            $dayOfWeek++;
            $cellCount++;
        }

        // Complete the row and fill remaining cells to make a 6x7 grid
        while ($cellCount % 7 != 0) {
            $calendar .= '<td></td>';
            $cellCount++;
        }

        // Add additional rows to ensure 6 rows in total
        while ($cellCount < 42) {
            if ($cellCount % 7 == 0) {
                $calendar .= '</tr><tr>';
            }
            $calendar .= '<td></td>';
            $cellCount++;
        }

        $calendar .= '</tr>';
        $calendar .= '</table>';
        $calendar .= '</div>';
    }

    $calendar .= '</div>';
    return $calendar;
}

$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

echo build_calendar($year);
?>
