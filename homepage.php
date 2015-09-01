<?php

include("include/dbconfig.php");
session_start(); // Don't forget this on each page that uses sessions
$user_id = $_SESSION["user_id"];

if($user_id == null)
{
 Header("Location: index.php");
}

$query = "SELECT * FROM users where users_id='".$user_id."'" ;
$result = mysql_query($query);

$row = mysql_fetch_array($result);
$name= $row['name'];
$email=$row['email'];
$phone=$row['phone'];
$city=$row['city'];
$country=$row['country'];



?>



<html>
  <head>
    <title><?php echo $name; ?> Home</title>
    <!-- Custom styles for this template -->
	<link rel="icon" href="img/favicon.png"/>
    <link href="css/navbar.css" rel="stylesheet">   
  </head>

  <body>
	<script src="js/jquery.min.js"></script>
	<script src="js/gramcover.js"></script>
	
	
		<nav class="fixnavbarupper" >
		<a href="#" class="navupper">GSS</a>
		</nav>

      <!-- Static navbar -->
      <nav class="fixnavbar" role="navigation">
          <div class="navdiv1">
            <a href="#" class="navdiv1a">GramSwarajSangathan</a>
		    <input type="text" placeholder="find people" class="searchbar">
			<img src="img/avatar.png" style="width:40px;height:40px;margin-top:4px;margin-left:37px;margin-bottom:4px;border:1px solid silver;border-radius:3px;">
			  <ul id="coolMenu" style="display:inline;">
				<li class="liststyle"><a href="#"><?php echo $name; ?></a></li>
				<li class="liststyle"><a href="homepage.php">Home</a></li>
				<li class="liststyle"><a href="#">Account</a>
					<ul style="box-shadow: 2px 2px 10px #bbb;width:150px;">
						<li><a href="#">Settings</a></li>
					
						<li><a href="#">Advertising on we-gss</a></li>
					
						<li><a href="logout.php">Logout</a></li>
					
						<li><a href="#">Help</a></li>
					
						<li><a href="#">Report Problem</a></li>
					</ul>
				</li>
			  </ul>
		  </div>   
      </nav>
	  
	<div style="float:left;position:relative;top:100px;width:1100px;margin-left:100px;">
		
		<!-- left div -->
		<div style="width:150px;float:left;word-wrap: break-word;">
			<label style="margin-top:20px;float:left;">
				<img  src="img/avatar.png" style="width:70px;height:70px;border:2px solid grey;border-radius:4px;position:relative;"></br></br>
				<a href="#" style="font-family:verdana;font-size:12px;color:darkgreen;"><?php echo $name; ?></a></br>
				<a href="#" style="font-family:verdana;font-size:12px;color:darkgreen;"><?php echo $email; ?></a></br>
				<a href="#" style="font-family:verdana;font-size:12px;color:darkgreen;"><?php echo $phone; ?></a></br>
				<a href="#" style="font-family:verdana;font-size:12px;color:darkgreen;"><?php echo $city; ?></a></br>
				<a href="#" style="font-family:verdana;font-size:12px;color:darkgreen;"><?php echo $country; ?></a></br>
			</label>
		<p></p>
		</div>
		
		<!-- middle div -->
		<div style="margin-left:20px;width:550px;float:left;word-wrap:break-word;background-color:#eee;border-radius:4px;">
		
			<form action="statuspost.php" method="post" enctype="multipart/form-data">
			<p style="font-family:verdana;margin-left:50px;margin-top:20px;color:darkgreen;">Write what is on your mind??</p>
				<textarea name="status" style="width:400px;height:70px;font-family:verdana;margin-left:50px;border:1px solid grey;border-radius:4px;word-wrap:break-word;" placeholder="put your thought here!" required></textarea>
				<button type="submit" name="poststatusbtn" style="background-color:orange;color:darkgreen;margin-left:405px;margin-top:5px;border:1px solid darkorange;border-radius:3px;">Post</button>
			</form>
			<form action="photoupload.php" method="post" enctype="multipart/form-data">
			<p style="font-family:verdana;margin-left:50px;margin-top:20px;color:darkgreen;">Uplaod A Snapshot !!
				<input type="file" name="file" required></br>
			</p>	
				<textarea name="caption" style="width:400px;height:40px;font-family:verdana;margin-left:50px;border:1px solid grey;border-radius:4px;word-wrap: break-word;" placeholder="Say Something about this photo!"></textarea>
				
				<button type="submit" name="photouploadbtn" style="background-color:orange;color:darkgreen;margin-left:405px;margin-top:5px;border:1px solid darkorange;border-radius:3px;">Post</button>
			</form>
					
					
					
							<div id="results">	
							</div>	
							<div id="loader_image"><img src="loader.gif" alt="" style="width:24;height:24;display:block;margin-left: auto;margin-right: auto;">
							</div>
			
		</div>
		
		<!-- right div -->
		<div 
		style="width:300px;float:left;word-wrap:break-word;margin-left:20px;background-color:#C1E0F0;border-radius:4px;">
			<p style="margin-left:20px;">Welcome To Gram Swaraj Sangathan</p>
		</div>
	</div>
	
<script type="text/javascript">	
	
</script>	

      
  </body>
</html>
