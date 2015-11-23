<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1 || $_SESSION['username'] != 'admin') {
	echo "<meta http-equiv='Refresh' content='0; URL=../index.php' />";
	die();
}
include("../includes/global_values.inc.php");
include('../includes/config.inc.php');

if(!isset($_POST['submit']) || $_POST['submit'] != 'Upload')  {
	die('internal error.');
}

$pcode = strtoupper($_POST['pcode']);
$pname = $_POST['pname'];
$pfile = $_FILES['prob'];
$file_tmp = $pfile['tmp_name']; 

if(empty($pcode))
	die('pcode empty.');
if(empty($pname))
	die('pname empty.');
	

if(!empty($pfile['error']))
		die("some error occurred while uploading.");

$query = "select * from normal_problems where prob_code = '$pcode';";
//die($query);
$result = mysqli_query($db, $query);
if(mysqli_num_rows($result) > 0)
	die("problem code exists");

if(!move_uploaded_file($file_tmp,"../problems/normal/$pcode"))
	die("2. internal error");

$mkd1 = '../testcases/normal/'.$pcode;
if(!mkdir($mkd1, 0777)) {
	die("cannot create dir");
}

$query = 'insert into normal_problems(prob_code, prob_name, prob_desc)  values
("'.$pcode.'", "'.$pname.'", "problems/normal/'.$pcode.'");';
mysqli_query($db, $query);
if(mysqli_errno())
	die('internal error');
mysqli_close($db);

header("location: admin.php");

?>
