<?php

include('includes/passwords.php');

/* ----------[ Part 1 ]---------- */
$phrases = explode("\n", $passwords);
$valid = 0;

foreach($phrases as $phrase) {
	$words = explode(' ', trim($phrase));
	if(count($words) == count(array_unique($words))) {
		$valid++;
	}
}

echo '<p>Answer 1: '.$valid.'</p>';


/* ----------[ Part 2 ]---------- */
$valid = 0;

foreach($phrases as $phrase) {
	$words = explode(' ', trim($phrase));
	foreach($words as &$word) {
		$letters = str_split($word);
		sort($letters);
		$word = implode('',$letters);
	}

	if(count($words) == count(array_unique($words))) {
		$valid++;
	}
}

echo '<p>Answer 2: '.$valid.'</p>';
