<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

Template Name: Category page
 */

add_theme_support( 'post-thumbnails' );
global $wp_query;
get_header(); ?>

<?php

$categ = get_query_var('cat');




?>

	<div class="main">

            <div class="container">

				<div class="left_column removeDot">



  


  


                                	<?php


$the_query = new WP_Query( 'cat='.$categ);

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<div class="postContainer">
	<div class="imageContainer">
		<?php echo do_shortcode('[cft key="Post Image" image_size="thumbnail"]'); ?>
	</div>
	
	<div class="textContainer">
		<div class="titleContainer"><a href="<?php the_permalink();?>"><?php the_title(); ?> </a></div>
		<div class="smallTextContainer"><?php the_excerpt(); ?><a href="<?php echo the_permalink();?>">Read more...</a></div>
	</div>
</div>	
<?php 
endwhile;

// Reset Post Data
wp_reset_postdata();


?>








                </div>
                <div class="right_column">

                	<?php  include("right_column.php");?>

                </div>
                

            </div>

        </div>



<?php //get_sidebar(); ?>



<?php get_footer(); ?>

