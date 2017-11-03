<?php

/**
 * @param $month
 * @param $year
 */
function calendar($month, $year)
{
    $first_day_month = mktime(0, 0, 0, $month, 1, $year);
    $day_of_week = strftime("%w", $first_day_month);
    $full_month = strftime("%B", $first_day_month);
    $previous_month = $month - 1;
    $previous_year = $year;
    $next_month = $month + 1;
    $next_year = $year;

    //adjust prev/next month data
    if ($previous_month == 0) {
        $previous_month = 12;
        $previous_year--;
    }
    if ($next_month == 13) {
        $next_month = 1;
        $next_year++;
    }

    //length of the month
    $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $days_in_previous_month = cal_days_in_month(CAL_GREGORIAN, $previous_month, $previous_year);

    //Create Prev/Next links
    $previous_month_link = "<a href=\"/calendar.php?month=$previous_month&amp;year=$previous_year\"><img id=\"previous\" src=\"images/previous.png\" alt=\"previous month\" title=\"previous month\" /></a>";
    $next_month_link = "<a href=\"/calendar.php?month=$next_month&amp;year=$next_year\"><img id=\"next\" src=\"images/next.png\" alt=\"next month\" title=\"next month\" /></a>";

    echo '<table>';
    echo "<caption>$full_month $year</caption>";

    echo "<tr class=\"prev_next\"><td>$previous_month_link</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>$next_month_link</td></tr>";
    echo "<tr class=\"weekdays\"><td>Sunday</td><td>Monday</td><td>Tuesday</td><td>Wednesday</td><td>Thursday</td><td>Friday</td><td>Saturday</td></tr>";

    echo "<tr>";

    //first week of month
    $day = 0;
    //display leading days from previous month
    while ($day < $day_of_week) {
        $day_of_previous_month = $days_in_previous_month - ($day_of_week - $day -1);
        echo "<td><span class=\"other_month\">$day_of_previous_month</span></td>";
        $day++;
    }

    //display days of first week
    $day = 1;
    while ($day <= 7 - $day_of_week) {
        echo "<td><span class=\"day_number\">$day</span></td>";
        $day++;
    }

    echo "</tr>";

    //display more weeks as needed
    while ($day <= $days_in_month) {
        echo "<tr>";

        $day_in_week_counter = 1;
        $day_of_next_month = 1;
        while ($day_in_week_counter <= 7) {
            if ($day <= $days_in_month){
                echo "<td><span class=\"day_number\">$day</span></td>";
            } else {
                //trailing days of next month
                echo "<td><span class=\"other_month\">$day_of_next_month</span></td>";
                $day_of_next_month++;
            }
                $day_in_week_counter++;
                $day++;
        }
        echo "</tr>";
    }

    echo "</table>";
}


function rating_stars($rating){
    $rating_stars = "";
    for ($i = 1; $i <= $rating; $i++) {
        $rating_stars .= '<img src="images/blue_star.png" alt="rating star" />';
    }
    return $rating_stars;
};


function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
        30 * 24 * 60 * 60       =>  'month',
        24 * 60 * 60            =>  'day',
        60 * 60                 =>  'hour',
        60                      =>  'minute',
        1                       =>  'second'
    );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
        }
    }
}
?>