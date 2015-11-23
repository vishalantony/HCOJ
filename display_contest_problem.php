<?php
session_start();
if(!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
	header("Location: index1.php");
	die();
}
include("includes/global_values.inc.php");
include('includes/config.inc.php');

$contest_id = $_GET['cid'];
$problem_id = $_GET['pid'];
if(empty($contest_id) || empty($problem_id)) {
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

$contest_name = $row['name'];
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

		 <!-- LOOK HERE FOR COUNT DOWN TIMER -->
		 <!-- call the count down script only when the contest starts -->
		 <!-- set the target date to end date of conntest -->
		 <!--  -->
		 
		
	 <h4><strong>Contest Ends in :</strong></h4><br>
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
  /*TargetDate = "12/25/2015 5:00 AM";   set the target date and time here.. format mm/dd/yyyy*/
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
<br><br><br><br>
<p>Return to contest page : <a href=<?php echo '"display_contest.php?cid='.$contest_id.'"' ;?> ><?php echo "$contest_name"?></a>

</p>
      </div>
	  
	  
	  <div id="content">
     
			<div class="ques" style="text-align:justify">
			<?php
				$query = 'SELECT prob_desc FROM contest_problems 
				WHERE prob_id='.mysqli_real_escape_string($db, $problem_id).' and
				cid='.mysqli_real_escape_string($db, $contest_id).';';
				
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
						<form class="up_form" method="post" action="#"  enctype="multipart/form-data">
									<label><h5><strong>Submit Solution:</strong></h5></label><input class="search" type="file" name="ans" title=" " />
									<button type="submit" class="upbtn">Submit</button>	
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
