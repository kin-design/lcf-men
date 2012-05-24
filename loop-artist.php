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
					//foreach( $attachments as $imageID => $imagePost ){ 
					$captions = array();

					foreach( $images as $image ) {
					
					  $img_desc = $image->post_excerpt;
					  $captions[] = $img_desc; 
					  $c++;
					}
					//print_r($captions);
					
					$totes = $c;
					?>
                    
                    <?php //if(){?>
   
					<div ><center style="color:#000000;">
                    <a style="color:#000000;" href="javascript:onclick=changeStackOrder('prev',<?php echo $totes;?>);"><</a> | 
                    <?php $i=1;
						while($i<=$totes) {
 							 echo '<a style="color:#000000;" href="javascript:onclick=changeStackOrder('.$i.','.$totes.');">'.$i.'</a> |';
  							 $i++;
  						}
					?>
                  
                    <a style="color:#000000;" href="javascript:onclick=changeStackOrder('next',<?php echo $totes;?>);">></a>
                    </center></div>
                    
					<div class="entry-content" style="position:relative;">
						
					<?php 
					$attachments = get_children("post_parent=" . $post -> ID . "&post_type=attachment&post_mime_type=image&orderby=menu_order DESC, ID DESC");
					$c=0;
					foreach( $attachments as $imageID => $imagePost ){ 

					$c++;
					?>
					  
					<?php $image_attributes = wp_get_attachment_image_src( $imageID, 'large' );  ?>
					
                    <div id="img<?php echo $c; ?>"  style="margin-left:<?php echo (-10)-($image_attributes[1])/2;?>px ; margin-right:auto; width:<?php echo $image_attributes[1];?>px; position:absolute; left:50%; z-index: <?php echo 1000-($c); ?>">
						
                    <img  style="border: 10px solid #FFFFFF; " src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>"><br /><div style="margin-left:10px;"><center><?php echo $captions[$c-1]; ?></center></div>
                    </div>
					<?php } ?>	
					
                    
                      <div id="content" style=" visibility:hidden; position:absolute; top:-30px; left:60px; z-index:5000; padding: 0px; width: 298px; height:320px;">
					    <div class="entry-content" style="padding:12px;"><?php the_content(); ?> 
				        <center><a href="javascript:fHideDiv('content');">close</a></center></div>
                      </div>
					</div>
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>