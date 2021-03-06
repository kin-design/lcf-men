<?php

/**
 * The loop that displays a page.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop-page.php.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.2
 */
 
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
                    <?php 
					$images = get_children("post_parent=" . $post -> ID . "&post_type=attachment&post_mime_type=image&orderby=menu_order ASC, ID ASC");
					$c=0;
					
					
					$captions = array();

					foreach( $images as $image ) {
					  //print_r ($image);
					  $img_desc = $image->post_excerpt;
					  $captions[] = $img_desc; 
					  $c++;
					}
					
					$totes = $c;
					?>
   
					
                    <div class="entry-content" style="position:relative;">
						
					<?php 
					$attachments = get_children("post_parent=" . $post -> ID . "&post_type=attachment&post_mime_type=image&orderby=menu_order DESC, ID DESC");
					$c=0;
					foreach( $attachments as $imageID => $imagePost ){ 

					$c++;
					?>
					  
					<?php $image_attributes = wp_get_attachment_image_src( $imageID, 'large' );  ?>
					
                    <div id="img<?php echo $c; ?>"  style="margin-left:<?php echo (-161)-($image_attributes[1])/2;?>px ; margin-right:auto; width:<?php echo $image_attributes[1];?>px; position:absolute; left:50%; z-index: <?php echo 1000-($c); ?>">
						
                    <img  style="border: 1px solid #000000; padding: 9px; " src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>"><br /><div style="margin-left:10px;color:#000000;"><center><?php echo $captions[$c-1]; ?></center></div>
                    </div>
                    
                    <?php } ?>	
                    
					  <div id="imgnav" style="clear:both; position:relative; top:400px; width:436px;" ></div>
                    
                    
                    <?php echo '<script type="text/javascript">fBuildImgNav(1,'.$totes.'); changeStackOrder(1,'.$totes.');</script>' ; ?>
                    
                    <?php
					  if(is_page('Designer 01')){
					    $left=60;
					  }
					  
					  if(is_page('Designer 02')){
					    $left=230;
					  }
					  
					  if(is_page('Designer 03')){
					    $left=380;
					  }
					  
					  if(is_page('Designer 04')){
					    $left=530;
					  }
					  
					  if(is_page('Designer 05')){
					    $left=60;
					  }
					  
					  if(is_page('Designer 06')){
					    $left=230;
					  }
					?>
                      <div id="content" style="visibility:visible; overflow:visible; position:absolute; top:0px; left:<?php //echo $left; ?>456px; z-index:5000; padding: 0px; width: 298px; height:362px;">
					    <div class="entry-content" style="padding:12px;"><?php the_content(); ?></div>
                      </div>
					</div>
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>