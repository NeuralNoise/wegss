//join script
$(document).ready(function(){
	$("#joinBtn").click(function(){
		var email = 	$("#inputEmail").val();
		var phone = 	$("#phone").val();
		var password = 	$("#inputpassword").val();
		var name= 		$("#name").val();
		var city=    	$("#city").val();
		var country=	$("#country").val();
		var data="email="+email+"&phone="+phone+"&password="+password+"&name="+name+"&city="+city+"&country="+country;
		
		if(email && phone && password && name && city && country) {
		
			$.ajax({
				url: "index.php",
				type: "post",
				data: data,
				success: function(result){
					if(result==='success'){
					$("#signup").hide();
					$("#login").show();
					$("#successmsg").show();
					
					}
					if(result==='email exist'){
						$('#mailwarning').html('email already registered');
					}
					if(result==='phone exist'){
						$('#alertmsg').html('Phone already registered');
						$('#mailwarning').html('');
					}
				}
			
			
			});
		}		
	});
});

//login script
$(document).ready(function(){
	$("#logBtn").click(function(){
		var logemail = 	$("#inputEmaillogin").val();
		var logpassword = 	$("#inputPasswordlogin").val();
		var data="logemail="+logemail+"&logpassword="+logpassword;
		
		if(logemail && logpassword) {
			$.ajax({
				url: "index.php",
				type: "post",
				data: data,
				success: function(result){
					if(result==='unsuccessful'){
					
						$('#failwarning').html('Email or Password incorrect.');
					}
					if(result==='successful'){
						window.location = 'homepage.php';
					}
					
				}
			
			
			});
		}
								
	});
});



	
	$(document).ready(function(){
			$("#signup").hide();
			$("#joinus").click(function()
			{
					$("#login").hide();
					$("#successmsg").hide();
					$("#signup").show();
			});
		});
	

	//email scripts
	$(document).ready(function(){
		$('#inputEmail').blur(function(event) {
				if($("#inputEmail").val()==''){
					$("#mailwarning").html('');
				}
		
		
		});
	});
	
	//phone no. validation	
		$(document).ready(function(){
		$('#phone').blur(function(event) {
		
			
				
				var phone = $("#phone").val();
				var pattern = /^\d{10}$/;
				if (pattern.test(phone) ){
					$("#alertmsg").html('');
					return true;
					
				} 
				else if(phone == '') 
				{
					$("#alertmsg").html('');
											
				}else{
					$("#alertmsg").html('');
					$("#alertmsg").append("The Phone Number is invalid. ");
					//$("#phone").val('');
				}
					
		});		
    });
	
	//password validation
	
		$(document).ready(function() {
		$('#joinBtn').click(function(event){
		if($('#email').val()!='' && $('#phone').val()!=''  ){
			data = $('#inputpassword').val();
			data2 = $("#confirmpassword").val();
			
			if(data  && data2 ){
				
				if( data != data2 ) {
				$("#pwdmsg").html('');
				$("#pwdnotmatch").html("Password and Confirm Password do not match.");
				$("#confirmpassword").val('');
				// Prevent form submission
				event.preventDefault();
				}
				else if(data == data2){
					$("#pwdmsg").html('');
					$("#pwdnotmatch").html('');
				}
				
			}

		}	
			
         
		});
		
	});
	
	function clearingForm() {
    document.getElementById("joinform").reset();
	$("#mailwarning").html('');
	$("#alertmsg").html('');
	$("#pwdmsg").html('');
	$("#pwdnotmatch").html('');
	
	
	}
	