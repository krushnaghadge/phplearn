<?php
$op = $_GET['op'];
$input = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
switch($op)
{
case 1 : $flipped = array_flip($input);
print_r($flipped);
break;
case 2 : shuffle($input);
print_r($input);
break;
}
?>
