<?php
 $eid=$_GET['eid'];
 $e=explode('@',$eid);
  if (count($e)>=2)
 echo "<br>Email id contains @ symbol ";
 else
 echo "<br>email id does not contains @ symbol";
?>