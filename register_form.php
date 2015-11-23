<?php
	$disp = '<h3>Register</h3>
        <form method="post" action="" id="register_form">
      
			<input class="search" type="text" name="fname" id="fname" placeholder="First Name" /><span class="warnings" id="firstname">*</span><br>
			<input class="search" type="text" name="lname" id="lname" placeholder="Last Name" /><span  class="warnings" id="lastname">*</span><br>
			<input class="search" type="text" name="college" id="college" placeholder="College" /><span id="clg" class="warnings" >*</span><br>
            <input class="search" type="text" name="uname" id="uname" placeholder="Username" /><span id="alias" class="warnings" >*</span><br>
            <input class="search" type="email" name="emailbox" id="emailbox" placeholder="Email ID" /><span id="emailid" class="warnings" >*</span><br>
			<input class="search" type="password" name="pwd" id="pwd" placeholder="Password" /><span id="passwd" class="warnings" >*</span><br>
			<input class="search" type="password" name="confpwd" id="confpwd" placeholder="Confirm Password" /><span  class="warnings" id="confpasswd">*</span><br>
			<input type="submit" class="btn" id="register_button" value="Register"> | 
			<a style="cursor: pointer;" id="login_link">Login</a>
			<br>
			<span id="err_success_message" class="warnings" ></span>
         
        </form>';
        echo $disp;
?>
