<?php

$memory = '0	5	10	0	11	14	13	4	11	8	8	7	1	4	12	11';
//$memory = '0	2	7	0';
$blocks = explode("\t", $memory);
$block_count = count($blocks);

$states = array(); // Store previous configurations
$repeats = array(); // Store iterations before we find a repeat state

// First state
$states[] = implode('-',$blocks); // Store each iteration state

$i = 0; // Safety counter to prevent infinite loops


while(count($repeats) < 2) {
	//echo implode('-', $blocks).'<br />';

	$value = -1; // Largest memory block value
	$index = 0; // Largest memory block position

	// First loop to find the largest block value and location
	for($b=0; $b<count($blocks); $b++) {
		if($blocks[$b]>$value) {
			$value = $blocks[$b];
			$index = $b;
		}
	}

	// Second loop to redistribute the value
	$blocks[$index] = 0; // Set the largest block to zero
	$spread = ceil($value / 16); // How much to redistribute to each block
	$index++; // Start at the next block

	while($value>0) {
		for($n=$index; $n<count($blocks); $n++) {
			$blocks[$n] += $spread;

			if(--$value==0) {
				break;
			}
		}
		$index = 0;
	}

	// Store the current state
	$state = implode('-',$blocks); // Store each iteration state
	
	// Part 1 - Check to see if we have the first repeat
	if(count($repeats) == 0 && in_array($state, $states)) {
		$iterations = count($states);
		$repeats[] = array('iterations' => $iterations, 'state' => $state);
		echo '<p>First repeat found after ' . $iterations. ' iterations</p>';
	}

	// Part 2 - Check for the second repeat
	if(count($repeats) == 1) {
		if(in_array($state, array_slice($states, $repeats[0]['iterations']-1))) {
			$iterations = count($states);
			echo '<p>Second iteration found after another ' . (++$iterations - $repeats[0]['iterations']) . ' iterations</p>';
			die(); // Done
		}
	}

	// Update the states
	$states[] = $state;

	// Prevent addicents
	if(++$i>1000000) {
		die('too many cycles');
	}
}
