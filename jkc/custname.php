<?php $name=$_POST['name']; $choice=$_POST['option'];
switch($choice) {
case 1: echo "<h2>After Tranforming $name to uppercase</h2><br>"; echo "<b>".strtoupper($name)."</b>";
break;
case 2: echo "<h2>After Making $name first character to upper</h2><br>"; echo "<b>".ucfirst($name)."</b>";
break;
default : echo "Please choose one operation"; }
?>