<?php
	// Setup globals
	// @todo: Get these out of template
	global $wpdb;
	global $wp_query;
	global $wpsc_query;

	// Setup image width and height variables
	// @todo: Investigate if these are still needed here
	$image_width  = get_option( 'single_view_image_width' );
	$image_height = get_option( 'single_view_image_height' );
	//var_dump($wp_query->query_vars);
	//var_dump($wpsc_query);
	$categ = $wpsc_query->query_vars["wpsc_product_category"];
	
	$query = "SELECT * FROM `wp_wpsc_product_categories` WHERE `active`=1 AND `nice-name`='".$categ."'";
	$myResults = $wpdb->get_row($query,ARRAY_A);
	
	
	$query2 = "SELECT * FROM `wp_wpsc_product_categories` WHERE `active`=1 AND `category_parent`='".$myResults['category_parent']."'";
	$myResults2 = $wpdb->get_results($query2,ARRAY_A);
	
// var_dump(wpsc_is_in_category());


?>




<div class="column_1">
	<?php
	$prod_cat = get_term_by( 'slug', 'categories', 'wpsc_product_category' );
	$prod_cat_id = $prod_cat->term_id;

	$main_terms = get_terms( 'wpsc_product_category', 'hide_empty=0&parent='. $prod_cat_id .'&orderby=id&exclude=24,41' );
	//echo '<!--<pre>';
	//print_r($terms);
	//echo '</pre>-->';
	foreach ( $main_terms as $main_term) {
		$main_term_id = $main_term->term_id;
		$main_term_name = $main_term->name;
		$main_term_children = get_term_children( $main_term_id, 'wpsc_product_category' );
		$main_term_active = false;
		$mclass = '';
		if ( $main_term_id == wpsc_category_id() )  $mclass = 'class="active"';
		/*foreach ($main_term_children as $children) {
			if ( $children == wpsc_category_id() ) $main_term_active = true;
		}
		if ( $main_term_id == wpsc_category_id() ) $main_term_active = true;*/
		?>
		<div class="box_4">
			<div class="title"><a href="<?php echo get_term_link( $main_term, 'wpsc_product_category' ); ?>" <?php echo $mclass; ?>><?php echo $main_term_name; ?></a></div>
		<?php  if ( !in_array($main_term_id, array(18, 33, 37) ) ) {
			$subcategories = get_terms( 'wpsc_product_category', 'hide_empty=0&parent='. $main_term_id .'&orderby=id' );
			if ( count($subcategories) > 0 ) { ?>
				<div class="content">
					<ul class="categories">
						<?php foreach( $subcategories as $subcategory) {
							$subcategory_id = $subcategory->term_id;
							$subcategory_name = $subcategory->name;
							$class = '';
							if ( $subcategory_id == wpsc_category_id() ) $class = 'class="active"'; ?>
							<li class="page_item">
								<a href="<?php echo get_term_link( $subcategory, 'wpsc_product_category' ); ?>" <?php echo $class; ?>><?php echo $subcategory_name;?></a>
								<?php $subcats = get_terms( 'wpsc_product_category', 'hide_empty=0&parent='. $subcategory_id .'&orderby=id' );
								if ( count( $subcats ) > 0 ) { ?>
									<div class="thirdLevelCats">
										<?php foreach( $subcats as $subcat ) {
										$subcat_id = $subcat->term_id;
										$subcat_name = $subcat->name;
										$class = $subcat->slug;
										if ( $subcat_id == wpsc_category_id() ) $class .= ' active'; ?>										
											<a href="<?php echo get_term_link( $subcat, 'wpsc_product_category' ); ?>" class="<?php echo $class; ?>"><?php echo $subcat_name; ?></a>
										<?php } ?>
									</div>
								<?php } ?>
							</li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		<?php } ?>
		</div>
	<?php } ?>

	<?php /* ?><div class="box_4">
	<div class="title">Categories</div>
					<div class="content">
					<ul class="categories">
					
					<?php 
					
					if($myResults['category_parent']==0){					
						foreach($myResults2 as $key=>$value){		
							?><li class="page_item"><a href="<?php echo bloginfo('url').'/products-page/categories/'.$value["nice-name"];?>"><?php echo $value['name'];?></a></li><?php 
						}
					}else{				
						foreach($myResults2 as $key=>$value){		
							?><li class="page_item"><a href="<?php echo bloginfo('url').'/products-page/categories/'.$myResults['nice-name'].'/'.$value["nice-name"];?>"><?php echo $value['name'];?></a></li><?php 
						}
					}
					?>
					</ul>
		</div>
	</div><?php */ ?>
	<div class="shopCart">
		<?php dynamic_sidebar('sidebar cart'); ?>
	</div>
	</div>	
	<div class="column_22">
					
					

<div id="single_product_page_container">
	
	<?php
		// Breadcrumbs
		wpsc_output_breadcrumbs(array('show_home_page' => false, 'show_products_page' => false, 'show_root_cat' => false));

		// Plugin hook for adding things to the top of the products page, like the live search
		do_action( 'wpsc_top_of_products_page' );
	?>
	
	<div class="single_product_display group">
<?php
		/**
		 * Start the product loop here.
		 * This is single products view, so there should be only one
		 */

		while ( wpsc_have_products() ) : wpsc_the_product(); ?>
			<h2><?php echo wpsc_the_product_title(); ?></h2>
					<div class="imagecol">
						<?php if ( wpsc_the_product_thumbnail() ) : ?>
								<a rel="<?php echo wpsc_the_product_title(); ?>" class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo wpsc_the_product_image(); ?>">
									<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(get_option('product_image_width'),get_option('product_image_height'),'','single'); ?>"/>
								</a>
								<?php 
								if ( function_exists( 'gold_shpcrt_display_gallery' ) )
									echo gold_shpcrt_display_gallery( wpsc_the_product_id() );
								?>
						<?php else: ?>
									<a href="<?php echo wpsc_the_product_permalink(); ?>">
									<img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" />
									</a>
						<?php endif; ?>
					</div><!--close imagecol-->

					<div class="productcol">			
						<?php do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post); ?>
						<div class="product_description">
							<?php echo wpsc_the_product_description(); ?>
						</div><!--close product_description -->
						<?php do_action( 'wpsc_product_addons', wpsc_the_product_id() ); ?>		
						<?php if ( wpsc_the_product_additional_description() ) : ?>
							<div class="single_additional_description">
								<p><?php echo wpsc_the_product_additional_description(); ?></p>
							</div><!--close single_additional_description-->
						<?php endif; ?>		
						<?php do_action( 'wpsc_product_addon_after_descr', wpsc_the_product_id() ); ?>
						<?php
						/**
						 * Custom meta HTML and loop
						 */
						?>
                        <?php if (wpsc_have_custom_meta()) : ?>
						<div class="custom_meta">
							<?php while ( wpsc_have_custom_meta() ) : wpsc_the_custom_meta(); ?>
								<strong><?php echo wpsc_custom_meta_name(); ?>: </strong><?php echo wpsc_custom_meta_value(); ?><br />
							<?php endwhile; ?>
						</div><!--close custom_meta-->
                        <?php endif; ?>
						<?php
						/**
						 * Form data
						 */
						?>
						<?php
					$args = array(
						'post_type' => 'wpsc-product-file',
						'post_parent' => wpsc_the_product_id(),
						'numberposts' => -1,
						'post_status' => 'all'
					);

					$attached_files = (array)get_posts( $args );
					
					
					
					$once = 1;
					if(count($attached_files)){

						
						foreach ( (array)$attached_files as $file ) {
						
						
							$file_dir = WPSC_FILE_DIR.$file->post_title;
						//	$file_size = filesize( $file_dir ) ;
							$file_url = WPSC_FILE_URL.$file->post_title;
				
							//if(file_exists($file_url)){
							
														//var_dump($file_url);
														//var_dump($attached_files);
							
							
								if($once==1){
									?><strong>Download Brochures</strong><br /><br /><?php 
									$once++;
								}
								?><a style="color:#187000;" href="<?php echo $file_url;?>"><span><?php echo $file->post_title;?></span></a><br /><?php
							
							//}
						}
					} ?>
						<?php 
					  
							$postId = 103;
							$post_d = get_post($postId); 	
							
							echo do_shortcode($post_d->post_content);	
							
						?>
						<form class="product_form" enctype="multipart/form-data" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="1" id="product_<?php echo wpsc_the_product_id(); ?>">
							<?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
							<?php if ( wpsc_product_has_personal_text() ) : ?>
								<fieldset class="custom_text">
									<legend><?php _e( 'Personalize Your Product', 'wpsc' ); ?></legend>
									<p><?php _e( 'Complete this form to include a personalized message with your purchase.', 'wpsc' ); ?></p>
									<textarea cols='55' rows='5' name="custom_text"></textarea>
								</fieldset>
							<?php endif; ?>
						
							<?php if ( wpsc_product_has_supplied_file() ) : ?>

								<fieldset class="custom_file">
									<legend><?php _e( 'Upload a File', 'wpsc' ); ?></legend>
									<p><?php _e( 'Select a file from your computer to include with this purchase.', 'wpsc' ); ?></p>
									<input type="file" name="custom_file" />
								</fieldset>
							<?php endif; ?>	
						<?php /** the variation group HTML and loop */?>
                        <?php if (wpsc_have_variation_groups()) { ?>
                        <fieldset><legend><?php _e('Product Options', 'wpsc'); ?></legend>
						<div class="wpsc_variation_forms">
                        	<table>
							<?php while (wpsc_have_variation_groups()) : wpsc_the_variation_group(); ?>
								<tr><td class="col1"><label for="<?php echo wpsc_vargrp_form_id(); ?>"><?php echo wpsc_the_vargrp_name(); ?>:</label></td>
								<?php /** the variation HTML and loop */?>
								<td class="col2"><select class="wpsc_select_variation" name="variation[<?php echo wpsc_vargrp_id(); ?>]" id="<?php echo wpsc_vargrp_form_id(); ?>">
								<?php while (wpsc_have_variations()) : wpsc_the_variation(); ?>
									<option value="<?php echo wpsc_the_variation_id(); ?>" <?php echo wpsc_the_variation_out_of_stock(); ?>><?php echo wpsc_the_variation_name(); ?></option>
								<?php endwhile; ?>
								</select></td></tr> 
							<?php endwhile; ?>
                            </table>
						</div><!--close wpsc_variation_forms-->
                        </fieldset>
						<?php } ?>
						<?php /** the variation group HTML and loop ends here */?>

						




						<?php if(0){?>


							<?php
								/**
								 * disable them in any case
								 * Quantity options - MUST be enabled in Admin Settings
								 */
								?>
								<?php if(wpsc_has_multi_adding()): ?>
									<fieldset><legend><?php _e('Quantity', 'wpsc'); ?></legend>
									<div class="wpsc_quantity_update">
									<input type="text" id="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>" name="wpsc_quantity_update" size="2" value="1" />
									<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
									<input type="hidden" name="wpsc_update_quantity" value="true" />
									</div><!--close wpsc_quantity_update-->
									</fieldset>
								<?php endif ;?>
								
								<div class="wpsc_product_price">
									<?php if(wpsc_show_stock_availability()): ?>
										<?php if(wpsc_product_has_stock()) : ?>
											<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="in_stock"><?php _e('Product in stock', 'wpsc'); ?></div>
										<?php else: ?>
											<div id="stock_display_<?php echo wpsc_the_product_id(); ?>" class="out_of_stock"><?php _e('Product not in stock', 'wpsc'); ?></div>
										<?php endif; ?>
									<?php endif; ?>	
									<?php if(wpsc_product_is_donation()) : ?>
										<label for="donation_price_<?php echo wpsc_the_product_id(); ?>"><?php _e('Donation', 'wpsc'); ?>: </label>
										<input type="text" id="donation_price_<?php echo wpsc_the_product_id(); ?>" name="donation_price" value="<?php echo wpsc_calculate_price(wpsc_the_product_id()); ?>" size="6" />
									<?php else : ?>
										<?php if(wpsc_product_on_special()) : ?>
											<p class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><?php _e('Old Price', 'wpsc'); ?>: <span class="oldprice" id="old_product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_product_normal_price(); ?></span></p>
										<?php endif; ?>
										<p class="pricedisplay <?php echo wpsc_the_product_id(); ?>"><?php _e('Price', 'wpsc'); ?>: <span id='product_price_<?php echo wpsc_the_product_id(); ?>' class="currentprice pricedisplay"><?php echo wpsc_the_product_price(); ?></span></p>
										<?php if(wpsc_product_on_special()) : ?>
											<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('You save', 'wpsc'); ?>: <span class="yousave" id="yousave_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_currency_display(wpsc_you_save('type=amount'), array('html' => false)); ?>! (<?php echo wpsc_you_save(); ?>%)</span></p>
										<?php endif; ?>
										 <!-- multi currency code -->
										<?php if(wpsc_product_has_multicurrency()) : ?>
											<?php echo wpsc_display_product_multicurrency(); ?>
										<?php endif; ?>
										<?php if(wpsc_show_pnp()) : ?>
											<p class="pricedisplay"><?php _e('Shipping', 'wpsc'); ?>:<span class="pp_price"><?php echo wpsc_product_postage_and_packaging(); ?></span></p>
										<?php endif; ?>							
									<?php endif; ?>
								</div><!--close wpsc_product_price-->
								<!--sharethis-->
								<?php if ( get_option( 'wpsc_share_this' ) == 1 ): ?>
								<div class="st_sharethis" displayText="ShareThis"></div>
								<?php endif; ?>
								<!--end sharethis-->
								<input type="hidden" value="add_to_cart" name="wpsc_ajax_action" />
								<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id" />					
								<?php if( wpsc_product_is_customisable() ) : ?>
									<input type="hidden" value="true" name="is_customisable"/>
								<?php endif; ?>
							<?php } ?>
					
					
					
					
					
					
					
					
					
					
							<?php
							/**
							 * Cart Options
							 */
							 
							 
							 
							?>

							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
								<?php if(wpsc_product_has_stock()) : ?>
									<div class="wpsc_buy_button_container">
											<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
											<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
											<input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?>" onclick="return gotoexternallink('<?php echo $action; ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
											<?php else: ?>
										<input type="submit" value="<?php _e('Add To Cart', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
											<?php endif; ?>
										<div class="wpsc_loading_animation">
											<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
											<?php _e('Updating cart...', 'wpsc'); ?>
										</div><!--close wpsc_loading_animation-->
									</div><!--close wpsc_buy_button_container-->
								<?php else : ?>
									<p class="soldout"><?php _e('This product has sold out.', 'wpsc'); ?></p>
								<?php endif ; ?>
							<?php endif ; ?>
							<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
						</form><!--close product_form-->
					
						<?php
							if ( (get_option( 'hide_addtocart_button' ) == 0 ) && ( get_option( 'addtocart_or_buynow' ) == '1' ) )
								echo wpsc_buy_now_button( wpsc_the_product_id() );
					
							echo wpsc_product_rater();

							echo wpsc_also_bought( wpsc_the_product_id() );
						
						if(wpsc_show_fb_like()): ?>
	                        <div class="FB_like">
	                        <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo wpsc_the_product_permalink(); ?>&amp;layout=standard&amp;show_faces=true&amp;width=435&amp;action=like&amp;font=arial&amp;colorscheme=light" frameborder="0"></iframe>
	                        </div><!--close FB_like-->
                        <?php endif; ?>
					</div><!--close productcol-->
		
					<form onsubmit="submitform(this);return false;" action="<?php echo wpsc_this_page_url(); ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_extra_<?php echo wpsc_the_product_id(); ?>">
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="prodid"/>
						<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="item"/>
					</form>
		</div><!--close single_product_display-->
		
		<?php // echo wpsc_product_comments(); ?>
		
		

<?php endwhile;

    do_action( 'wpsc_theme_footer' ); ?> 	

</div><!--close single_product_page_container-->
</div><!--close single_product_page_container-->
