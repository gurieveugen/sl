<?php
global $wp_query;	
global $wpdb;	
$image_width = get_option('product_image_width');
/*
 * Most functions called in this page can be found in the wpsc_query.php file
 */

 // var_dump($wpdb->func_call); 
//var_dump(get_query_var('category_parent'));
?>
 
<?php if(0){ ?>
	<?php wpsc_start_category_query(array('category_group'=> get_option('wpsc_default_category'), 'show_thumbnails'=> 1)); ?>
		<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_grid_item  <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>">
			<?php wpsc_print_category_name(); ?>
		</a>
		<?php wpsc_print_subcategory("", ""); ?>
	<?php wpsc_end_category_query(); ?>
<?php } ?>
	
<div id="products_page_container" class="wrap wpsc_container container2">

<?php  // wpsc_output_breadcrumbs(); ?>

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

	<div class="box_4">
				

				<?php 
					$currUrl = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
					$blUrl =  get_bloginfo('url');
					$curCat = str_replace($blUrl.'/products-page/categories/','',$currUrl);					
					$curCat = explode('/',$curCat);
					
					?>
	</div>

                        

                        

                        

    <div class="shopCart">                 
		<?php // dynamic_sidebar('sidebar cart'); ?>
    </div>                    

                        

                    	

	</div>	
	<div class="column_22">
	<?php echo htmlspecialchars_decode(wpsc_output_breadcrumbs(array('show_home_page' => false, 'show_products_page' => false, 'show_root_cat' => false, 'echo' => false)));
	// do_action('wpsc_top_of_products_page'); // Plugin hook for adding things to the top of the products page, like the live search 
	?>
	
	
	<?php if(0){ ?>
	<?php if(wpsc_display_categories()): ?>
	  <?php if(wpsc_category_grid_view()) :?>
			<div class="wpsc_categories wpsc_category_grid group">
				<?php wpsc_start_category_query(array('category_group'=> get_option('wpsc_default_category'), 'show_thumbnails'=> 1)); ?>
					<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_grid_item  <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>">
						<?php wpsc_print_category_image(get_option('category_image_width'),get_option('category_image_height')); ?>
					</a>
					<?php wpsc_print_subcategory("", ""); ?>
				<?php wpsc_end_category_query(); ?>
				
			</div><!--close wpsc_categories-->
	  <?php else:?>
			<ul class="wpsc_categories">
			
				<?php wpsc_start_category_query(array('category_group'=>get_option('wpsc_default_category'), 'show_thumbnails'=> get_option('show_category_thumbnails'))); ?>
						<li>
							<?php wpsc_print_category_image(get_option('category_image_width'), get_option('category_image_height')); ?>
							
							<a href="<?php wpsc_print_category_url();?>" class="wpsc_category_link <?php wpsc_print_category_classes_section(); ?>" title="<?php wpsc_print_category_name(); ?>"><?php wpsc_print_category_name(); ?></a>
							<?php if(wpsc_show_category_description()) :?>
								<?php wpsc_print_category_description("<div class='wpsc_subcategory'>", "</div>"); ?>				
							<?php endif;?>
							
							<?php wpsc_print_subcategory("<ul>", "</ul>"); ?>
						</li>
				<?php wpsc_end_category_query(); ?>
			</ul>
		<?php endif; ?>
	<?php endif; ?>
	<?php // */ ?>
	<?php } ?>

	
	<?php if(wpsc_category_description() && (!in_array(wpsc_category_id(), array(18, 33, 37))) ) { ?>
		<div class="wpsc_category_details">
			<?php if(wpsc_show_category_thumbnails()) : ?>
				<img src="<?php echo wpsc_category_image(); ?>" alt="<?php echo wpsc_category_name(); ?>" />
			<?php endif; ?>
			<br />
			<?php if(wpsc_show_category_description() &&  wpsc_category_description()) : ?>
				<?php echo wpsc_category_description(); ?>
			<?php endif; ?>
			<!--h2> <?php //echo wpsc_the_product_title(); ?> </h2-->
		</div><!--close wpsc_category_details-->
	<?php } ?>
	
	<?php
	if($curCat[1]!='' || (in_array(wpsc_category_id(), array(18, 33, 37))) ){ ?>
	
	<?php if(wpsc_display_products()): ?>
		
	
		<?php if(wpsc_has_pages_top()) : ?>
			<div class="wpsc_page_numbers_top">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_top-->
		<?php endif; ?>		
		
		<?php if(1){ ?>

		<div class="product_list_all">
		<?php /** start the product loop here */?>
		<?php 
			$first = 1;
			while (wpsc_have_products()) :  wpsc_the_product(); ?>
					
			<div style="float:left;border-bottom:1px solid #187000;padding-bottom:15px;margin-bottom:10px;">   
				<h2 class="prodtitle entry-title">
				<?php
				if($first == 1) { 
					$first++;
					echo "<p style=\"display:none;\">". wpsc_the_product_title() ."</p>";
				}
				?>
							<?php if(get_option('hide_name_link') == 1) : ?>
								<?php echo wpsc_the_product_title(); ?>
							<?php else: ?> 
								<a class="wpsc_product_title" href="<?php echo wpsc_the_product_permalink(); ?>"><?php echo wpsc_the_product_title(); ?></a>
							<?php endif; ?>
				</h2> 
				<?php if(wpsc_show_thumbnails()) :?>
					<div style="width:<?php echo $image_width; ?>px;float:left;">
						<?php if(wpsc_the_product_thumbnail()) :
						?>
							<a class="<?php echo wpsc_the_product_image_link_classes(); ?>" href="<?php echo wpsc_the_product_permalink(); ?>">
								<img class="product_image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="<?php echo wpsc_the_product_title(); ?>" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo wpsc_the_product_thumbnail(); ?>"/>
							</a>
						<?php else: ?>
								<a href="<?php echo wpsc_the_product_permalink(); ?>">
								<img class="no-image" id="product_image_<?php echo wpsc_the_product_id(); ?>" alt="No Image" title="<?php echo wpsc_the_product_title(); ?>" src="<?php echo WPSC_CORE_THEME_URL; ?>wpsc-images/noimage.png" width="<?php echo get_option('product_image_width'); ?>" height="<?php echo get_option('product_image_height'); ?>" />	
								</a>
						<?php endif; ?>
						<?php
						if(gold_cart_display_gallery()) :					
							echo gold_shpcrt_display_gallery(wpsc_the_product_id(), true);
						endif;
						?>	
					</div><!--close imagecol-->
				<?php endif; ?>
					<div class="productcol" style="margin-left:<?php echo $image_width + 20; ?>px;" >
					
						
						
						<?php							
							do_action('wpsc_product_before_description', wpsc_the_product_id(), $wp_query->post);
							do_action('wpsc_product_addons', wpsc_the_product_id());
						?>
						
						
						<div class="wpsc_description">
							<?php echo wpsc_the_product_description(); ?>
                        </div><!--close wpsc_description-->
				
						<?php if(wpsc_the_product_additional_description()) : ?>
						<div class="additional_description_container">
							
							
							<div class="additional_description">
								<p><?php echo wpsc_the_product_additional_description(); ?></p>
							</div><!--close additional_description-->
							<a href="<?php echo wpsc_the_product_permalink(); ?>" style="float:right;"><?php _e('More Details', 'wpsc'); ?></a>
						</div><!--close additional_description_container-->
						<?php endif; ?>
						
						<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
							<?php $action =  wpsc_product_external_link(wpsc_the_product_id()); ?>
						<?php else: ?>
						<?php $action = htmlentities(wpsc_this_page_url(), ENT_QUOTES, 'UTF-8' ); ?>					
						<?php endif; ?>					
						<form class="product_form"  enctype="multipart/form-data" action="<?php echo $action; ?>" method="post" name="product_<?php echo wpsc_the_product_id(); ?>" id="product_<?php echo wpsc_the_product_id(); ?>" >
						<?php do_action ( 'wpsc_product_form_fields_begin' ); ?>
						
						<?php if(0){ ?>
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
							
							
							
							
							
							
							
							
							
							<!-- THIS IS THE QUANTITY OPTION MUST BE ENABLED FROM ADMIN SETTINGS -->
							
							
								<?php if(wpsc_has_multi_adding()): ?>
									<fieldset><legend><?php _e('Quantity', 'wpsc'); ?></legend>
									<div class="wpsc_quantity_update">
									<?php /*<label for="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>"><?php _e('Quantity', 'wpsc'); ?>:</label>*/ ?>
									<input type="text" id="wpsc_quantity_update_<?php echo wpsc_the_product_id(); ?>" name="wpsc_quantity_update" size="2" value="1" />
									<input type="hidden" name="key" value="<?php echo wpsc_the_cart_item_key(); ?>"/>
									<input type="hidden" name="wpsc_update_quantity" value="true" />
									</div><!--close wpsc_quantity_update-->
									</fieldset>
								<?php endif ;?>
							
							<div class="wpsc_product_price">
								<?php if( wpsc_show_stock_availability() ): ?>
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
										<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('Old Price', 'wpsc'); ?>: <span class="oldprice" id="old_product_price_<?php echo wpsc_the_product_id(); ?>"><?php echo wpsc_product_normal_price(); ?></span></p>
									<?php endif; ?>
									<p class="pricedisplay product_<?php echo wpsc_the_product_id(); ?>"><?php _e('Price', 'wpsc'); ?>: <span id='product_price_<?php echo wpsc_the_product_id(); ?>' class="currentprice pricedisplay"><?php echo wpsc_the_product_price(); ?></span></p>
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
							
							<input type="hidden" value="add_to_cart" name="wpsc_ajax_action"/>
							<input type="hidden" value="<?php echo wpsc_the_product_id(); ?>" name="product_id"/>
					
							<!-- END OF QUANTITY OPTION -->
							<?php if((get_option('hide_addtocart_button') == 0) &&  (get_option('addtocart_or_buynow') !='1')) : ?>
								<?php if(wpsc_product_has_stock()) : ?>
									<div class="wpsc_buy_button_container">
										<div class="wpsc_loading_animation">
											<img title="Loading" alt="Loading" src="<?php echo wpsc_loading_animation_url(); ?>" />
											<?php _e('Updating cart...', 'wpsc'); ?>
										</div><!--close wpsc_loading_animation-->
											<?php if(wpsc_product_external_link(wpsc_the_product_id()) != '') : ?>
											<?php $action = wpsc_product_external_link( wpsc_the_product_id() ); ?>
											<input class="wpsc_buy_button" type="submit" value="<?php echo wpsc_product_external_link_text( wpsc_the_product_id(), __( 'Buy Now', 'wpsc' ) ); ?>" onclick="return gotoexternallink('<?php echo $action; ?>', '<?php echo wpsc_product_external_link_target( wpsc_the_product_id() ); ?>')">
											<?php else: ?>
										<input type="submit" value="<?php _e('Add To Cart', 'wpsc'); ?>" name="Buy" class="wpsc_buy_button" id="product_<?php echo wpsc_the_product_id(); ?>_submit_button"/>
											<?php endif; ?>
									</div><!--close wpsc_buy_button_container-->
								<?php endif ; ?>
							<?php endif ; ?>
							
							<div class="entry-utility wpsc_product_utility">
								<?php edit_post_link( __( 'Edit', 'wpsc' ), '<span class="edit-link">', '</span>' ); ?>
							</div>
							<?php } ?>
							<?php do_action ( 'wpsc_product_form_fields_end' ); ?>
						</form><!--close product_form-->
						
						<?php if((get_option('hide_addtocart_button') == 0) && (get_option('addtocart_or_buynow')=='1')) : ?>
							<?php echo wpsc_buy_now_button(wpsc_the_product_id()); ?>
						<?php endif ; ?>
						
						<?php echo wpsc_product_rater(); ?>
						
						
					<?php // */ ?>
				</div><!--close productcol-->
			<?php if(wpsc_product_on_special()) : ?><span class="sale"><?php _e('Sale', 'wpsc'); ?></span><?php endif; ?>
		</div><!--close default_product_display-->

		<?php endwhile; ?>
		<?php /** end the product loop here */?>
		</div>
		
		
		<?php } ?>
		
		<?php if(wpsc_product_count() == 0 ):?>
			<h3><?php  _e('There are no products in this group.', 'wpsc'); ?></h3>
		<?php endif ; ?>
	    <?php do_action( 'wpsc_theme_footer' ); ?> 	

		<?php if(wpsc_has_pages_bottom()) : ?>
			<div class="wpsc_page_numbers_bottom">
				<?php wpsc_pagination(); ?>
			</div><!--close wpsc_page_numbers_bottom-->
		<?php endif; ?>
	<?php endif; ?>
	
	<?php } ?>
</div><!--close default_products_page_container-->
</div><!--close default_products_page_container-->
