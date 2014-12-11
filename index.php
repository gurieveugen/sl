<?php



/**



 * @package WordPress



 * @subpackage Default_Theme



Template Name: Home page



 */

get_header(); ?>
	<div class="main">

      <div class="container" style="padding-bottom:0;">
        
        <div class="colLeft1">
        <?php 	
			$home_page_id=1;
			$home_page = get_post($home_page_id); 
			echo $home_page->post_content; 
		 ?>
 <div class="clear"><!-- --></div>
        <div class="banner2">
        <div class="banner2Holder"><?php include (ABSPATH . '/wp-content/plugins/wp-slideshow/slideshow.php');?>

        </div></div></div>
<div class="colRight1">
        <div class="titleColRight1"> <span class="s36Grey">Talk to the</span><br />
        							 <span class="s45Blue">Air<br /> Compressor</span>
                                     <span class="s45Green">Specialists</span> 
                          
        
       <?php 	
			$home_page_id=760;
			$home_page = get_post($home_page_id); 
			echo $home_page->post_content; 
		 ?>
            
                 
                                     
        </div>
        </div>

</div>
<div class="container" style="padding-top:0px;">
        <div class="ourBrands"> 
                        <?php







$sql="SELECT * FROM wp_hbrands";



$result=mysql_query($sql);



if(mysql_affected_rows()){



	



	while($row=mysql_fetch_array($result)){



	



?>



<a href="<?php  if (eregi("^s?https?:\/\/[-_.!~*'()a-zA-Z0-9;\/?:\@&=+\$,%#]+$", $row['link'])) echo $row['link'];?>" ><img src="<?php echo $row['picture']; ?>" alt="<?php echo $row['alt']; ?>" /></a>







<?php



}



}







?>


           </div>
      
    </div>
</div>

<?php get_footer(); ?>



