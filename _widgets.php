<?php
class Products_List_Widget extends WP_Widget {

	function Products_List_Widget() {
		$widget_ops = array('classname' => 'widget-product-list', 'description' => __('Product List Widget'));
		$control_ops = array('width' => 400, 'height' => 350);
		$this->WP_Widget('widget-product-list', __('Product List Widget'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {
		global $wpdb;
		
		extract($args);		
		$label = $instance['label'];
		$label = apply_filters( 'widget-product-list', empty($instance['label']) ? '' : $instance['label'], $instance );
		$pl_image = apply_filters( 'widget-product-list', empty($instance['pl_image']) ? '' : $instance['pl_image'], $instance );
		$pl_term = apply_filters( 'widget-product-list', empty($instance['pl_term']) ? '' : $instance['pl_term'], $instance );
		$pl_count = apply_filters( 'widget-product-list', empty($instance['pl_count']) ? '' : $instance['pl_count'], $instance );

		echo $before_widget;
		if ( $pl_image ) 
			echo '<img src="'. $pl_image .'" alt="#">';
		if ( $label ) echo $before_title . $label . $after_title;
		if ( $pl_term ) {
			if ( empty($pl_count) ) $pl_count = '-1';			
			$args = array(
				'post_type'				=> 'wpsc-product',
				'orderby'				=> 'menu_order',
				'order'					=> 'ASC',
				'posts_per_page'	=> $pl_count,
				'tax_query'			=> array(
					array(
						'taxonomy' => 'wpsc_product_category',
						'field' => 'id',
						'terms' => $pl_term
					)
				)
			);
			$products = new WP_Query( $args );
			if ( $products->have_posts() ) {
				echo '<ul>';
					while ( $products->have_posts() ) {
						$products->the_post(); ?>
						<li><a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a></li>
					<?php }
				echo '</ul>';
			}
			wp_reset_postdata();
		}
		echo $after_widget;		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		if ( current_user_can('unfiltered_html') )
			$instance['label'] =  $new_instance['label'];
		else
			$instance['label'] = stripslashes($new_instance['label']);

		$instance['pl_image'] = $new_instance['pl_image'];
		$instance['pl_term'] = $new_instance['pl_term'];
		$instance['pl_count'] = $new_instance['pl_count'];
		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'label' => '', 'pl_count' => '-1' ) );
		$label = strip_tags($instance['label']);
		$pl_image = $instance['pl_image'];
		$pl_term = $instance['pl_term'];
		$pl_count = $instance['pl_count'];
?>
		<p><label for="<?php echo $this->get_field_id('label'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('label'); ?>" name="<?php echo $this->get_field_name('label'); ?>" type="text" value="<?php echo esc_attr($label); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('pl_image'); ?>"><?php _e('Image:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('pl_image'); ?>" name="<?php echo $this->get_field_name('pl_image'); ?>" type="text" value="<?php echo esc_attr($pl_image); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('pl_term'); ?>"><?php _e('Product Category:'); ?></label>
		<?php $term_args = array('hierarchical' => 1,
			'name' => $this->get_field_name('pl_term'),
			'id' => $this->get_field_id('pl_term'),
			'taxonomy' => 'wpsc_product_category'
		);
		if (isset($instance['pl_term'])) $term_args['selected'] = $instance['pl_term'];
		wp_dropdown_categories( $term_args );
		?>
		</p>

		<p><label for="<?php echo $this->get_field_id('pl_count'); ?>"><?php _e('Count:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('pl_count'); ?>" name="<?php echo $this->get_field_name('pl_count'); ?>" type="text" value="<?php echo esc_attr($pl_count); ?>" /></p>
<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("Products_List_Widget");'));