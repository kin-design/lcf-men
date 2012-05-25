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
					
       <center><br /><?php 
	   //$s =  get_post_meta($post->ID, 'videos', true); 
	   //$videos = explode("&&", $s);
	   //$c= count($videos); 
	   
	   $videos = array();
	   
	   $mykey_values = get_post_custom_values('clipID');
         foreach ( $mykey_values as $key => $value ) {
           array_push($videos, $key);
         }
	   $c= count($videos);
	   
	   echo "<a href='javascript:fLoadPreviousClip();'><</a> ";
	   
	   $i=1;
		while($i<=$c){
         echo  "<a href='javascript:fLoadClip(".$videos[$i-1].",".$i.",".$c.")'>".$i . "</a> ";
         $i++;
        }
	   
	   echo " <a href='javascript:fLoadNextClip();'>></a>";
	   
	   ?>
</center>
<br />
<div id="videoclip" style="color:#FFFFFF;"><center>Loading...</center></div>

<?php
  $mykey_values = get_post_custom_values('clipID');
  foreach ( $mykey_values as $key => $value ) {
    //echo "$value <br />"; 
	echo '<script type="text/javascript"> fAddToClipsArray('.$value.'); </script>' ;
  }


  $mykey_values = get_post_custom_values('caption');
  foreach ( $mykey_values as $key => $value ) {
    //echo "$value <br />"; 
	echo '<script type="text/javascript"> fAddToCaptionsArray("'.$value.'"); </script>' ;
  }

?>
<?php 

echo '<script type="text/javascript">fLoadClip('.$videos[0].',1,'.$c.');</script>' ; 
?>

</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>