function newlike(post_id){
		var postid= post_id;
		
		var data="post_id="+postid;
		
				$.ajax({
				url: "like.php",
				type: "post",
				data: data,
				success: function(result){
						$('#'+postid+'').html('');
						$('#'+postid+'').append(''+result+'likes');
					
					
					
				}
			
			
			});
		
								
	}