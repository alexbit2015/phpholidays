<!DOCTYPE html>
<html>
<head>
	<title>Holidays checker</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="centerbox">

<?php

$holidays =['01.01.x.x.x', '01.07.x.x.x', '05.01.x.x.x', '03.10..x.x.x', 
			'05.01.x.x.x', '05.02.x.x.x', '05.03.x.x.x', '05.04.x.x.x', 
			'05.05.x.x.x', '05.06.x.x.x', '05.07.x.x.x', 'x.x.1.3.1', 
			'x.x.1.L.3', 'x.x.4.4.3'];

echo "Today is ".date('l M j');
echo " this is the " . date('m');
echo "th month of year";
echo '<br>';

function isHoliday($days){
	$flag = false;
	$currentday = strval(date('mj'));
	$dayofweek = strval(date('N'));
	
	if (in_array($currentday, $days)) {
		$flag = true;
		} else{
				foreach ($days as $key => $value) {
						$a = explode('.', $value);
						if ($dayofweek === $a) {
								# code...				
						}
				}
		
		}
			
		
}

if (isHoliday($holidays)) {
	echo "It's holiday now! Let's celebrate!";
} else echo "Sorry, it isn't holiday today, let's work!";
?>

</div>

</body>
</html>
