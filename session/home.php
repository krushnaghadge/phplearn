<?php

session_start();
if(isset($_SESSION['emp_id']))
{
     echo "vaid user";
     ?>
     <a href="logout.php">Log Out</a>
     <?php

}
else

{

    echo "Invalid User";

}





?>