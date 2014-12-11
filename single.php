<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header();
?>
<div class="main">
            <div class="container">
			<div class="column_1">
					<div class="newLeftColumn box_4">
						<?php
						$categ = get_the_category(); 
						
						?>
						<div  class="title">
							<span><?php echo $categ[0]->name; ?></span>
						</div>
						
						
						<ul  class="categories">
						<?php 
						$recent = new WP_Query(array("cat"=>$categ[0]->term_id, "orderby"=>'date' , 'order'=>'DESC' )); 
						
						$i = 1;
						while($recent->have_posts()) : $recent->the_post();
							?>
								<li>
									<a href="<?php the_permalink();?>"><?php the_title();?></a>
								</li>
						<?php  
						endwhile;
						?>
						
						<?php 
						if(0){
							var_dump($categ);	
							$recent = new WP_Query("cat=6"); 
							while($recent->have_posts()) : $recent->the_post();
								 the_content(); 
							endwhile;
						}
					?>
							</ul>
					</div>
			</div>
			
			
				<div class="left_column" style="text-align:justify;">
                	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php if(0){ ?> 
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
		<?php } ?>

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<h2 style="text-align:center;"><?php the_title(); ?></h2>

			<div class="entry customTable">
				<?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				<?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
				
				<?php if(0){ ?>
				<p class="postmetadata alt">
					<small>
						This entry was posted
						<?php /* This is commented, because it requires a little adjusting sometimes.
							You'll need to download this plugin, and follow the instructions:
							http://binarybonsai.com/wordpress/time-since/ */
							/* $entry_datetime = abs(strtotime($post->post_date) - (60*120)); echo time_since($entry_datetime); echo ' ago'; */ ?>
						on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
						and is filed under <?php the_category(', ') ?>.
						You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.

						<?php if ( comments_open() && pings_open() ) {
							// Both Comments and Pings are open ?>
							You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.

						<?php } elseif ( !comments_open() && pings_open() ) {
							// Only Pings are Open ?>
							Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.

						<?php } elseif ( comments_open() && !pings_open() ) {
							// Comments are open, Pings are not ?>
							You can skip to the end and leave a response. Pinging is currently not allowed.

						<?php } elseif ( !comments_open() && !pings_open() ) {
							// Neither Comments, nor Pings are open ?>
							Both comments and pings are currently closed.

						<?php } edit_post_link('Edit this entry','','.'); ?>

					</small>
				</p>
				<?php } ?>

			</div>
		</div>

	<?php // comments_template(); ?>

	<?php endwhile; else: ?>

		<p>Sorry, no posts matched your criteria.</p>

<?php endif; ?>
		<div class="navigation">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
                </div>

				
				
				<?php if(0){ ?>
					<div class="right_column">
						<?php
						include("right_column.php");
						?>
					</div>
				<?php } ?>
				
            
			</div>
        </div>


	



<?php get_footer(); ?>
