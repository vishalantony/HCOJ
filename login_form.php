<?php
	$disp = '<h3>Log in</h3>
        <form method="post" action="" id="login_form">
          <p>
            <input class="search" type="text" id="username" placeholder="User Name" /><br>
			<input class="search" type="password" id="password" placeholder="Password" /><br>
			<input type="submit" class="btn" id="login_button" value="Login"> | 
			<a style="cursor: pointer;" id="register_link">Register</a>
			<br>
			<span class="warnings" id="error_messages"></span>
          </p>
        </form>';
	echo $disp;
?>
