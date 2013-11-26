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
	
	<footer role="contentinfo">
		<div id="footer-content">
		
<?php
	/* A sidebar in the footer? Yep. You can can customize
	 * your footer with three columns of widgets.
	 */
	get_sidebar( 'footer' );
?>
		</div>
	</footer><!-- footer -->
	
	</section><!-- #main -->
	
<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	wp_footer();
?>
	</body>
</html>