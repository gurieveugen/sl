<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

Template Name: Page With Left Navigation

 */



get_header(); ?>

<?php

the_post();


 $main_categ=$post->post_parent;

	if($post->post_parent==60)
{
		$main_categ=get_the_ID();

}
  $parent_title = get_the_title($main_categ);
  


?>

	<div class="main">

            <div class="container">

				<div class="left_column">

                	<div class="column_1">

                    	<div class="box_4">

                        	<div class="title"><?php echo $parent_title; ?></div>

                            <div class="content">

                            	<ul class="categories">

                                	<?php

									 	wp_list_pages("title_li=&child_of=". $main_categ);

									?>

                                </ul>

                            </div>

                        </div>

                        

                        

                        

                        

                        

                        

                    	

                    </div>

                    <div class="column_2">

                  <h3>  <?php

					the_title();

					?>



</h3>                   <?php  the_content(); ?>


<?php
$custom_option=get_post_meta(get_the_ID(),"Plan");
echo $custom_option[0];

?>

                  
             
	

			  

			  
                  
                  
                    </div>

                </div>

                <div class="right_column">

                	<?php  include("right_column.php");?>

                </div>

            </div>

        </div>



<?php //get_sidebar(); ?>



<?php get_footer(); ?>

