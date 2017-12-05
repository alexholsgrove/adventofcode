<?php 

include('includes/captcha.php');

$digits = str_split($captcha . substr($captcha,-1));
$decode = '';

for($i=0; $i < count($digits); $i++) {
   if(isset($digits[$i+1]) && $digits[$i] == $digits[$i+1]) {
      $decode += $digits[$i];
   }
}

echo '<p>Answer 1: '.$decode.'</p>';


$count  = strlen($captcha);
$digits = str_split($captcha.$captcha);
$decode = '';

for($i=0; $i < $count; $i++) {
	$offset = ($count/2) + $i;
   if(isset($digits[$offset]) && $digits[$i] == $digits[$offset]) {
      $decode += $digits[$i];
   }
}

echo '<p>Answer 2: '.$decode.'</p>';
