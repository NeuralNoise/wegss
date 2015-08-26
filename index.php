<?php
				//require("include/dbconfig.php");
				$servername = "localhost";
				$username = "root";
				$dbpassword = "";
				$dbname = "gram";
				
				// Create connection
				$conn = mysql_connect($servername, $username, $dbpassword);
				mysql_select_db($dbname, $conn); 
				
				//signup Script
				if(isset($_POST['email']))
				{
					$email= 	$_POST['email'];
					$phone= 	$_POST['phone'];
					$password=	$_POST['password'];
					$name= 		$_POST['name'];
					$city= 		$_POST['city'];
					$country= 	$_POST['country'];
				
					
					$sql1 = "INSERT INTO users(`email`, `phone`, `password`, `name`, `city`, `country`) VALUES ('$email', '$phone', '$password', '$name', '$city', '$country')";
					$query = "SELECT email FROM users where email='".$email."'";
					$query1 = "SELECT phone FROM users where phone='".$phone."'";
					
					$result = mysql_query($query);
					$numResults = mysql_num_rows($result);
					
					$result1 = mysql_query($query1);
					$numResults1 = mysql_num_rows($result1);
					
					
					if($numResults>=1){
						echo "email exist";
						die;
					}
					else if($numResults1>=1){
						echo "phone exist";
						die;
					}
					else{
						mysql_query($sql1);
						echo "success";
						die;
						//header("Location:signuplanding.php");	
				
						//exit;
					}
				
				}
				
				//login Script
				if(isset($_POST['logpassword']))
				{
					$logemail= 	$_POST['logemail'];
					$logpassword=	$_POST['logpassword'];
				
					
					$query = "SELECT * FROM users where email='".$logemail."' && password='".$logpassword."'" ;
					
					
					$result = mysql_query($query);
					$numResults = mysql_num_rows($result);
					$outputarray= mysql_fetch_array($result);
					
					
					
					if($numResults>=1){
						$user_id = $outputarray['users_id'];
						session_start(); // Don't forget this on each page that uses sessions
						$_SESSION["user_id"]= $user_id;
						echo "successful";
						die;
					}
					else{
						echo "unsuccessful";
						die;
					}
				
				}






?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.png"/>

    <title>ग्राम स्वराज संगठन</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/gscover.css" rel="stylesheet">
	<link href="css/signin.css" rel="stylesheet">
	

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    
	<script src="js/jquery.min.js"></script>
	<script>

	</script>
	<script src="js/gramcover.js" >	</script>
    
  </head>

  <body>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="masthead clearfix">
            <div class="inner">
              <h1 class="masthead-brand">ग्राम स्वराज संगठन</h1>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">मुखपृष्ठ</a></li>
                  <li class=""><a href="#">फोटो गेलरी</a></li>
				  <li class=""><a href="#">संपर्क</a></li>
                </ul>
              </nav>
            </div>
          </div>
			
			
			
			<div  id="login" class="inner cover">
				<h1 class="cover-heading">स्वदेशी, शिक्षा, संस्कृति, योग, स्वराज, जागरूकता, प्रेरणा</h1>
				<div id="login2">
					<form class="form-signin" role="form" method= "post" action="javascript:void(0);">
							<p  class="warning" id="failwarning"></p>
							<input type="email"  id="inputEmaillogin" class="form-control" placeholder="Email address" name="loginemail" required autofocus>
							<input type="password"  id="inputPasswordlogin" class="form-control" placeholder="Password" name="loginpassword" required>
							<!--<div class="checkbox" style="text-align:left;">
								<label><input type="checkbox" value="remember-me"> Remember me</label>
							</div>-->
							<button class="btn btn-lg btn-primary btn-block btn-default" id="logBtn" type="submit" >Login</button>
					</form>
				</div> 	
				<p class="lead">
					<a id="joinus" class="btn btn-lg joinbtn" onclick="clearingForm()"> Join Us</a>
				</p>
			</div>
			
			<div id="successmsg"  class="inner cover" style="display:none;color:#eee;">
				<h2>Thanks For Registering with us...! </h2>
			</div>
			
			<div id="signup" style="margin-top:70px;">
				<form class="form-signin" role="form" id="joinform" action="javascript:void(0);" method="post">
						<input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required autofocus>
							<p  class="warning" id="mailwarning"></p>
						<input type="text" id="phone" class="form-control" placeholder="Phone / Mobile" name="phone" required>
							<p  class="warning" id="alertmsg"></p>
						<input type="password" id="inputpassword" class="form-control" placeholder="Password" name="password" required>
							<p  class="warning" id="pwdmsg"></p>
						<input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm Password" required >
							<p  class="warning" id="pwdnotmatch"></p>
						<input type="text" id="name" class="form-control" placeholder="Name"  name="name" required>
						<!--<input type="text" id="bgroup" class="form-control" placeholder="Blood-Group" name="bgroup" required> -->
						<input type="text" id="city" class="form-control" placeholder="City" name="city" required>
						<input type="text" id="country" class="form-control" placeholder="Nationality" name="country" required>
						</br>
					<button class="btn btn-lg btn-primary btn-block btn-default"  id="joinBtn" type="submit" name="join">Join</button>
				</form>
			</div> 
		  
			<div class="mastfoot">
				<div class="inner">
					<p style="color:darkorange;">Gram Swaraj Sangathan</p>
				</div>
			</div>
			
        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>