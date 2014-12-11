<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

Template Name: Category page

 */



get_header(); ?>

<?php

the_post();



?>

<div class="main">

            <div class="container">
					<div class="left_column">

				<?php the_content();?>
</div>
                <div class="right_column">

                	<?php  include("right_column.php");?>

                </div>

            </div>

        </div>



<?php //get_sidebar(); ?>



<?php get_footer(); ?>

