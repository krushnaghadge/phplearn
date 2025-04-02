<?php
$s=$_POST['str']; $choice=$_POST['option']; $arr=array(' sanket','shubham '); switch($choice)
{
case 1: if($s!=null)
{
for($i=0;$i<strlen($s);$i++) {
array_push($arr,$s[$i]); }
}
echo "<h2>After adding element stack is</h2><br>";
print_r($arr); break;
case 2: if($s!=null) {
for($i=0;$i<strlen($s);$i++) {
array_pop($arr,$s[$i]); }
} break;
case 3: echo "<h2>The Content of stack is</h2><br>"; if($s!=null)
{
for($i=0;$i<strlen($s);$i++)
{
echo array_pop($arr);
} }
break; }
?>