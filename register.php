<?php
	session_start();
	header('Content-type: text/html; charset=utf-8');
	include('includes/global_values.inc.php');
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
		echo "<meta http-equiv='Refresh' content='0; URL=profile.php' />";
		die();
	}
	
	if(isset($_POST['register']) && $_POST['register'] == 'Register') {
		$missing = array();
		$data = array();
		
		$fname = (isset($_POST['fname']))?trim($_POST['fname']):"";
		$username = (isset($_POST['username']))?trim($_POST['username']):"";
		$lname = (isset($_POST['lname']))?trim($_POST['lname']):"";
		$emailbox = (isset($_POST['emailbox']))?trim($_POST['emailbox']):"";
		$regpasswd = (isset($_POST['pwd']))?$_POST['pwd']:"";
		$confregpasswd = (isset($_POST['confpwd']))?$_POST['confpwd']:"";
		$college = (isset($_POST['college']))?$_POST['college']:"";
		
		if(empty($fname)) array_push($missing, "fname");
		if(empty($emailbox)) array_push($missing, "emailbox");
		if(empty($regpasswd)) array_push($missing, "regpasswd");
		if(empty($confregpasswd)) array_push($missing, "confregpasswd");
		if(empty($college)) array_push($missing, "college");
		if(empty($username)) array_push($missing, "username");
		if(empty($lname)) array_push($missing, "lname");
		
		$data['success'] = true;
		$data['error'] = "no error";
		
		if(!empty($missing)) {
			$data['success'] = false;
			//data['missing'] = $missing;
			$data['error'] = "missing values";
			//die();
		}
		
		if(strcmp($regpasswd, $confregpasswd) != 0) {
			$data['success'] = false;
			//data['missing'] = $missing;
			$data['error'] = "passwords mismatch";
			//die();
		}
			
		include('includes/config.inc.php');
			
			
		//check whether the username is already registered.
		$query = 'SELECT * FROM users WHERE username = "'.mysqli_real_escape_string($db, $username).'";';
		$result = mysqli_query($db, $query);
		
		if(!$result) {
			die("hypercube faced some internal error. Please try after sometime.");
		}
		
		if(mysqli_num_rows($result) > 0) {
			$data['success'] = false;
			$data['error'] = "username already taken";
			
		}
		mysqli_free_result($result);
			
		$query = 'SELECT * FROM users WHERE emailid = "'.mysqli_real_escape_string($db, $emailbox).'";';
		$result = mysqli_query($db, $query);
		
		if(!$result) {
			die("Hypercube faced some internal error. Please try after sometime.");
		}
		
		if(mysqli_num_rows($result) > 0) {
			$data['success'] = false;
			$data['error'] = "user already exists";
			
		}
		mysqli_free_result($result);
		
		
		if($data['success'] == false) {
			echo json_encode($data);
			die();
		}
		
		
		$mkd1 = 'codes/contest/'.$username;
		$mkd2 = 'codes/normal/'.$username;
		if(!mkdir($mkd1, 0700)) {
			die("cannot create dir");
		}
		if(!mkdir($mkd2, 0700)) {
			die("cannot create dir");
		}
		
				
		$query = 'INSERT INTO users(fname, lname, emailid, user_passwd, username, college) VALUES("'.mysqli_real_escape_string($db, $fname).'", ';
		$query = $query.'"'.mysqli_real_escape_string($db, $lname).'", ';
		$query = $query.'"'.mysqli_real_escape_string($db, $emailbox).'",';
		$query = $query.'PASSWORD("'.mysqli_real_escape_string($db, $regpasswd).'"),';
		$query = $query.'"'.mysqli_real_escape_string($db, $username).'",';
		$query = $query.'"'.mysqli_real_escape_string($db, $college).'");';
			
		$result = mysqli_query($db, $query);
		if(!$result) {
			die("Hypercube faced some internal error. Please try after sometime.");
		}
		
		mysqli_close($db);
		echo json_encode($data);
		die();
	}
	else {
		$data = array();
		$data['success'] = false;
		$data['error'] = "nothing to register";
		echo json_encode($data);
		//header("Location: index.php");
		die();
	}		
?>
