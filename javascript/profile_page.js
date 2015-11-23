$(document).ready(function() {
	
$('#update_form').submit(function(event) {
	// stop the form from submitting the normal way and refreshing the page
	event.preventDefault();
});


$(document).on('click', "#update", function() {
	//$("span").empty();
	  var fname = $("input#firstname").val();
  	  var lname = $("input#lastname").val();
  	  var college = $("input#college").val();
  	  var username = $("input#username").val();
  	  var emailbox = $("input#emailid").val();
  	  var pwd = $("input#password").val();
  	  var confpwd = $("input#confpassword").val();
  	  var update = $("input#update").val();
  	  var f = true;
		
      if(pwd != "" && pwd != confpwd) {
			f = false;
			$("input#confpassword").focus();
			$("span#cpwd").empty();
			$("span#cpwd").append("**passwords don't match.");
		}
      
      if(!f) {
        return false;
	  }/*
	  if(update_vals.length == 0) {
		  $("#messages").empty().append("values updates successfully.");
		  return false;
	  }*/
	  
	  var formData = {
		  'fname' : fname,
		  'lname' : lname,
		  'college' : college,
		  'emailbox' : emailbox,
		  'username' : username,
		  'pwd' : pwd,
		  'confpwd' : confpwd,
		  'update' : update
	  };
	  
	  $.ajax({
		type : "POST",
		url : "update.php",
		data : formData,
		dataType : 'json',
		encode : true,
		success : function(data) {
			if(data.success == false) {
				$("#messages").empty().append(data.error);
			}
			else {	 
				$("input#firstname").val(fname);
				$("input#lastname").val(lname);
				$("input#college").val(college);
				$("input#username").val(username);
				$("input#emailid").val(emailbox);
				$("input#password").val('');
				$("input#confpassword").val('');
				$("h1#greeting").empty().append("Hello "+fname+" "+lname+"!");
				$("span#cpwd").empty().append("*");
				$("#messages").empty().append("user details successfully updated.");
				
			}
		}
	});
	return false;
});
});
