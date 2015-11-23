<?php
	session_start();
	$title = "HCOJ";
	$mainHeading = "Hypercube Online Judge";
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
		header("Location: index.php");
		die();
	}
	
	if(isset($_POST['login']) && $_POST['login'] == 'Login') {
		
		include('includes/config.inc.php');
		$data = array();
		
		$username = (isset($_POST['username']))?trim($_POST['username']):"";
		$passwd = (isset($_POST['password']))?$_POST['password']:"";
		
		$query = 'SELECT * FROM users WHERE username="'.mysqli_real_escape_string($db, $username).'" and 
		user_passwd=PASSWORD("'.mysqli_real_escape_string($db, $passwd).'");';
		$result = mysqli_query($db, $query);
		//echo $query;
		//die();
		
		if(mysqli_connect_errno()) {
			die("hypercube faced some internal error. Please try after sometime.");
		}
		
		if(mysqli_num_rows($result) == 1) {
			$_SESSION['username'] = $username;
			$row = mysqli_fetch_assoc($result);
			$_SESSION['fname'] = $row['fname'];
			$_SESSION['lname'] = $row['lname'];
			$_SESSION['college'] = $row['college'];
			$_SESSION['emailid'] = $row['emailid'];
			$_SESSION['logged'] = 1;
			$data['success'] = true;
			$data['error'] = "no error";
			echo json_encode($data);
		}
		else {
			$data['success'] = false;
			$data['error'] = "username and password did not match.";
			echo json_encode($data);
		}
		mysqli_free_result($result);
		mysqli_close($db);
	}
	
?>
