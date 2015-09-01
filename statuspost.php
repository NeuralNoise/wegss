<?php
		include("include/dbconfig.php");
				//turn on php error reporting
				error_reporting(E_ALL);
				ini_set('display_errors', 1);
				
				//session
				session_start(); // Don't forget this on each page that uses sessions
				$user_id = $_SESSION["user_id"];
				
				
				date_default_timezone_set('Asia/Calcutta');
				// Then call the date functions
				$date = date('Y-m-d');
				$time = date('h:i:s');
				
				if(isset($_POST['poststatusbtn'])){
				
					$status = $_POST['status'];
					
					$query= "INSERT INTO `post`(`post_user_id`,`status_post`, `post_date`, `post_time`) VALUES ($user_id, '$status', '$date', '$time')";
						mysql_query($query);
						
                        header( 'Location: homepage.php' ) ;				
				}
?>				