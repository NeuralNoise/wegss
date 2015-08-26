<?php
				$servername = "localhost";
				$username = "root";
				$dbpassword = "";
				$dbname = "gram";
				
				$conn = mysql_connect($servername, $username, $dbpassword);
				mysql_select_db($dbname, $conn);
								
				$logemail= 	"jitender.3222@gmail.com";
					$logpassword=	"qwer";
				
					
					$query = "SELECT * FROM users where email='".$logemail."' && password='".$logpassword."'" ;
					
					
					$result = mysql_query($query);
					$numResults = mysql_num_rows($result);
					
					
					
					
					if($numResults>=1){
						$row = mysql_fetch_array($result);
						$user_id = $row['users_id'];
						print_r($row);
						echo $user_id;
						echo "successful";
						//start a session over here
						session_start();
						$_SESSION["user_id"] = $user_id;
						Header("Location: homepage.php");
					}
					else{
						echo "unsuccessful";
						die;
					}
				
				

?>