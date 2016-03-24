<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<div id="content">
			<article style="margin-bottom:60px;" id="post-0" class="post error404 not-found" role="main">
				<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'castroytagle' ); ?></h1>
				<p><?php _e( 'Parece que no podemos encontrar lo que estás buscando. Nuestro sitio web ha cambiado recientemente. <br/> Puedes utilizar el menú principal o inferior para encontrar información sobre nuestros proyectos.', 'castroytagle' ); ?></p>

			</article>
</div>
<?php get_footer(); ?>
