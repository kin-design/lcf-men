<?php
/**
 * Template Name: One col, no sidebar, info page
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container" class="one-column">
			<div id="content-artist-page" role="main">

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'info' );
			?>
            
            

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
