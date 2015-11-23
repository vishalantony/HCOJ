<?php
session_start();
include('includes/global_values.inc.php');
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
          <?php if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1) {
					echo '<li><a href="logout.php">Logout</a></li>';
				} 
		  ?>
        </ul>
      </div>
    </div>
    <div id="content_header"></div>
    <div id="site_content">
      <div class="sidebar">
	  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <div style="overflow:hidden;height:300px;width:300px;">
  <div id="gmap_canvas" style="height:300px;width:300px;"></div>
  </div>
  <script type="text/javascript"> 
  function init_map()
  {
  var myOptions = 
  {zoom:13,center:new google.maps.LatLng(12.9758503,77.5857282),mapTypeId: google.maps.MapTypeId.ROADMAP};
  map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
  marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(12.9758503,77.5857282)});
  infowindow = new google.maps.InfoWindow({content:"<b>UVCE</b><br/>KR Circle<br/> Bangalore-560001" });
  google.maps.event.addListener(marker, "click", 
  function(){infowindow.open(map,marker);
  });
  infowindow.open(map,marker);}
  google.maps.event.addDomListener(window, 'load', init_map);
  </script>
      </div>
	   
      <div id="content">
        <!-- insert the page content here -->
		<h1>About Us</h1>
		
		<p>
			HyperCube Online Judge was started as a college project by <b>Vishal Antony</b> and <b>Shubham Bhuyan</b> of
			Computer Science Department, <b>University Visvesvaraya College of Engineering</b>.
			To learn more, develop and contribute to the source code : <a href="http://www.github.com/hcoj">Click here</a>
		 </p>
        <h1>Contact Us</h1>
        <h4>send us an email</h4>
        <form action="#" method="post">
          <div class="form_settings">
            <p><span>Name</span><input  type="text" name="your_name" value="" /></p>
            <p><span>Email Address</span><input  type="text" name="your_email" value="" /></p>
            <p><span>Message</span><textarea rows="8" cols="50" name="your_enquiry"></textarea></p>
            <p style="padding-top: 15px"><span>&nbsp;</span><input class="submit" type="submit" name="contact_submitted" value="submit" /></p>
          </div>
        </form>
        
      </div>
    </div>
    <div id="content_footer"></div>
    <div id="footer">
      Copyright &copy; black &amp; white | <a href="http://validator.w3.org/check?uri=referer">HTML5</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>
    </div>
  </div>
  
  

  
  
</body>
</html>
