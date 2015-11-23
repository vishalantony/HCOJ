<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	header("Location: index.php");
	die();
}
include("includes/global_values.inc.php");
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
          <li class="selected"><a href="index.php">Home</a></li>
          <li><a href="contests.php">Contests</a></li>
          <li><a href="problems.php">Problems</a></li>
          <li><a href="contact.php">About & Contact Us</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
	
	
	
	
    <div id="site_content">
      <div class="sidebar">
        <!-- insert your sidebar items here -->
		 <!--  -->
		  <!-- put clock and date here -->
		   <!--  -->
		   <!--  -->
		  <!-- put clock and date here -->
		   <!--  -->
      </div>
	  
	  
	  
      <div id="content">
        <!-- insert the page content here -->
		
		<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
			<tr>
			<th>Problem Code</th>
			<th>Name</th>
			<th>Status</th>
			</tr><!-- Table Header -->
			
			<?php
			include('includes/config.inc.php');
			$query = "SELECT * FROM normal_problems;";
			$result = mysqli_query($db, $query);
			if(!$result) {
				die("hypercube faced some internal error. try later");
			}
			while($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td><a href="display_problem.php?pid='.$row['prob_id'].'">'.$row['prob_code'].'</a></td>';
				echo '<td><a href="display_problem.php?pid='.$row['prob_id'].'">'.$row['prob_name'].'</a></td>';
				$query = 'SELECT * from normal_sub where username ="'.$_SESSION['username'].'" and 
				prob_id = '.$row['prob_id'].' and status="AC";';
				$res = mysqli_query($db, $query);
				if(!$res) {
					die("hypercube faced some internal error. try later");
				}
				if(mysqli_num_rows($res) >= 1) {
					echo '<td><span class="glyphicon glyphicon-ok" style="color:green"></span></td>';
				}
				else {
					echo '<td></td>';
				}
				echo '</tr>';
			}
			
			?>
			
			<!--<tr>
			<td><a href="#">1.LPRIME</a></td>
			<td><a href="#">least prime number after N</a></td>
			<td><span class="glyphicon glyphicon-ok" style="color:green"></span></td>
			 </tr><!-- Table Row -->
			 
			<!-- <tr class='even'>
			 <td><a href="#">2.WORDLST</a></td>
			 <td><a href="#">Arrange words in lexicographic way</a></td>
			 <td><span class="glyphicon glyphicon-ok" style="color:green"></span></td>
			 </tr> <!-- Darker Table Row -->
		 
		</table>
    
      </div>
	  
	  
	  
    </div>
	<?php
		mysqli_close($db);
	?>
	
	
	
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; HCOJ | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    </div>
  </div>
</body>
</html>
