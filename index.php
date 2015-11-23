<?php
session_start();
include('includes/global_values.inc.php');
if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
	header('Location: profile.php');
	die();
}

if($_SESSION['username'] == 'admin') {
	header('Location: admin/admin.php');
	die();
}
	
?>
<!DOCTYPE HTML>
<html>

<head>
  <title><?php echo $title; ?></title>
  <meta name="description" content="competitive programming judge" />
  <meta name="keywords" content="programming, competitive programming, uvce, online judge" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="bootstrap/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
  <script src="javascript/jquery-1.11.3.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
  <!--<script src="javascript/form-process.js"></script>-->
  <script src="javascript/form_process.js"></script>  
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php"><img src="style/cube.png" class="logo_colour"></a></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="contests.php">Contests</a></li>
          <li><a href="problems.php">Problems</a></li>
          <li><a href="contact.php">About & Contact Us</a></li>
          <li><a href="#"></a></li>
        </ul>
      </div>
    </div>
    <div id="site_content">
      <div class="sidebar" id="login_or_register">
        <!-- insert your sidebar items here -->
        <h3>Log in</h3>
        <form method="post" action="" id="login_form">
          <p>
            <input class="search" type="text" id="username" placeholder="User Name" /><br>
			<input class="search" type="password" id="password" placeholder="Password" /><br>
			<input type="submit" class="btn" id="login_button" value="Login"> | 
			<a style="cursor: pointer;" id="register_link">Register</a>
			<br>
			<span  class="warnings" id="error_messages"></span>
          </p>
        </form>
      </div>
      <div id="content">
        <!-- insert the page content here -->
        <h1>Welcome to the HyperCube Online Judge</h1>
        <p>Welcome to the competitive programming platform developed by competitive programming 
        enthusiasts for competitive programming
        enthusiasts.<br> <b>Good luck and have fun!</b>
		</p>
		<!--<div id="registerDiv">
		<p>Haven't yet registered? <a style="cursor: pointer;" id="register_link">Register here</a>.</p>
		</div> -->
		
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; HCOJ | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    </div>
  </div>
</body>
</html>
