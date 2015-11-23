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
          <li class="selected"><a href="profile.php">Profile</a></li>
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
        <div class="tab">
        <table  cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
		<tr><th>Contest</th><th>Start</th><th>End</th><th>Duration</th></tr><!-- Table Header -->
        
        <?php
			include('includes/config.inc.php');
			$query = 'SELECT * FROM contests order by start_time desc;';
			$result = mysqli_query($db, $query);
			if(mysqli_connect_errno()) {
				die("hypercube faced some internal error. Please try after sometime.");
			}
			while($row = mysqli_fetch_assoc($result)) {
				if(strtotime($row['end_time']) < strtotime(date("y-m-d h:i:s"))) 
					echo '<tr class="even"><td><a href="display_contest.php?cid='.$row['cid'].'">'.$row['name'].'</a></td>';
				else 
					echo '<tr><td><a href="display_contest.php?cid='.$row['cid'].'">'.$row['name'].'</a></td>';
				
				echo '<td>'.$row['start_time'].'</td>';
				echo '<td>'.$row['end_time'].'</td>';
				$datetime1 = new DateTime($row['start_time']);
				$datetime2 = new DateTime($row['end_time']);
				$oDiff = $datetime1->diff($datetime2);
				$f = false;
				echo '<td>';
				if($oDiff->y > 0 || $f) { echo $oDiff->y.' Years '; $f = true; }
				if($oDiff->m > 0 || $f) { echo $oDiff->m.' Months '; $f = true; }
				if($oDiff->d > 0 || $f) { echo $oDiff->d.' Days '; $f = true; }
				if($oDiff->h > 0 || $f) { echo $oDiff->h.' Hours '; $f = true; }
				if($oDiff->i > 0 || $f) { echo $oDiff->i.' Minutes '; $f = true; }
				if($oDiff->s > 0 || $f) { echo $oDiff->s.' Seconds '; $f = true; }
				echo '</td></tr>';
			}
				mysqli_free_result($result);
		mysqli_close($db);
        ?>
        </table>
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
