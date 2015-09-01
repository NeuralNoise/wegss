<?php
$db_username = 'root';
$db_password = '';
$db_name = 'gram';
$db_host = 'localhost';
$items_per_group = 5;
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);


//include("config.php");
$results = $mysqli->query("SELECT COUNT(*) as t_records FROM paginate");
$total_records = $results->fetch_object();
$total_groups = ceil($total_records->t_records/$items_per_group);
$results->close(); 
?>

<script type="text/javascript">
$(document).ready(function() {
	var track_load = 0; //total loaded record group(s)
	var loading  = false; //to prevents multipal ajax loads
	var total_groups = <?php echo $total_groups; ?>; //total record group(s)
	
	$('#results').load("autoload_process.php", {'group_no':track_load}, function() {track_load++;}); //load first group
	
	$(window).scroll(function() { //detect page scroll
		
		if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
		{
			
			if(track_load <= total_groups && loading==false) //there's more data to load
			{
				loading = true; //prevent further ajax loading
				$('.animation_image').show(); //show loading image
				
				//load data from the server using a HTTP POST request
				$.post('autoload_process.php',{'group_no': track_load}, function(data){
									
					$("#results").append(data); //append received data into the element

					//hide loading image
					$('.animation_image').hide(); //hide loading image once data is received
					
					track_load++; //loaded group increment
					loading = false; 
				
				}).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
					
					alert(thrownError); //alert with HTTP error
					$('.animation_image').hide(); //hide loading image
					loading = false;
				
				});
				
			}
		}
	});
});
</script>