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
	/* $(document).ready(function(){
		$('#inputEmail').blur(function(event) {
				if($("#inputEmail").val()==''){
					$("#mailwarning").html('');
				}
		
		
		});
	}); */
	
	
	//email validation
	$(document).ready(function(){
		$('#inputEmail').blur(function(event) {
		
			
				
				var email = $("#inputEmail").val();
				var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if (pattern.test(email) ){
					$("#mailwarning").html('');
					return true;
					
				} 
				else if(email == '') 
				{
					$("#mailwarning").html('');
											
				}else{
					$("#mailwarning").html('');
					$("#mailwarning").append("The Email is invalid. ");
					$("#inputEmail").val('');
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
					$("#phone").val('');
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
	
	var busy = false;
      var limit = 5;
      var offset = 0;

      function displayRecords(lim, off) {
        $.ajax({
          type: "GET",
          async: false,
          url: "getrecords.php",
          data: "limit=" + lim + "&offset=" + off,
          cache: false,
          beforeSend: function() {
            $("#loader_message").html("").hide();
            $('#loader_image').show();
          },
          success: function(html) {            
			if(html === ''){
				$('#loader_image').hide();
			}else{
				$('#loader_image').show();
				$("#results").append(html);
			}
            window.busy = false;


          }
        });
      }

      $(document).ready(function() {
        // start to load the first set of data
        if (busy == false) {
          busy = true;
          // start to load the first set of data
          displayRecords(limit, offset);
        }


        $(window).scroll(function() {
          // make sure u give the container id of the data to be loaded in.
          if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
            busy = true;
            offset = limit + offset;

            // this is optional just to delay the loading of data
            setTimeout(function() { displayRecords(limit, offset); }, 500);

            // you can remove the above code and can use directly this function
            // displayRecords(limit, offset);

          }
        });

      });	
	
	
	
