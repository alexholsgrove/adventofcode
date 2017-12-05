<?php

include('includes/spreadsheet.php');

/* ----------[ Part 1 ]---------- */
$rows = explode("\n", $spreadsheet);
$checksum = 0;

foreach($rows as $row) {
   $nums = explode(' ', preg_replace('!\s+!', ' ', $row));
   $min = 9999999; $max = 0;
   
   foreach ($nums as $num) {
      $min = min($min, $num);
      $max = max($max, $num);
   }

   $checksum += abs($max-$min);
}

echo '<p>Answer 1: '.$checksum.'</p>';


/* ----------[ Part 2 ]---------- */
