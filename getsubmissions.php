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
<!DOCTYPE HTML>
<html>

<head>
  <title><?php echo $title; ?></title>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="bootstrap/jquery.min.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
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
		  <?php 
			  if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) 
			  {
						echo '<li class="selected"><a href="index.php">Profile</a></li>';
			  }	
			  else
			  {
				  echo '<li class="selected"><a href="index.php">Home</a></li>';
			  }
						
				
		  ?>
          <li><a href="contests.php">Contests</a></li>
          <li><a href="problems.php">Problems</a></li>
          <li><a href="contact.php">About & Contact Us</a></li>
          <?php  
				if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) 
				{
					echo '<li><a href="logout.php">Logout</a></li>';
				} 
				
		  ?>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
	
	
	
      <div class="sidebar">
	 <!-- insert sidebar content here -->
      </div>
	  
	  
	   
      <div id="content">
        <!-- insert the page content here -->

	<h2>My Submissions</h2>
		<table class="tabsmall">

			<tr>
			<th>problem code</th>
			<th>status</th>
			<th>submission time</th>
			<th>source code</th>
			</tr>
			
			<?php
					while($row = mysqli_fetch_assoc($result)) 
				{
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
		
		
		
		
        
      </div>
	  
	  
	  
	  
	  
	  
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; black &amp; white | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    </div>
  </div>
  
  

  
  
</body>
</html>
