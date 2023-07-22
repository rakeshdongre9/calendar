<?php
// Function to get the calendar table HTML for a specific month and year
function getCalendarTable($month, $year)
{
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $firstDayOfMonth = date('N', strtotime("{$year}-{$month}-01"));
    $tableHTML = '<table>';
    $tableHTML .= '<tr><th colspan="7">' . date('F Y', strtotime("{$year}-{$month}-01")) . '</th></tr>';
    $tableHTML .= '<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>';
    $tableHTML .= '<tr>';

    $dayCount = 1;
    // Filling the first row with empty cells until the first day of the month
    for ($i = 1; $i < $firstDayOfMonth; $i++) {
        $tableHTML .= '<td></td>';
    }

    // Filling the calendar with days
    while ($dayCount <= $daysInMonth) {
        // If it's Saturday (day 7), close the row and start a new one
        if ($firstDayOfMonth > 7) {
            $tableHTML .= '</tr><tr>';
            $firstDayOfMonth = 1;
        }

        $tableHTML .= '<td>' . $dayCount . '</td>';
        $dayCount++;
        $firstDayOfMonth++;
    }

    // Fill any remaining cells in the last row with empty cells
    while ($firstDayOfMonth <= 7) {
        $tableHTML .= '<td></td>';
        $firstDayOfMonth++;
    }

    $tableHTML .= '</tr>';
    $tableHTML .= '</table>';

    return $tableHTML;
}
// Get the current month and year
$currentMonth = date('m');
$currentYear = date('Y');
?>

<!DOCTYPE html>
<html>
<head>
    <title>10-Year Calendar</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Hide all the tables except the first three */
        table:not(:nth-of-type(-n+3)) {
            display: none;
        }
    </style>
</head>
<body>
    <h1>10-Year Calendar</h1>
    <?php
    // Display calendars for the next ten years
    for ($i = 0; $i < 120; $i++) {
        $month = $currentMonth + $i;
        $year = $currentYear;

        // Calculate the actual month and year based on the incremented value
        $actualMonth = ($month % 12 === 0) ? 12 : ($month % 12);
        $actualYear = $year + floor($month / 12);

        echo getCalendarTable($actualMonth, $actualYear);
    }
    ?>

    <script>
        // JavaScript to toggle the visibility of tables
        function showNextThreeMonths(currentIndex) {
            var tables = document.querySelectorAll('table');
            for (var i = 0; i < tables.length; i++) {
                if (i >= currentIndex && i < currentIndex + 3) {
                    tables[i].style.display = 'table';
                } else {
                    tables[i].style.display = 'none';
                }
            }
        }

        var currentIndex = 0;
        showNextThreeMonths(currentIndex);

        function showNext() {
            currentIndex += 3;
            if (currentIndex >= 120) {
                currentIndex = 0;
            }
            showNextThreeMonths(currentIndex);
        }

        function showPrevious() {
            currentIndex -= 3;
            if (currentIndex < 0) {
                currentIndex = 120 - (120 % 3);
            }
            showNextThreeMonths(currentIndex);
        }
    </script>

    <button onclick="showPrevious()">Previous</button>
    <button onclick="showNext()">Next</button>
</body>
</html>
