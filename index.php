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
	You have to populate 5 values in array element for holiday description.
	Template is: MM.DD.Wday.Week
		MM: from 01 to 12 month (ex. May is 05, Dec is 12);
		DD: Days of month from 1 to 31;
		Wday: Day of Week (1 for Monday, 2 for Thuesdat and so on till 7 - Sunday);
		Week: Number of week (1 for first, 2 for second and so on, L for last)

	And we have: Monday of last week of march - '03.x.1.L'

	'x' means "any";
*/

$holidays =['01.01.x.x', '01.07.x.x', '05.01.x.x', '03.12.5.x', 
			'05.01.x.x', '05.02.x.x', '05.03.x.x', '05.04.x.x', 
			'05.05.x.x', '05.06.x.x', '05.07.x.x', '01.x.1.3', 
			'03.x.1.L', '11.x.4.4', 'x.x.4.5', 'x.x.4.3'];

echo "Today is ".date('l M j');
echo " this is the " . date('m');
echo "th month of year";
echo '<br>';

function isHoliday($days){
	$flag = false;
	
	// ------------- Calculatuning nessesary data values ---------------

	$currentday = strval(date('mj'));
	$currentmonth = (int) date('m');
	$currentdayofweek = (int) date('N');
	$currentyear = date('Y');
	$floatday_flag = false;

	// setting up number of days in current month
	
	if ($currentmonth == 1 || $currentmonth == 3 || $currentmonth == 5 || $currentmonth ==8 || $currentmonth == 10 || $currentmonth ==12) 
	{
		$numberOfDaysCurrentMonth = 31;
	} elseif ($currentmonth == 4 || $currentmonth == 6 || $currentmonth == 9 || $currentmonth == 11) 
	{
		$numberOfDaysCurrentMonth = 30;
	} elseif ($currentmonth == 2) {
		if (((($currentyear % 4) == 0) && (($currentyear % 100) != 0)) || ($currentyear % 400) == 0) {
			$numberOfDaysCurrentMonth = 29;
		} else $numberOfDaysCurrentMonth = 28;
	}; 

	// ------ Determinate if the specific date equal current day. ----
	
	foreach ($days as $key => $value) {

		$element = explode('.', $value);
		if ($element[0] != 'x' && $element[1] != 'x' ) {
			$md = $element[0].$element[1];
			if ($md === $currentday) {
	
				return true;
			};
		};
	};
	
// --- Determinate if the current week euqals specific weeknumber ----	

// --------- We have to find number of current week of year ------

$tweek = strtotime("now"); 
$current_week_of_year = (int) date("W", $tweek);

// ------ And we have to find number of current week of month ------

$tweek2 = strtotime("1.$currentmonth.$currentyear"); 
$currentmonth_firstday_weeknumber = (int) date("W", $tweek2);
$current_week_number_of_month = $current_week_of_year - $currentmonth_firstday_weeknumber + 1;

// --- Determinate if the current day euqals specific weekday -----	
		
	foreach ($days as $key => $value) {

		$element = explode('.', $value);

		if ($element[3] != 'L') {

			if ( $element[2] != 'x' && $element[2] == $currentdayofweek && $element[3] != 'x' && $element[3] == $current_week_number_of_month) {
				$floatday_flag = true;
				};

			} else {
				$weekday_counter = 0;
				for ($i=1; $i <=$numberOfDaysCurrentMonth ; $i++) { 
					
					$daynum =  (int) date(N, strtotime("$i.$currentmonth.$currentyear"));
					if ($element[2] == $daynum) $weekday_counter++;
				};

				if($current_week_number_of_month == $weekday_counter) {
					$floatday_flag = true;
				};
			}; //else

	};

// ------ And final check! -----------------

if ($floatday_flag === true) {
		return true;
	} else return false;
};

if (isHoliday($holidays)) {
	echo "<br>";
	echo "It's holiday now! Let's celebrate!";
	echo "<br>";
} else {
	echo "<br>";
	echo "Sorry, it isn't holiday today, let's work!";
	echo "<br>";
};
?>

</div>

</body>
</html>
