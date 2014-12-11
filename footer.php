<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */

?>

	<!--<div style="bottom:0;position:fixed;right:0;"><img src="http://slengineering.com.au/wp-content/uploads/2010/09/secure_site.gif " /></div>-->



<div class="footer">

        	<div class="left">Copyright: S&amp;L Engineering Pty Ltd</div>

            <div class="right">

            	<ul>

                	<?php
					
					//wp_list_pages("title_li=&child_of=116");
					wp_nav_menu('footer menu');
					
					if(0){ ?>
                    <li><a href="http://www.ckymedia.com.au">Cky Media</a></li>
					<?php } ?>

                </ul>

            </div>

        </div>

    </div>

<?php /* "Just what do you think you're doing Dave?" */ ?>



		<?php wp_footer(); ?>

  <!--<a href="http://www.instantssl.com" id="comodoTL">Secure SSL Certificate</a>-->

<script language="JavaScript" type="text/javascript">

//COT("http://slengineering.com.au/wp-content/uploads/2010/09/secure_site.gif ", "SC2", "none");

</script>     

</body>

</html>

