<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	echo "<meta http-equiv='Refresh' content='0; URL=index.php' />";
	die();
}

if($_SESSION['username'] == 'admin') {
	header('Location: admin/admin.php');
	die();
}

include("includes/global_values.inc.php");
include('includes/config.inc.php');
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
  <script src="javascript/jquery-1.11.3.min.js"></script>
  <script src="javascript/form_process.js"></script>
  <script src="javascript/profile_page.js"></script>
  <script>
   function startTime() {
     document.getElementById('date_time').innerHTML = Date();
      var t = setTimeout(startTime, 500);
}
   </script>
   
</head>

<body onload="startTime()">
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
		<br>
		<h4 align="center"><strong>Current Server Time</strong></h4>
		<br>
		
		<div align="center">
	
		<!-- side bar JS for clock. -->
       <canvas id="canvas" width="200" height="200" style="background-color:#FFF">
		</canvas>
		
			<script>
			var canvas = document.getElementById("canvas");
			var ctx = canvas.getContext("2d");
			var radius = canvas.height / 2;
			ctx.translate(radius, radius);
			radius = radius * 0.90
			setInterval(drawClock, 1000);

			function drawClock() {
			  drawFace(ctx, radius);
			  drawNumbers(ctx, radius);
			  drawTime(ctx, radius);
			}

			function drawFace(ctx, radius) {
			  var grad;
			  ctx.beginPath();
			  ctx.arc(0, 0, radius, 0, 2*Math.PI);
			  ctx.fillStyle = 'white';
			  ctx.fill();
			  grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
			  grad.addColorStop(0, '#333');
			  grad.addColorStop(0.5, 'white');
			  grad.addColorStop(1, '#333');
			  ctx.strokeStyle = grad;
			  ctx.lineWidth = radius*0.1;
			  ctx.stroke();
			  ctx.beginPath();
			  ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
			  ctx.fillStyle = '#333';
			  ctx.fill();
			}

			function drawNumbers(ctx, radius) {
			  var ang;
			  var num;
			  ctx.font = radius*0.15 + "px arial";
			  ctx.textBaseline="middle";
			  ctx.textAlign="center";
			  for(num = 1; num < 13; num++){
				ang = num * Math.PI / 6;
				ctx.rotate(ang);
				ctx.translate(0, -radius*0.85);
				ctx.rotate(-ang);
				ctx.fillText(num.toString(), 0, 0);
				ctx.rotate(ang);
				ctx.translate(0, radius*0.85);
				ctx.rotate(-ang);
			  }
			}

			function drawTime(ctx, radius){
				var now = new Date();
				var hour = now.getHours();
				var minute = now.getMinutes();
				var second = now.getSeconds();
				//var hour = <?php echo date("g"); ?>;
				//var minute = <?php echo date("i"); ?>;
				//var second = <?php echo date("s"); ?>;
				//hour
				hour=hour%12;
				hour=(hour*Math.PI/6)+
				(minute*Math.PI/(6*60))+
				(second*Math.PI/(360*60));
				drawHand(ctx, hour, radius*0.5, radius*0.07);
				//minute
				minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
				drawHand(ctx, minute, radius*0.8, radius*0.07);
				// second
				second=(second*Math.PI/30);
				drawHand(ctx, second, radius*0.9, radius*0.02);
			}

			function drawHand(ctx, pos, length, width) {
				ctx.beginPath();
				ctx.lineWidth = width;
				ctx.lineCap = "round";
				ctx.moveTo(0,0);
				ctx.rotate(pos);
				ctx.lineTo(0, -length);
				ctx.stroke();
				ctx.rotate(-pos);
			}
			</script>

		</div>
		
		<!-- side bar JS for date -->
		<h4 align="center">Date:
		<script>
			var today = new Date();
			var dd = today.getDate();
			var mm = today.getMonth()+1;
			var yyyy = today.getFullYear();
			if(dd<10) {
				dd='0'+dd
			} 
			if(mm<10) {
				mm='0'+mm
			} 
			today = dd+'/'+mm+'/'+yyyy;
			document.write(today);
		</script>
		</h4>
		  <hr>
      </div>
	  
	  
	  
	  
	  
      
      <div id="content">
        <!-- insert the page content here -->
		
		<div class="mid_left_content">
		
		 <!-- insert user updation content -->
		 
			<h2 id="greeting">Hello <?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?>!</h2>
			<form method="post" action="" id="update_form">
				<input class="search" type="text" id="firstname" name="firstname" value=<?php echo '"'.$_SESSION['fname'].'"';?> placeholder="first name">
				<span class="warnings" id="fname">*</span><br>
				<input class="search" type="text" id="lastname" name="lastname" value=<?php echo '"'.$_SESSION['lname'].'"'; ?> placeholder="last name">
				<span class="warnings" id="lname">*</span><br>
				<input class="search" type="text" id="username" name="username" value=<?php echo '"'.$_SESSION['username'].'"'; ?> placeholder="username">
				<span class="warnings" id="uname">*</span><br>			
				<input class="search" type="text" id="emailid" name="emailid" value=<?php echo '"'.$_SESSION['emailid'].'"'; ?> placeholder="Email address">
				<span class="warnings" id="email">*</span><br>
				<input class="search" type="text" id="college" name="college" value=<?php echo '"'.$_SESSION['college'].'"'; ?> placeholder="College">
				<span class="warnings" id="clg">*</span><br>
				<input class="search" type="password" id="password" name="password" value="" placeholder="password">
				<span class="warnings" id="pwd">*</span><br>
				<input class="search" type="password" id="confpassword" name="confpassword" value="" placeholder="confirm password">
				<span class="warnings" id="cpwd">*</span><br>
				<input type="submit" class="btn" id="update" name="update" value="Update">
				<br>
				<span id="messages" class="warnings" ></span>
			</form>
		</div>
		
		<div class="mid_right_content">
		
		<!-- insert problems solved by user here -->
			<h4 ><strong>User Statistics</strong></h4>
	  <p>
	 
	  <?php 
	  $total_problems = 0;
	  $total_correct_submissions = 0;
	  $total_submissions = 0;
	  
	  // contest submissions
	  $query = 'SELECT prob_id, status FROM contest_sub WHERE 
	  username = "'.mysqli_real_escape_string($db, $_SESSION['username']).'";';
	  //echo $query."<br>";
	  
	  $result = mysqli_query($db, $query);
	  if(!$result) {
		  echo "internal error. try later.";
		  die();
	  }
	  $total_submissions += mysqli_num_rows($result);
	  $probs = array();
	  while($row = mysqli_fetch_assoc($result)) {
		  if($row['status'] == 'AC')
			$total_correct_submissions++;
		  if(!$probs[$row['prob_id']]) {
			$total_problems++;
			$probs[$row['prob_id']] = true;
		  }
	  }
	  mysqli_free_result($result);
	  
	  // normal submissions
	  $query = 'SELECT normal_sub.prob_id, status, prob_code FROM normal_sub, normal_problems WHERE 
	  username = "'.mysqli_real_escape_string($db, $_SESSION['username']).'" and 
	  normal_problems.prob_id = normal_sub.prob_id;';
	  
	 // "select normal_sub.prob_id as prob_id, status, prob_code from normal_sub, normal_problems 
	  //where normal_problems.prob_id = normal_sub.prob_id;"
	 // echo $query."<br>";
	  
	  $result = mysqli_query($db, $query);
	  if(!$result) {
		  echo "internal error. try later.";
		  die();
	  }
	  $total_submissions += mysqli_num_rows($result);
	  $probs = array();
	  while($row = mysqli_fetch_assoc($result)) {
		  if($row['status'] == 'AC')
			$total_correct_submissions++;
		  if(!$probs[$row['prob_id']]) {
			$total_problems++;
			$probs[$row['prob_id']] = $row['prob_code'];
		  }
	  }
	  mysqli_free_result($result);
	  
	  // display statistics
	  if($total_submissions == 0)
		$acceptance_ratio  = 0;
	  else 
        $acceptance_ratio = 1.0*$total_correct_submissions/$total_submissions;
	  echo "Total problems solved: $total_problems<br>";
	  echo "Total submissions: $total_submissions<br>";
	  echo "Total correct submissions: $total_correct_submissions<br>";
	  echo "Acceptance ratio: ".round($acceptance_ratio,2)."<br>";
	  ?>
	  <br>List of normal problems solved:<br>
	  <?php
			foreach($probs as $key => $value) {
				echo '<a href = "display_problem.php?pid='.$key.'">'.$value.'</a> ';
			}
	  ?>
	  <!-- <a href = "abc.com/ip">SOME PROBLEM</a> -->
	  
	  </p>
	  <hr>
	  <p>
	  <a href="getsubmissions.php">Submissions</a>
	  </p>
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
