<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  ) )
		return;
	// If we get this far, we have widgets. Let's do this.
?>

<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
			<ul class="widget-list two_thirds">
				<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
			</ul>
<?php endif; ?>


