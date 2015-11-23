<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	echo "<meta http-equiv='Refresh' content='0; URL=index.php' />";
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
     
			<div class="ques" style="text-align:justify">
			<?php
				$p_id = $_GET['pid'];
				if(isset($_GET['verdict'])) {
					$verdict = $_GET['verdict'];
				}
				if(empty($p_id)) 
					$p_id = 1;
				include('includes/config.inc.php');
				$query = 'SELECT * FROM normal_problems 
				WHERE prob_id='.mysqli_real_escape_string($db, $p_id).';';
				$result = mysqli_query($db, $query);
				if(mysqli_connect_errno()) {
					die("hypercube faced some internal error. Please try after sometime.");
				}
				if(mysqli_num_rows($result) == 0) {
					echo "Invalid problem ID.";
				}
				else {
					$row = mysqli_fetch_assoc($result);
					//echo $row['prob_desc'];
					readfile($row['prob_desc']) or print("problem unavailable at the moment.");
				}
				mysqli_free_result($result);
			mysqli_close($db);
			?>
			</div>
					<form class="up_form" method="post" action="process_normal_sub.php"  class="role" enctype="multipart/form-data">
									<label><h5><strong>Submit Solution:
									
									</strong></h5></label><input class="search" type="file" name="ans">
									<label><?php echo $row['prob_code']; ?></label>
									<input class="search" type="text" name="pid" value=<?php echo '"'.$row['prob_id'].'"'; ?> >
									<input type="submit" class="upbtn" value="Submit" name="upload_file">	
									<br>
									<span id="verdict">
									<?php
									
									if(!empty($verdict)) {
										if($verdict == 'TLE')
											echo "time limit exceeded";
										else if($verdict == 'WA')
											echo "wrong answer";
										else if($verdict == 'AC')
											echo "Accepted";
										else if($verdict == 'CLE')
											echo "Compilation error";
										else
											echo "Invalid file type";
									}
									?>
									</span>
					</form>
					
		
  
	  </div>
	  
	  
    </div>
	
	
	
	
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; HCOJ | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    </div>
  </div>
</body>
</html>
