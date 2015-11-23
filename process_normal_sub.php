<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	header("location: index.php");
	die();
}
include("includes/global_values.inc.php");
include('includes/config.inc.php');

if(isset($_POST['upload_file']) && $_POST['upload_file'] == 'Submit' && isset($_FILES['ans'])) {
	//$accepted_types = array('text/x-c++src', 'text/x-csrc', 'text/x-java', 'text/x-python', 'application/x-ruby', 'application/x-php');
	//if(!in_array($_FILES['ans']['type'] , $accepted_types))
		//die("unknown file type.");
	$file_tmp =$_FILES['ans']['tmp_name'];
	$ext = 'wrong';
	
	switch($_FILES['ans']['type']) {
		case 'text/x-c++src': $ext = 'cpp'; break;
		case 'text/x-csrc': $ext = 'c'; break;
		case 'text/x-java': $ext = 'java'; break;
		case 'text/x-python': $ext = 'py'; break;
		case 'application/x-ruby': $ext = 'rb'; break;
		case 'application/x-php' : $ext = 'php'; break;
	}

	if($_FILES['ans']['size'] > 50000)
		die("File too big");
	if(!empty($_FILES['ans']['error']))
		die("some error occurred while uploading.");
		
	$username = $_SESSION['username'];
	$pid = $_POST['pid'];
	
	$query = 'insert into normal_sub(username, prob_id, status, sub_time, code_file) 
	values("'.$username.'", '.$_POST['pid'].', "WA", NOW(), "/dev/null")';
	//die($query);
	mysqli_query($db, $query);
	if(mysqli_errno()) {
		die('1. internal error');
	}
	$subid = mysqli_insert_id($db);
	//die(''.$subid);
	
	$filename = $subid.'.'.$ext; 
	if(!move_uploaded_file($file_tmp,"codes/normal/$username/".$filename))
		die("2. internal error");
	
	// find the problem code
	$query = 'select * from normal_problems where prob_id = '.$_POST['pid'].';';
	$result = mysqli_query($db, $query);
	if(!$result)
		die("3. internal error");
	if(mysqli_num_rows($result) <= 0)
		die("4. internal error");
	$row = mysqli_fetch_assoc($result);
	$prob_code = $row['prob_code'];
	
	// the main files and folders:
	$codefile = "codes/normal/$username/".$filename;
	$testcasefolder = "testcases/normal/$prob_code/";
	$usercodefolder = "codes/normal/$username/";
	
	$output = array();
	$retvalue = 0;
	
	//echo "./engine $codefile $testcasefolder $usercodefolder $ext";
	//die();
	
	exec("./engine $codefile $testcasefolder $usercodefolder $ext", $output, $retvalue);
	//exec("./engine $destFile $file", $output, $verdict);	
	
	$verdict;
	
	if($retvalue == 0) {
		// correct
		$query = 'update normal_sub set status="AC", code_file="'.$codefile.'" where
		sub_id='.$subid.';';
		mysqli_query($db, $query);
		if(mysqli_errno()) {
			die('5. internal error');
		}
		$verdict = 'AC';
	}
	
	else if($retvalue == 1) {
		// correct
		$query = 'update normal_sub set status="WA", code_file="'.$codefile.'" where
		sub_id='.$subid.';';
		mysqli_query($db, $query);
		if(mysqli_errno()) {
			die('5. internal error');
		}
		$verdict = 'CLE';
	}
	
	else if($retvalue == 4) {
		// correct
		$query = 'update normal_sub set status="WA", code_file="'.$codefile.'" where
		sub_id='.$subid.';';
		mysqli_query($db, $query);
		if(mysqli_errno()) {
			die('5. internal error');
		}
		$verdict = 'ILF';
	}
	
	else if($retvalue == 3) {
		// time limit exceeded
		$query = 'update normal_sub set status="TLE", code_file="'.$codefile.'" where
		sub_id='.$subid.';';
		mysqli_query($db, $query);
		if(mysqli_errno()) {
			die('internal error');
		}
		$verdict = 'TLE';
	}
	else {
		// wrong answer
		$query = 'update normal_sub set status="WA", code_file="'.$codefile.'" where
		sub_id='.$subid.';';
		mysqli_query($db, $query);
		if(mysqli_errno()) {
			die('6. internal error');
		}
		$verdict = 'WA';
	}
	header("location: display_problem.php?pid=$pid&verdict=$verdict");
	die();
}
?>
