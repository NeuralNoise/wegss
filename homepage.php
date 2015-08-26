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

		<nav class="fixnavbarupper" >
		<a href="#" class="navupper">GSS</a>
		</nav>

      <!-- Static navbar -->
      <nav class="fixnavbar" role="navigation">
          <div class="navdiv1">
            <a href="#" class="navdiv1a">GramSwarajSangathan</a>
		    <input type="text" placeholder="find people" class="searchbar">
			  <ul style="display:inline;">
				<li class="liststyle"><img src="img/avatar.png" style="width:40px;height:40px;margin-top:2px;border:2px solid silver;border-radius:3px;"></li>
			  </ul>
			  <ul id="coolMenu">
				<li class="liststyle"><a href="#"><?php echo $name; ?></a></li>
				<li class="liststyle active"><a href="#">Home</a></li>
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
		<div style="margin-left:20px;width:550px;float:left;word-wrap:break-word;background-color:#C1E0F0;border-radius:4px;">
		
			<form action="textpost.php" method="post" enctype="multipart/form-data">
			<p style="font-family:verdana;margin-left:50px;margin-top:20px;color:darkgreen;">Write what is on your mind??</p>
				<input type="textarea" name="status" style="width:400px;height:70px;font-family:verdana;margin-left:50px;border:1px solid grey;border-radius:4px;word-wrap: break-word;" placeholder="put your thought here!"></input>
				<button type="submit" style="background-color:orange;color:darkgreen;margin-left:405px;margin-top:5px;border:1px solid darkorange;border-radius:3px;">Post</button>
			</form>
			<form action="photoupload.php" method="post" enctype="multipart/form-data">
			<p style="font-family:verdana;margin-left:50px;margin-top:20px;color:darkgreen;">Uplaod A Snapshot !!
				<input type="file" name="file"></br>
			</p>	
				<input type="textarea" name="caption" style="width:400px;height:40px;font-family:verdana;margin-left:50px;border:1px solid grey;border-radius:4px;word-wrap: break-word;" placeholder="Say Something about this photo!">
				
				<button type="submit" name="photouploadbtn" style="background-color:orange;color:darkgreen;margin-left:405px;margin-top:5px;border:1px solid darkorange;border-radius:3px;">Post</button>
			</form>
			
			
			<?php    
				
				$photodisplayquery = "select * from photo_post where photo_user_id= '".$user_id."' ORDER BY photo_post_update DESC ";
				$photoresults= mysql_query($photodisplayquery);
				while($row=mysql_fetch_array($photoresults)){
					$size=getimagesize("imagesByUsers/".$row['photo_post_name']);
					$actualwidth=$size['0'];
					$actualheight=$size['1'];
					
					//$ratio=($actualwidth/$actualheight);
					
					$displaywidth  = $actualwidth;
					$displayheight = $actualheight;
					
					if($actualwidth>=401){
						
						//$widthdiff= ($actualwidth-400);
						//$diffpercent= (($widthdiff/$actualwidth)*100);
						
						//$heightdiff= (($diffpercent/100)*$actualheight);
						
						$displaywidth="400";
						$displayheight=($displaywidth*($actualheight/$actualwidth)); 
					
					}
					
				echo '
					<p style="font-family:verdana;margin-left:50px;margin-top:15px;color:darkgreen;font-size:12px;"><a href="#"style="color:darkorange;font-weight:bold;font-size:14px;"> '.$name.' </a> posted an image on '.$row['photo_post_date'].' at '.$row['photo_post_time'].'</p>
					<img  src="imagesByUsers/'.$row['photo_post_name'].'" style="width:'.$displaywidth.'px;height:'.$displayheight.'px;margin-top:5px;margin-bottom:15px;margin-left:50px;border:2px solid grey;border-radius:4px;">
				';
				
				}
				
				
			
			
			
			
			?>
			
			
		</div>
		
		<!-- right div -->
		<div 
		style="width:300px;float:left;word-wrap:break-word;margin-left:20px;background-color:#C1E0F0;border-radius:4px;">
			<p style="margin-left:20px;"><?php echo $user_id; ?></p>
		</div>
	</div>

      
  </body>
</html>
