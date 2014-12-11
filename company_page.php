<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
Template Name: Company page
 */

get_header(); ?>

	<div class="main">
            <div class="container">
				<div class="left_column" style="text-align:justify;">
                	<?php
				the_post();
					the_content();
					?>
                </div>
                <div class="right_column">
                	<?php
					include("right_column.php");
					?>
                </div>
            </div>
        </div>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>
