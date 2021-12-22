<?php

include('includes/offsets.php');

/* ----------[ Part 1 ]---------- */
$digits  = explode("\n", $offsets);
$outside = false; // Are we still within the range
$index   = 0;     // Our current position
$steps   = 0;     // Total steps

while($outside == false) {
	if(isset($digits[$index])) {
		$index += $digits[$index]++;
		$steps++;
	} else {
		$outside = true;
	}

	// Prevent accidents - a million iterations should do it
	if($steps > 1000000) {
		die('Too many steps');
	}
}

echo '<p>Answer 1: '.$steps.'</p>';


/* ----------[ Part 2 ]---------- */
$digits  = explode("\n", $offsets);
$outside = false; // Are we still within the range
$index   = 0;     // Our current position
$steps   = 0;     // Total steps

while($outside == false) {
	if(isset($digits[$index])) {
		$index += ($digits[$index] >=3 ? $digits[$index]-- : $digits[$index]++);
		$steps++;
	} else {
		$outside = true;
	}

	// Prevent accidents - a million iterations should do it
	if($steps > 100000000) {
		die('Too many steps');
	}
}

echo '<p>Answer 2: '.$steps.'</p>';
