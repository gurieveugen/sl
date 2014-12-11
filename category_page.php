<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

Template Name: Category page
 */



get_header(); ?>

<?php
//die('jj');
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

                        

                        <div class="box_4">

	<div class="title">&nbsp;</div>

                            <div class="content">

                             <?php

					$id_post=139;

					$post_l = get_post($id_post); 	

$data_l=					get_post_meta($id_post,"Banner image");

	

				 ?><a href="<?php echo get_permalink($id_post);?>" target="_blank"><img src="<?php echo $data_l[0];?>"  alt="Banner"/>	</a>				

					<br />

                            </div>

                        </div>

                        

                        

                        

                        

                    	

                    </div>

                    <div class="column_2">

                  <h3>  <?php

					the_title();

					?>



</h3>                  <div style="width:663px;"> <?php  the_content(); ?></div>


<?php
$custom_option=get_post_meta(get_the_ID(),"Plan");
echo $custom_option[0];

?>

                  
                <?php
                                    if($_POST['do']=='send'){}
?>



			  

			  
                  
                  
                    </div>

                </div>

                

            </div>

        </div>



<?php //get_sidebar(); ?>



<?php get_footer(); ?>

