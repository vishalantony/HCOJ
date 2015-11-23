$(document).ready(function() {
	
    $(document).on('click', "#register_link, #login_link", function() {
        $("#login_or_register")
            .empty()
            .load($(this).is('#register_link') ? "register_form.php" : "login_form.php");
    });
		
	
	 $('#register_form').submit(function(event) {
	// stop the form from submitting the normal way and refreshing the page
	event.preventDefault();
});

$('#login_form').submit(function(event) {
	// stop the form from submitting the normal way and refreshing the page
	event.preventDefault();
});



$(document).on('click', "#register_button", function() {
	$("span").empty();
	  var fname = $("input#fname").val();
  	  var lname = $("input#lname").val();
  	  var college = $("input#college").val();
  	  var username = $("input#uname").val();
  	  var emailbox = $("input#emailbox").val();
  	  var pwd = $("input#pwd").val();
  	  var confpwd = $("input#confpwd").val();
  	  var register = $("input#register_button").val();
  	  var f = true;
  	  
  	  
		if(confpwd != pwd) {
			f = false;
			$("input#confpwd").focus();
			$("span#confpasswd").empty();
			$("span#confpasswd").append("**passwords don't match.");
		}
		
		if (confpwd == "") {
			f = false;
			$("input#confpwd").focus();
			$("span#confpasswd").empty();
			$("span#confpasswd").append("**Missing Value.");
		}
		if (pwd == "") {
			f = false;
			$("input#pwd").focus();
			$("span#passwd").empty();
			$("span#passwd").append("**Missing Value.");
		}
		if (username == "") {
			f = false;
			$("input#uname").focus();
			$("span#alias").empty();
			$("span#alias").append("**Missing Value.");
		}
		
		if (emailbox == "") {
			f = false;
			$("input#emailbox").focus();
			$("span#emailid").empty();
			$("span#emailid").append("**Missing Value.");
		}
		if (college == "") {
			f = false;
			$("input#college").focus();
			$("span#clg").empty();
			$("span#clg").append("**Missing Value.");
		}
		if (lname == "") {
			f = false;
			$("input#lname").focus();
			$("span#lastname").empty();
			$("span#lastname").append("**Missing Value.");
		}
  		if (fname == "") {
			f = false;
			$("input#fname").focus();
			$("span#firstname").empty();
			$("span#firstname").append("**Missing Value.");
		} 
		
      
      if(!f) {
        return false;
	  }
	  
	  var formData = {
		  'fname' : fname,
		  'lname' : lname,
		  'college' : college,
		  'emailbox' : emailbox,
		  'username' : username,
		  'pwd' : pwd,
		  'confpwd' : confpwd,
		  'register' : register
	  };
	  
	  $.ajax({
		type : "POST",
		url : "register.php",
		data : formData,
		dataType : 'json',
		encode : true,
		success : function(data) {
			if(data.success == false) {
				$("#err_success_message").empty().append(data.error);
			}
			else {			 
				$("input#confpwd").val('');
				$("input#pwd").val('');;
				$("input#fname").val('');
				$("input#lname").val('');
				$("input#college").val('');
				$("input#uname").val('');
				$("input#emailbox").val('');
				$("#err_success_message").empty().append("user successfully registered.");
			}
		}
	});
	return false;
});
		


$(document).on('click', "#login_button", function() {
	 var username = $("input#username").val();
  	 var password = $("input#password").val();
  	 var login = $("input#login_button").val();
  	 var f = true;
	 if (password == "") {
		f = false;
		$("input#password").focus();
		$("#error_messages").empty().append("*Enter your password");
	 }
		if (username == "") {
			f = false;
			$("input#username").focus();
			$("#error_messages").empty().append("*Enter your username");
		}
      
     if(!f) {
        return false;
	 }
	 
	 var formData = {
		"username" : username,
		"password" : password,
		"login" : login 
	 };
	  $.ajax({
		type : "POST",
		url : "login.php",
		data : formData,
		dataType : 'json',
		encode : true,
		success : function(data) {
			if(data.success == false) {
				$("#error_messages").empty().append(data.error);
			}
			else {			 
				window.location.replace("profile.php");
			}
		}
	});
	return false;
});   

});
