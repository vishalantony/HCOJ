<?php

session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1 || $_SESSION['username'] != 'admin') {
	echo "<meta http-equiv='Refresh' content='0; URL=../index.php' />";
	die();
}
include("../includes/global_values.inc.php");
include('../includes/config.inc.php');

?>

<!DOCTYPE HTML>
<html>

<head>
  <title>admin</title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="../style/style.css" title="style" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
  <script src="../javascript/jquery-1.11.3.min.js"></script>
  <script src="../javascript/admin.js"></script>
  
   
</head>

<body>
  <div id="main">
    <div id="header">
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.php"><img src="../style/cube.png" class="logo_colour"></a></h1>
        </div>
      </div>
      <div id="menubar">
        <ul id="menu">
          <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
          <li class="selected"><a href="../profile.php">Profile</a></li>
          <li><a href="../contests.php">Contests</a></li>
          <li><a href="../problems.php">Problems</a></li>
          <li><a href="../contact.php">About & Contact Us</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
    
    <div id="site_content">
	
	
	
      <div class="sidebar">
        <!-- insert your sidebar items here -->
		<!-- insert only the contest code.. so that contest is created -->
		<br>
		<h4 align="center"><strong>Contest Detail</strong></h4>
			<form method="post" action="enter_contest.php" id="" align="right">
				contest name:<input class="search" type="text" id="pname" name="pname" placeholder="enter contest name" >
				<span class="warnings" id="fname">*</span><br>
				start date : <input class="search" type="text" id="startd" name="startd" placeholder="yyyy-mm-dd" ><br>
				start time : <input class="search" type="text" id="startt" name="startt" placeholder="hh:mm:ss" >
				<span class="warnings" id="fname">*</span><br>
				
				end date : <input class="search" type="text" id="endd" name="endd" placeholder="yyyy-mm-dd" ><br>
				end time : <input class="search" type="text" id="endt" name="endt" placeholder="hh:mm:ss" >
				<span class="warnings" id="fname">*</span><br>
				<input type="submit" class="btn" id="submit" name="submit" value="Create">
				<br>
				<span id="messages" class="warnings" ></span>
			</form>
				<table class="tabsmall">
						<tr>
						<th>Contest Code</th>
						<th>Name</th>
						</tr>
							<?php
								include('../includes/config.inc.php');
								$query = "SELECT * FROM contests;";
								$result = mysqli_query($db, $query);
								if(!$result) 
								{
									die("hypercube faced some internal error. try later");
								}
								while($row = mysqli_fetch_assoc($result)) 
								{
									echo '<tr>';
									echo '<td>'.$row['cid'].'</td>';
									echo '<td>'.$row['name'].'</td>';
									echo '</tr>';
								}
							?>
				</table>

			
			
	
      </div>
	  
	  
	  
	  
	  
      
      <div id="content">
        <!-- insert the page content here -->
		
		<div class="mid_left_content">
		
		 <!-- insert user updation content -->
		 
			<h2 id="greeting">Hello Admin!!!</h2>
			<br>
			<h4><strong>Insert Normal Problem</strong></h4>
			<form method="post" action="insert_normal_problem.php" id="" enctype="multipart/form-data">
				<input class="search" type="text" id="pname" name="pname" placeholder="enter problem name">
				<span class="warnings" id="fname">*</span><br>
				<input class="search" type="text" id="pcode" name="pcode" placeholder="enter problem code">
				<span class="warnings" id="fname">*</span><br>
				<p id="testcases">
					<!-- test case file upload -->
				</p>
				<a id="add_test" style="cursor: pointer;">+ add test case</a><br>
				<input class="search" type="file" name="prob">
				<span class="warnings" id="fname">*</span><br>
				<input type="submit" class="btn" id="submit" name="submit" value="Upload">
				<br>
				<span id="messages" class="warnings" ></span>
			</form>
		</div>
		
		
		<div class="mid_right_content">
		
			<h4><strong>Insert contest Problem</strong></h4>
			<form method="post" action="insert_contest_problem.php" id="" enctype="multipart/form-data">
				<input class="search" type="text" id="cid" name="cid" placeholder="enter contest code">
				<span class="warnings" id="fname">*</span><br>
				<input class="search" type="text" id="pname" name="pname" placeholder="enter problem name">
				<span class="warnings" id="fname">*</span><br>
				<input class="search" type="text" id="pcode" name="pcode" placeholder="enter problem code">
				<span class="warnings" id="fname">*</span><br>
				
				<p id="con_testcases">
					<!-- test case file upload -->
				</p>
				<a id="con_add_test" style="cursor: pointer;">+ add test case</a><br>
				
				<input class="search" type="file" name="prob">
				<span class="warnings" id="fname">*</span><br>
				<input type="submit" class="btn" id="submit" name="submit" value="Upload">
				<br>
				<span id="messages" class="warnings" ></span>
			</form>
	  
		</div>
	  
	  
      </div>
    </div>
    
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; HCOJ | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    </div>
  </div>
</body>
</html>
