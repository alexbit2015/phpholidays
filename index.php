<!DOCTYPE html>
<html>
<head>
	<title>Holidays checker</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="centerbox">

<?php

/*
Day Format:
	You hate populate 5 values in array element for holiday description.
	Template is: MM.DD.Wday.Week
		MM: from 01 to 12 month (ex. May is 05, Dec is 12);
		DD: Days of month from 1 to 31 (or 20 or 28,29);
		Wday: Day of Week (1 for Monday, 2 for Thuesdat and so on till 7 - Sunday);
		Week: Number of week (1 for first, 2 for second and so on, L for last)

	And we have: Monday of last week of march - '03.x.1.L'

	'x' means "any";
*/

$holidays =['01.01.x.x', '01.07.x.x', '05.01.x.x', '03.12.5.x', 
			'05.01.x.x', '05.02.x.x', '05.03.x.x', '05.04.x.x', 
			'05.05.x.x', '05.06.x.x', '05.07.x.x', '01.x.1.3.1', 
			'03.x.1.L', '11.x.4.4', 'x.x.3.x'];

echo "Today is ".date('l M j');
echo " this is the " . date('m');
echo "th month of year";
echo '<br>';

function isHoliday($days){
	$flag = false;
	
	// ------------- Calculatuning nessesary data values ---------------

	$currentday = strval(date('mj'));
	$currentmonth = (int) date('m');
	$dayofweek = (int) date('N');
	$year = date('Y');

	if ($currentmonth == 1 || $currentmonth == 3 || $currentmonth == 5 || $currentmonth ==8 || $currentmonth == 10 || $currentmonth ==12) 
	{
		$numberOfDaysCurrentMonth = 31;
	} 
	elseif ($currentmonth == 4 || $currentmonth == 6 || $currentmonth == 9 || $currentmonth == 11) 
	{
		$numberOfDaysCurrentMonth = 30;
	}; 

	//$dayOfCurrentMonthBegin = 1;
	echo "<br>"; 
	echo "Number of days in this month is {$numberOfDaysCurrentMonth}";	
	echo "<br>"; 
	echo "<br>"; 
	echo "Stage1 - searching specific day";
	echo "<br>"; 
	echo "<br>"; 

	// ------ Determinate if the specific date equal current day. ----------
	
	foreach ($days as $key => $value) {

		$element = explode('.', $value);
		// echo "Element0 $element[1]";
		// echo '<br>';
		echo "Now is day {$currentday} and we're searching day $element[0]$element[1] ";
		echo "<br>"; 
		if ($element[0] != 'x' && $element[1] != 'x' ) {
			$md = $element[0].$element[1];
			if ($md === $currentday) {
				echo " Got it!  ";
				return true;
			}
		}
	}
		
		echo "<br>"; 
		echo "Seems like this day is not a specific date of holiday!";
		echo "<br>";
		echo "<br>";
		echo "Stage2 - searching floating";
		echo "<br>"; 
		echo "<br>"; 
	
	// ------ Determinate if the current day euqal specific weekday ----------	
		
	foreach ($days as $key => $value) {

		$element = explode('.', $value);

		echo "<br>";
		echo "DayOfWeek is $dayofweek but we are searching $element[2] ";
			

		if ( $element[2] != 'x' && $element[2] == $dayofweek) {
			echo "Got float!";
			
		}
	}
		echo "<br>";
		echo "And we find nothig to selebrate today!";
			
}

if (isHoliday($holidays)) {
	echo "It's holiday now! Let's celebrate!";
} else {
	echo "<br>";
	echo "Sorry, it isn't holiday today, let's work!";
}
?>

</div>

</body>
</html>
