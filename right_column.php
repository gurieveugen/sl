
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
	$('.right_column .window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.right_column .window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.right_column .window').hide();
	});			
	
});

</script>
<?php if ( get_post_type() == 'wpsc-product'  && is_single() ){ ?>
<?php dynamic_sidebar('product-sidebar'); ?>
<!--<div class="widget widget-blue">
	<img src="http://www.slengineering.com.au/wp-content/themes/sl/images/mark-logo.png" alt="image description">
	<h3>Mark compressors</h3>
	<ul>
		<li><a href="#">MSM Mini</a></li>
		<li><a href="#">MSA</a></li>
		<li><a href="#">MSB</a></li>
		<li><a href="#">MSC</a></li>
		<li><a href="#">MSD</a></li>
		<li><a href="#">Inverter (VSD) 7.5 to 160kW</a></li>
		<li><a href="#">RMD</a></li>
		<li><a href="#">RME</a></li>
		<li><a href="#">RMF</a></li>
		<li><a href="#">Stormy Pro</a></li>
		<li><a href="#">AIRnet</a></li>
		<li><a href="#">Special Applications</a></li>
		<li><a href="#">Aftermarket</a></li>
	</ul>
</div>
<div class="widget widget-green">
	<h3>Digital Tyre INflators</h3>
<ul>
		<li><a href="#">89XDA</a></li>
		<li><a href="#">89TR6</a></li>
		<li><a href="#">89 MDA</a></li>
		<li><a href="#">89XDZ</a></li>
		<li><a href="#">89XDB</a></li>
		<li><a href="#">89MXA</a></li>
		<li><a href="#">89 MDA</a></li>
		<li><a href="#">89TR6</a></li>
	</ul>
</div>
<div class="widget widget-red">
	<img src="http://www.slengineering.com.au/wp-content/themes/sl/images/chicago-logo.jpg" alt="image description">
	<h3>CP compressors</h3>
	<ul>
		<li><a href="#">CPK Series</a></li>
		<li><a href="#">CPA Series</a></li>
		<li><a href="#">CPB Series</a></li>
		<li><a href="#">CPC Series</a></li>
		<li><a href="#">CPD Series</a></li>
		<li><a href="#">CPE Series</a></li>
		<li><a href="#">CPF Series</a></li>
		<li><a href="#">CPG Series</a></li>
		<li><a href="#">CPVR Variable Speed Series</a></li>
		<li><a href="#">CPVS Variable Speed Series</a></li>
		<li><a href="#">CPX Refrigerant Dryer Series</a></li>
		<li><a href="#">Desiccant Dryer Series</a></li>
		<li><a href="#">Piston Compressor Series</a></li>
		<li><a href="#">Line Filter Series</a></li>
	</ul>
</div>-->

<?php } else { ?>
<div class="button_1"><a href=".right_column #dialog" name="modal">Make An Enquiry Here</a></div>
                      <?php 
					  
						$postId = 103;
						$post_d = get_post($postId); 	
					
						echo do_shortcode($post_d->post_content);	
					  
					  ?>
					<div id="mask"></div>
                    
                    
                    <?php
					$id_post=107;
					$post_d = get_post($id_post); 	
					
					echo $post_d->post_content;					
					?>
                    <?php
                    get_sidebar();
                    ?>
                    
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#dialog form .bottom a').attr('href','javascript:void(0)').attr('onclick','jQuery("#mask").click()');
	})
</script>
<?php } ?>