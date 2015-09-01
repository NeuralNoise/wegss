<?php
require_once("include/dbconfig.php");

$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 10;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;

				$photodisplayquery = "select * from post ORDER BY post_update DESC LIMIT $limit OFFSET $offset";
				$photoresults= mysql_query($photodisplayquery);
				while($row=mysql_fetch_array($photoresults)){
					
					$postedByquery  = "select * from users where users_id='".$row['post_user_id']."'";
					$postedByresults= mysql_query($postedByquery);
					$row2=mysql_fetch_array($postedByresults);
					$postedBy = $row2['name'];
				
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
					if($row['photo_post_name']){				
						echo '
						<div id="results" style="border:2px solid silver;border-radius:3px;margin-left:20px;margin-right:20px;margin-top:10px;">	
							<p style="font-family:verdana;margin-left:50px;margin-top:15px;color:darkgreen;font-size:12px;"><a href="#" style="color:darkorange;font-weight:bold;font-size:14px;"> '.$postedBy.' </a> posted an image on '.$row['post_date'].' at '.$row['post_time'].'</p>
							<p style="width:400px;font-family:verdana;margin-left:50px;margin-top:15px;color:black;font-size:12px;word-wrap:break-word;">'.$row['photo_post_caption'].'</p>
							<img  src="imagesByUsers/'.$row['photo_post_name'].'" style="width:'.$displaywidth.'px;height:'.$displayheight.'px;margin-left:50px;border:2px solid grey;border-radius:4px;">
							<p style="margin-left:50px;margin-bottom:0px;"><a href="#" name="likebtn" id="likebtn" style="color:white;font-family:verdana;font-weight:bold;font-size:10px;background-color:darkgreen;padding:3px;border-radius:2px;">LIKE</a>
							<a href="#" style="color:grey;font-size:10px;"> 0likes </a>
							<a href="#" style="color:grey;font-size:10px;"> 0comments</a>
							</p>
							<p style="margin-left:50px;margin-bottom:5px;"><img src="img/avatar.png" style="width:30px;height:30px;border:1px solid silver;border-radius:3px;"><input type="textarea" name="comment" style="width:360px;height:30px;font-family:verdana;position:absolute;margin-left:5px;margin-top:1px;border:1px solid grey;border-radius:2px;word-wrap: break-word;" placeholder="Write Your Comment...."></p>
						</div>	
							
							';
					}
					if($row['status_post']){
						echo '
						<div id="results" style="border:2px solid silver;border-radius:3px;margin-left:20px;margin-right:20px;margin-top:10px;">
							<p style="font-family:verdana;margin-left:50px;margin-top:15px;color:darkgreen;font-size:12px;"><a href="#"style="color:darkorange;font-weight:bold;font-size:14px;"> '.$postedBy.' </a> updated his status on '.$row['post_date'].' at '.$row['post_time'].'</p>
							<p style="width:400px;font-family:verdana;margin-left:50px;margin-top:15px;color:black;font-size:14px;border-radius:2px;word-wrap:break-word;">'.$row['status_post'].'</p>
							<p style="margin-left:50px;margin-bottom:0px;"><a href="#" name="likebtn" id="likebtn" style="color:white;font-family:verdana;font-weight:bold;font-size:10px;background-color:darkgreen;padding:3px;border-radius:2px;">LIKE</a> 
							<a href="#" style="color:grey;font-size:10px;"> 0likes </a>
							<a href="#" style="color:grey;font-size:10px;"> 0comments</a>
							</p>
							<p style="margin-left:50px;margin-bottom:5px;"><img src="img/avatar.png" style="width:30px;height:30px;border:1px solid silver;border-radius:3px;"><textarea name="comment" style="width:360px;height:30px;font-family:verdana;position:absolute;margin-left:5px;margin-top:1px;border:1px solid grey;border-radius:2px;word-wrap: break-word;" placeholder="Write Your Comment...."></textarea></p>
						</div>	
							';
					}	
				}
							
			?>