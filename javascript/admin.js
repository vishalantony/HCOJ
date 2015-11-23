$(document).ready(function() {
	var i = 0, j = 0;
    $(document).on('click', "#add_test", function() {
        $("#testcases").append('input file'+i+': <input type="file" name="input'+i+'"><br>output file'+i+': <input type="file" name="output'+i+'"><br><hr>');
        i = i+1;
    });  
    
    
    $(document).on('click', "#con_add_test", function() {
        $("#con_testcases").append('input file'+j+': <input type="file" name="con_input'+j+'"><br>output file'+j+': <input type="file" name="con_output'+j+'"><br><hr>');
        j = j+1;
    }); 

});
