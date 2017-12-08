<?php

include('includes/instructions.php');
/*
$instructions = 'b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10';
*/

$rows = explode("\n", $instructions);

$register = array();
$max = 0;


// Set the registers
foreach($rows as $row) {
   preg_match('/([a-z]+) [inc|dec]+ [\+\-\d]+ if ([a-z]+)/', $row, $matches);
   if(isset($matches[1]) && isset($matches[2])) {
      $register[$matches[1]] = 0;
      $register[$matches[2]] = 0;
   }
}

// Run the instructions
foreach($rows as $row) {
   preg_match('/([a-z]+) ([inc|dec]+) ([\+\-\d]+) if ([a-z]+) ([\>\<\=]+) ([\+\-\d]+)/', $row, $matches);
   
   $key      = $matches[1]; // The register to adjust
   $operator = $matches[2]; // Increment or decrement
   $value    = $matches[3]; // How much to increment / decrement
   $reg      = $matches[4]; // The register address to check
   $cmp      = $matches[5]; // The comparison operator
   $val      = $matches[6]; // The register value to compare

   if(isset($register[$reg]) && compare($register[$reg], $val, $cmp)) {
      if($operator == 'inc') {
         $register[$key] += $value;
      } else {
         $register[$key] -= $value;
      }
   }
}


// Get the max value
$max = array_keys($register, max($register));
echo '<p>Answer 1: ' . $register[$max[0]] . '</p>';

echo '<pre>'.print_r($register, true).'</pre>';


/**
 *
 * @param int $a - first value
 * @param int $b - second value
 * @param string $o - comparison operator
 * @return bool
 */
function compare($a, $b, $o) {
   switch ($o) {
      case '<':
         return $a < $b;
      break;
      case '<=':
         return $a <= $b;
      break;
      case '>':
         return $a > $b;
      break;
      case '>=':
         return $a >= $b;
      break;
      case '==':
         return $a == $b;
      break;
      case '!=':
         return $a != $b;
      break;
      default:
         return false;
   }
}