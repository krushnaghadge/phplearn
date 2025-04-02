<?php $xml=simplexml_load_file("Employee.xml"); echo "<h2>Details of employees</h2>";
echo "<table border=1>";
echo "<tr>";
echo "<td>Employee No</td><td>Employee Name</td><td>Salary</td><td>Designation</td>"; echo "</tr>";
foreach($xml->employee as $emp)
{
echo "<tr>";
echo "<td>$emp->empno</td><td>$emp->empname</td><td>$emp- >salary</td><td>$emp->designation</td>";
echo "</tr>";
 }
echo "</table>"; ?>