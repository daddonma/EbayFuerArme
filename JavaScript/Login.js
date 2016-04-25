/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    $('#suchfeld_beschreibung').hide();
	
	$('#authFail').hide();
	
	$('#login').click(function() {
	
		var pw = document.getElementById("pw").value;
		var username = document.getElementById("username").value;
		
		var data = "pw="+pw+"&username="+username;
		
                $.ajax({
                url: 'ajax_login.php',
				data: data,
                success: function(data) 
                {
                    if(data == false) {
			$('#authFail').show();			
                    } else {
                        $('#authFail').hide();
				location.href= "Home.php";
                    }
						
                },
				type: 'POST'
            });
	});	

	$('#pw').keypress(function(e) {
		 if(e.which == 13){
			$('#login').click();
		 }
	});
        
        


});