<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

Template Name: Project page

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

                  
                <?php
                                    if($_POST['do']=='send'){

	

$to=get_bloginfo('admin_email');

  $subject="Project :".get_the_title();

$message='

	<table cellpadding="3" cellspacing="4" width="40">

                    	

                        	<tr>

                          		<td>

                                	Name:

                                </td>

								<td>

                                	'.$_POST['name'].'

                                </td>

                           

                            

                            </tr>

                    

                    	<tr>

                            	

                                <td>

                                	Phone

                                </td>

                            <td>

                                	'.$_POST['phone'].'

                                </td>

                            </tr>

                              	<tr>

                                <td>

                                	E-mail

                                </td>

							<td>

                                	'.$_POST['email'].'

                                </td>

                            

                            

                            </tr>

                                        	<tr>

                            	

                                <td valign="top">

Comments

                                </td>

                            <td>

                            '.$_POST['comments'].'  

                                </td>

                            </tr>

                                    	

                    </table>



'	;

$to=get_bloginfo('admin_email');

// To send HTML mail, the Content-type header must be set

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(strlen(trim($_POST['name']))>0 && strlen(trim($_POST['email']))>0){

if(mail($to,$subject,$message,$headers))

	$send=1;

else

	$send=0;

}

else
{
?>
<div style="font-size:14px; color:#F00;" >Please fill name and email</div>
<?php
	

	

}

									}
?>

<?php
if($send==1)

		{
?>
        <div style="font-size:14px; color:#F00;" >Your email was sent</div>';
<?php
		}
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

