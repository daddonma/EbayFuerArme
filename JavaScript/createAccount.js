$(document).ready(function(){
  
	$('#userExists').hide();
        $('#userSuccess').hide();
        
	$('#create').click(function() {
	
		var pw = document.getElementById("newPW").value;
		var username = document.getElementById("newUsername").value;
		
		var data = "pw="+pw+"&username="+username;
		
                $.ajax({
                url: 'Ajax/ajax_create_account.php',
		data: data,
                success: function(data) 
                { 
                   
                    if(data == "false") {
                      
			$('#userExists').show();  
                        $('#userSuccess').hide();
                    } else {
                      
                        $('#userExists').hide();
                        $('.container-fluid').hide();
                         $('#userSuccess').show();
                    }
						
                },
		type: 'POST'
            });
	});
        
        $('#newPW').keypress(function(e) {
		 if(e.which == 13){
			$('#create').click();
		 }
	});
});