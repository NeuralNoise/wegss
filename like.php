<?php
require_once("include/dbconfig.php");
session_start(); // Don't forget this on each page that uses sessions
$user_id = $_SESSION["user_id"];

		date_default_timezone_set('Asia/Calcutta');
		// Then call the date functions
		$date = date('Y-m-d');
		$time = date('h:i:s');
if(isset($_POST['post_id'])){
$post_id = $_POST['post_id'];
			
			$likeexistquery = "select * from `like` where like_by_id=".$user_id." && like_post_id=".$post_id;
			$likeexistresult = mysql_query($likeexistquery);	
			if(mysql_num_rows($likeexistresult) < 1 ){
				$newlikequery = "INSERT INTO `like`(`like_post_id`, `like_by_id`, `like_date`, `like_time`) VALUES ($post_id, $user_id, '$date', '$time')";
				mysql_query($newlikequery);
				}
				
				$countlikequery = "select * from `like` where like_post_id=".$post_id;
				$result = mysql_query($countlikequery);
				
				$numResults = mysql_num_rows($result);
				if($numResults > 0){
				echo $numResults;
				}
			}	

?>