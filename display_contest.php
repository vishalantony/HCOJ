<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	header("Location: index1.php");
	die();
}
include("includes/global_values.inc.php");
include('includes/config.inc.php');

$contest_id = $_GET['cid'];
if(empty($contest_id)) {
	
	//header("Location: index.php");
	die("empty get");
}

$query = 'SELECT * FROM contests WHERE cid = '.$contest_id.';';
$result = mysqli_query($db, $query);
if(!$result) {
	echo "internal error. try later.";
	die();
}
if(mysqli_num_rows($result) == 0) {
	echo 'Invalid contest id! Contests list: <a href = "contests.php">contests</a>';
	die();
}
$row = mysqli_fetch_assoc($result);
mysqli_free_result($result);

$endtime = $row['end_time'];
$endyear = substr($endtime, 0, 4);
$endmonth = substr($endtime, 5, 2);
$endday = substr($endtime, 8, 2);
$endhour = substr($endtime, 11, 2);
$endmin = substr($endtime, 14, 2);
$pm_am = 'AM';
if($endhour >= 12)
	$pm_am = 'PM';
if($endhour > 12)
	$endhour %= 12;
	
$targetdate = $endmonth.'/'.$endday.'/'.$endyear.' '.$endhour.':'.$endmin.' '.$pm_am;

//TargetDate = "12/25/2015 5:00 AM"

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
          <li class="selected"><a href="index.php">Profile</a></li>
          <li><a href="contests.php">Contests</a></li>
          <li><a href="problems.php">Problems</a></li>
          <li><a href="contact.php">About & Contact Us</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
	
	
	
	
    <div id="site_content">
      <div class="sidebar">
	  
	  
        <!-- LOOK HERE FOR COUNT DOWN TIMER -->
		 <!-- call the count down script only when the contest starts -->
		 <!-- set the target date to end date of conntest -->
		 <!--  -->
		 
		 
		 <h4>Contest Ends in :</h4><br>
		 <script>
		 function calcage(secs, num1, num2) {
  s = ((Math.floor(secs/num1))%num2).toString();
  if (LeadingZero && s.length < 2)
    s = "0" + s;
  return "<b>" + s + "</b>";
}

function CountBack(secs) {
  if (secs < 0) {
    document.getElementById("cntdwn").innerHTML = FinishMessage;
    return;
  }
  DisplayStr = DisplayFormat.replace(/%%D%%/g, calcage(secs,86400,100000));
  DisplayStr = DisplayStr.replace(/%%H%%/g, calcage(secs,3600,24));
  DisplayStr = DisplayStr.replace(/%%M%%/g, calcage(secs,60,60));
  DisplayStr = DisplayStr.replace(/%%S%%/g, calcage(secs,1,60));

  document.getElementById("cntdwn").innerHTML = DisplayStr;
  if (CountActive)
    setTimeout("CountBack(" + (secs+CountStepper) + ")", SetTimeOutPeriod);
}

function putspan(backcolor, forecolor) {
 document.write("<span id='cntdwn' style='background-color:" + backcolor + 
                "; color:" + forecolor + "'></span>");
}

if (typeof(BackColor)=="undefined")
  BackColor = "white";
if (typeof(ForeColor)=="undefined")
  ForeColor= "black";
if (typeof(TargetDate)=="undefined")
	TargetDate = <?php echo '"'.$targetdate.'"'; ?>
	/* TargetDate = "11/21/2015 12:00 AM";  set the target date and time here.. format mm/dd/yyyy*/
  
if (typeof(DisplayFormat)=="undefined")
  DisplayFormat = "%%D%% Days, %%H%% Hours, %%M%% Minutes, %%S%% Seconds.";
if (typeof(CountActive)=="undefined")
  CountActive = true;
if (typeof(FinishMessage)=="undefined")
  FinishMessage = "";
if (typeof(CountStepper)!="number")
  CountStepper = -1;
if (typeof(LeadingZero)=="undefined")
  LeadingZero = true;


CountStepper = Math.ceil(CountStepper);
if (CountStepper == 0)
  CountActive = false;
var SetTimeOutPeriod = (Math.abs(CountStepper)-1)*1000 + 990;
putspan(BackColor, ForeColor);
var dthen = new Date(TargetDate);
var dnow = new Date();
if(CountStepper>0)
  ddiff = new Date(dnow-dthen);
else
  ddiff = new Date(dthen-dnow);
gsecs = Math.floor(ddiff.valueOf()/1000);
CountBack(gsecs);
		 </script>
		 
		 
      </div>
	  
	  <!--  -->
	  <!-- change the 'cid' to the ahref to the content page-->
	  <!--  -->
      <div id="content">
        <h3><?php
			echo "Welcome to ".$row['name']." !!!";
			?>
		</h3>
		
	<div class="tab">
		<table cellspacing='0'> <!-- cellspacing='0' is important, must stay -->
			<tr>
			<th>Problem Code</th>
			<th>Name</th>
			<th>Status</th>
			</tr><!-- Table Header -->
			
			<?php
			include('includes/config.inc.php');
			$query = "SELECT * FROM contest_problems where cid=$contest_id;";
			$result = mysqli_query($db, $query);
			if(!$result) {
				die("hypercube faced some internal error. try later");
			}
			while($row = mysqli_fetch_assoc($result)) {
				echo '<tr>';
				echo '<td><a href="display_contest_problem.php?pid='.$row['prob_id'].'&cid='.$row['cid'].'">'.$row['prob_code'].'</a></td>';
				echo '<td><a href="display_contest_problem.php?pid='.$row['prob_id'].'&cid='.$row['cid'].'">'.$row['prob_name'].'</a></td>';
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
		 
		</table>
		</div>
    
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
