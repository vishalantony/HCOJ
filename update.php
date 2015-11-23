<?php
	session_start();
	
	if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
		header("Location: index.php");
		die();
	}
	
	
	include('includes/config.inc.php');
	include('includes/global_values.inc.php');
	
	// updates information here
	
	if(isset($_POST['update']) && $_POST['update'] == 'Update') {
		
		$data = Array();
		$data['error'] = "no errors";
		$data['success'] = true;
		$ufname = (isset($_POST['fname']))?trim($_POST['fname']):"";
		$ulname = (isset($_POST['lname']))?trim($_POST['lname']):"";
		$uemail = (isset($_POST['emailbox']))?trim($_POST['emailbox']):"";
		$upasswd = (isset($_POST['pwd']))?$_POST['pwd']:"";
		$uconfpasswd = (isset($_POST['confpwd']))?$_POST['confpwd']:"";
		$ucollege = (isset($_POST['college']))?trim($_POST['college']):"";
		$uusername = (isset($_POST['username']))?trim($_POST['username']):"";
		
		if(!empty($ufname)) {
			$query = 'UPDATE users SET fname = "'.mysqli_real_escape_string($db, $ufname).'" WHERE 
			emailid = "'.mysqli_real_escape_string($db, $_SESSION['emailid']).'";';
			$result = mysqli_query($db, $query);
			
			if(!$result) {
				$data['error'] = "hypercube faced some internal error. Please try after sometime.";
				$data['success'] = false;
				echo json_encode($data);
				die();
			}
			else {
				$_SESSION['fname'] = $ufname;
			}
			mysqli_free_result($result);
		}
		if(!empty($ulname)) {
			$query = 'UPDATE users SET lname = "'.mysqli_real_escape_string($db, $ulname).'" WHERE 
			emailid = "'.mysqli_real_escape_string($db, $_SESSION['emailid']).'";';
			$result = mysqli_query($db, $query);
			
			if(!$result) {
				$data['error'] = "hypercube faced some internal error. Please try after sometime.";
			$data['success'] = false;
			echo json_encode($data);
			die();
			}
			else {
				$_SESSION['lname'] = $ulname;
			}
			mysqli_free_result($result);
		}
		if(!empty($uemail)) {
			$query = 'UPDATE users SET emailid = "'.mysqli_real_escape_string($db, $uemail).'" WHERE 
			emailid = "'.mysqli_real_escape_string($db, $_SESSION['emailid']).'";';
			$result = mysqli_query($db, $query);
			
			if(!$result) {
				$data['error'] = "hypercube faced some internal error. Please try after sometime.";
			$data['success'] = false;
			echo json_encode($data);
			die();
			}
			else {
				$_SESSION['emailid'] = $uemail;
			}
			mysqli_free_result($result);
		}
		if(!empty($ucollege)) {
			$query = 'UPDATE users SET college = "'.mysqli_real_escape_string($db, $ucollege).'" WHERE 
			emailid = "'.mysqli_real_escape_string($db, $_SESSION['emailid']).'";';
			$result = mysqli_query($db, $query);
			
			if(!$result) {
				$data['error'] = "hypercube faced some internal error. Please try after sometime.";
				$data['success'] = false;
				echo json_encode($data);
				die();
			}
			else {
				$_SESSION['college'] = $ucollege;
			}
			mysqli_free_result($result);
		}
		if(!empty($uusername)) {
			$query = 'UPDATE users SET username = "'.mysqli_real_escape_string($db, $uusername).'" WHERE 
			emailid = "'.mysqli_real_escape_string($db, $_SESSION['emailid']).'";';
			$result = mysqli_query($db, $query);
			
			if(!$result) {
				$data['error'] = "hypercube faced some internal error. Please try after sometime.";
				$data['success'] = false;
				echo json_encode($data);
				die();
			}
			else {
				$_SESSION['username'] = $uusername;
			}
			mysqli_free_result($result);
		}
		if(!empty($upasswd)) {
			if(strcmp($upasswd, $uconfpasswd) != 0) {
				$data['success'] = false;
				$data['error'] = "passwords mismatch";
				echo json_encode($data);
				die();
			}
			$query = 'UPDATE users SET user_passwd = PASSWORD("'.mysqli_real_escape_string($db, $upasswd).'") WHERE 
			emailid = "'.mysqli_real_escape_string($db, $_SESSION['emailid']).'";';
			$result = mysqli_query($db, $query);
			
			if(!$result) {
				$data['error'] = "hypercube faced some internal error. Please try after sometime.";
				$data['success'] = false;
				echo json_encode($data);
				die();
			}
			mysqli_free_result($result);
		}
		
mysqli_close($db);
		echo json_encode($data);
		die();
	}
?>
