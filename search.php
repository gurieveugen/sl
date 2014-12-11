<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */



get_header(); ?>

<div class="main">

            <div class="container">

				<div class="left_column" style="text-align:justify;">





		<h2 class="pagetitle">Search Results</h2>

<?php


 $sql="SELECT * FROM wp_wpsc_product_list where name   LIKE '%".$_GET['s']."%' OR additional_description LIKE '%".$_GET['s']."%'";
$result=mysql_query($sql);

if(mysql_affected_rows()){
?>
<ul>
<?php
while($row=mysql_fetch_array($result)){
	
?>
<li>
<a href="<?php echo wpsc_the_product_permalink($row['id']) ;?>"> <?php echo $row['name'];?> </a>
</li>
<?php


}
}else{
	?>




	</ul>	



		






		<h2 class="center">No products found. Try a different search?</h2>

		<?php get_search_form(); ?>

<?php 

}
?>

                </div>

                <div class="right_column">

                	<?php

					include("right_column.php");

					?>

                </div>

            </div>

        </div>

	

<?php get_footer(); ?>

