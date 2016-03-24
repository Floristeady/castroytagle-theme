<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */
?>
	
	<div id="back-image">
		<?php // The header image
		  // Check if this is a post or page, if it has a thumbnail, and if it's a big one
		if ( is_singular() &&
			current_theme_supports( 'post-thumbnails' ) &&
			has_post_thumbnail( $post->ID ) &&
			( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) ) &&
			$image[1] >= HEADER_IMAGE_WIDTH ) :
					echo get_the_post_thumbnail( $post->ID , array(1200,800), array('class' => 'headerimage'));
					elseif ( get_header_image() ) : ?>
					<img src="<?php header_image(); ?>" class="backimage" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		<?php endif; ?>
		<div class="clear"></div>
	</div>

	</section><!-- #main -->
	
	<footer id="footer" role="contentinfo">
		<div id="footer-content" class="resize">
		
		<?php
		/* A sidebar in the footer? Yep. You can can customize
		 * your footer with three columns of widgets.
		 */
		get_sidebar( 'footer' );
		?>

		</div>
		
		<nav id="nav-footer">
						<?php  wp_nav_menu( array( 'container_id' => 'menu-secondary', 'theme_location' => 'secondary', 'sort_column' => 'menu_order' ) ); ?>
		</nav>
	</footer><!-- footer -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
	</body>
</html>