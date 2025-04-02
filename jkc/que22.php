<?php
echo "
Associative array : Ascending order sort by value
";
$array2=array("Sagar"=>"31","Vicky"=>"41","Leena"=>"39","Ramesh"=>"40"); asort($array2);
foreach($array2 as $y=>$y_value)
{
echo "Age of ".$y." is : ".$y_value."
";
}
echo "
Associative array : Ascending order sort by Key
";
$array3=array("Sagar"=>"31","Vicky"=>"41","Leena"=>"39","Ramesh"=>"40"); ksort($array3);
foreach($array3 as $y=>$y_value)
{
echo "Age of ".$y." is : ".$y_value."
";
}
echo "
Associative array : Descending order sorting by Value
"; $age=array("Sagar"=>"31","Vicky"=>"41","Leena"=>"39","Ramesh"=>"40"); arsort($age);
foreach($age as $y=>$y_value)
{
echo "Age of ".$y." is : ".$y_value."
 ";
}
echo "
Associative array : Descending order sorting by Key ";
$array4=array("Sagar"=>"31","Vicky"=>"41","Leena"=>"39","Ramesh"=>"40"); krsort($array4);
foreach($array4 as $y=>$y_value)
{
echo "Age of ".$y." is : ".$y_value."
 ";
}
?>