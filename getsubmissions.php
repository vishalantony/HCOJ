<?php

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	echo "<meta http-equiv='Refresh' content='0; URL=index.php' />";
	die();
}
include("includes/global_values.inc.php");
include('includes/config.inc.php');



$query = 'select normal_sub.prob_id as pid, normal_sub.username as uname, 
normal_sub.status as stat,normal_sub.sub_time as sbtime, normal_sub.code_file as file, normal_problems.prob_code as code 
from normal_sub, normal_problems where normal_sub.username="'.$_SESSION['username'].'" and 
normal_sub.prob_id = normal_problems.prob_id order by normal_sub.sub_time desc;';

//echo $query;
//die();

$result = mysqli_query($db, $query);
if(!$result) {
	die("internal error");
}

?>

<html>
<head>

<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 15px;
}
</style>

</head>
<body>
<table>
	<tr><th>problem code</th><th>status</th><th>submission time</th><th>source code</th></tr>
	<?php
	while($row = mysqli_fetch_assoc($result)) {
		echo '<tr>';
		echo '<td><a href="display_problem.php?pid='.$row['pid'].'">'.$row['code'].'</a></td>';
		echo '<td>'.$row['stat'].'</td>';
		echo '<td>'.$row['sbtime'].'</td>';
		echo '<td>'.$row['file'].'</td>';
		echo '</tr>';
	}
	 mysqli_free_result($result);
	 mysqli_close($db);
	?>

</table>
</body>
</html>
