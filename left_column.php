
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script>

$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
});

</script>

<div class="button_1"><a href="#dialog" name="modal">Make An Enquiry Here</a></div>
                      <?php
							$recent = new WP_Query("cat=6"); while($recent->have_posts()) : $recent->the_post();?>
												<?php the_content(); ?>
							<?php endwhile; ?>
					<div id="mask"></div>
                    
                    
                    <?php
					$id_post=107;
					$post_d = get_post($id_post); 	
					
					echo $post_d->post_content;					
					?>
                    <?php
                    get_sidebar();
                    ?>
                    
