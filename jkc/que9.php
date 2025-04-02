<?php

$eid=$_GET['emailid'];
$cnt_1 = substr_count($eid,"@");
$cnt_2 = substr_count($eid,".");
echo "total count of @ is $cnt_1 and total count of .(dot) is $cnt_2";
?>