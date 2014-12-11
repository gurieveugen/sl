<?php



/**


 * @package WordPress



 * @subpackage Default_Theme



 */



?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">



<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>







<head profile="http://gmpg.org/xfn/11">



<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />







<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="shortcut icon" href="<?php bloginfo("stylesheet_directory")?>/images/favicon.ico" />





<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />



<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<script language="javascript">



var site_uri ='<?php echo get_bloginfo('url');?>';





</script>





<style type="text/css" media="screen">







<?php



// Checks to see whether it needs a sidebar or not



if ( empty($withcomments) && !is_single() ) {



?>



	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbg-<?php bloginfo('text_direction'); ?>.jpg") repeat-y top; border: none; }



<?php } else { // No sidebar ?>



	#page { background: url("<?php bloginfo('stylesheet_directory'); ?>/images/kubrickbgwide.jpg") repeat-y top; border: none; }



<?php } ?>

<!--[if lte IE 7]>

<link type="text/css" rel="stylesheet" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/ie7.css" />

<![endif]-->







</style>







<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>







<?php wp_head(); ?>





<!--[if lte IE 6]> <style type="text/css"> img, .pngtrans { behavior:url(<?php bloginfo("stylesheet_directory");?>/images/iepngfix.htc) } </style>  <![endif]-->









</head>

<script language="javascript" type="text/javascript">

//<![CDATA[

//var cot_loc0=(window.location.protocol == "https:")?"https://secure.comodo.net/trustlogo/javascript/cot.js":"http://www.trustlogo.com/trustlogo/javascript/cot.js";

//document.writeln('<scr' + 'ipt language="JavaScript" src="'+cot_loc0+'" type="text\/javascript">' + '<\/scr' + 'ipt>');

//]]>

</script>

<body>
	<div class="page">



<div class="header">

<strong class="logo"><a href="http://www.slengineering.com.au">slengineering</a></strong>

        	<!--<div class="logo">
      <object id="myIdr26" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="671" height="117" >
<param name="wmode" value="transparent" /> 
<param name="movie" value="<?php echo get_bloginfo("stylesheet_directory"); ?>/images/FlashCaptch.swf" />
<!--[if !IE]>-->
<!--<object type="application/x-shockwave-flash" data="<?php echo get_bloginfo("stylesheet_directory"); ?>/images/FlashCaptch.swf" width="671" height="107">
<!--<![endif]-->
<!--<div>
<h1>Alternative content</h1>
<p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
</div>
<!--<param name="wmode" value="transparent" /> 
<!--[if !IE]>-->
<!--</object>
<!--<![endif]-->
<!--</object>
      </div>-->
<div class="header-text">
	<h1>TOTAL PNEUMATIC SOLUTIONS</h1>
	<p>From Sales, Installation, Servicing. and more...</p>
</div>
<div class="phone">
	<span>1300 132 426</span>
</div>

 

            <div class="clear"></div>



            <div class="main_menu">


				
            	<?php  //jquery_drop_down_menu('Home'); ?>
				<?php 
				
				    // add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
						add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
						function my_css_attributes_filter($var) {
							if(is_array($var)){
								$varci= array_intersect($var, array('current-menu-item'));
								$cmeni = array('current-menu-item');
								$selava   = array('selectedmenu');
								$selavaend = array();
								$selavaend = str_replace($cmeni, $selava, $varci);
							}
							else{
								$selavaend= '';
							}
						return $selavaend;
						}

				
				
				
				if(1){
				$defaults = array(
					  'menu'            => 'header', 
					  'container' 		=> 'ul',
					  'menu_class'      => 'menu', 
					  'container_id'    => 'dropmenu',
					  'echo'            => true,
					  'items_wrap'      => '<ul id="dropmenu">%3$s</ul>'
					  );
				wp_nav_menu( $defaults ); 
				}else{ 
				
				
					$gdd_wp_url = get_bloginfo('wpurl') . "/";	

	$home_link = get_option('home_link');
  
	$include = get_option('include');

	$fadein = get_option('fadein');

	$fadeout = get_option('fadeout');

	$sort_by = get_option('sort_by');

	//$sort_order = get_option('sort_order');

//echo	$depth = get_option('depth');

	$exclude_pages = get_option('exclude_pages');

	$custom_menu = get_option('custom_menu');

	$custom_menu_value = get_option('custom_menu_value');

	$custom_menu_include = get_option('custom_menu_include');

	



	  
	 $parameters.='&parent=0';
	  if($sort_by) $parameters.='&sort_column='.$sort_by.'';

	  if($sort_order)

	 // $parameters.='&sort_order='.$sort_order.'';

	

	
	 	  if($exclude_pages)

	    {

		 $parameters.='&exclude='.$exclude_pages.'';		

			}	

 //$parameters .="&echo=0";

 
 
 
 
 if(1){
	echo '<ul  id="dropmenu">';



	//echo '<li ><a href="'.$gdd_wp_url.'" title="'.$home.'" class="asdfg">HOME</a></li>';

	
//wp_list_pages($parameters);
	$pages=	get_pages($parameters);	

foreach ($pages as $pagg) {

	if($pagg->ID==14){
		
		echo"<li> <a href='".get_permalink($pagg->ID)."'>$pagg->post_title </a>";
		echo"<ul style='display:none'> ";

		$sql=mysql_query("SELECT * FROM wp_wpsc_product_categories where category_parent='0' and active='1'   ORDER BY `id` asc");
		while($row=mysql_fetch_array($sql)){
		
				//echo "<li><a href='".get_bloginfo("url").'/products-page/'.$row['nice-name'].'/'."'>".$row['name']."</a>";
				//get_subcategory($row['id'],$row['nice-name']);
					
			echo"</li>";	
		}
		echo "</ul>"	;
		echo "</li>";
	}else{
		
		$pages_new = get_pages('child_of='.$pagg->ID.'&sort_column=menu_order&sort_order=asc');
		echo"<li> <a href='".get_permalink($pagg->ID)."'>".$pagg->post_title."</a><ul>";

		foreach($pages_new as $key=>$value){
				
			echo"<li> <a href='".get_permalink($value->ID)."'>".$value->post_title."</a></li>";

		}
		echo"</ul></li>";	
	}

}

echo '</ul>';

}	



}
				
				?>
				
				
				

            </div>


        </div>



	<div>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#dropmenu li a').each(function(){
				if(jQuery(this).html() == 'Products Page'){
					jQuery(this).attr('href','javascript:void(0)');
				}
			})
		})
	</script>