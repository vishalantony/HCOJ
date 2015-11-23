<?php 
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1 || $_SESSION['username'] != 'admin') {
	echo "<meta http-equiv='Refresh' content='0; URL=admin.php' />";
	die();
}

if(!isset($_POST['submit']) || $_POST['submit'] != 'Create') {
	echo "<meta http-equiv='Refresh' content='0; URL=admin.php' />";
	die();
}

include("../includes/global_values.inc.php");
include('../includes/config.inc.php');
	
$contest_name = $_POST['pname'];
$startd = $_POST['startd'];
$endd = $_POST['endd'];
$startt = $_POST['startt'];
$endt = $_POST['endt'];

$start = $startd.' '.$startt;
$end = $endd.' '.$endt;

//echo $start.'<br>'.$end;
//die();

$query = 'insert into contests(name, start_time, end_time) values("'.mysqli_real_escape_string($db, $contest_name).'", 
"'.mysqli_real_escape_string($db, $start).'", "'.mysqli_real_escape_string($db, $end).'");';

$res = mysqli_query($db, $query);
if(mysqli_errno()) {
	die('internal error');
}

mysqli_free_result($result);
mysqli_close($db);
header("location: enter_contest.php");
?>	
