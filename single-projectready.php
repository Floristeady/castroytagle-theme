<?php
/**
 * The Template for Sigle 'projectready'
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<?php include('include/breadcrumbs-typestwo.php'); ?>

<div id="content">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<?php $terms = wp_get_post_terms( $post->ID, 'types_two', true ); $theterms = array();?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	
		<h1 class="entry-title <?php foreach ( $terms as $term ) {$theterms[] = $term->slug;echo $term->slug .' ';} ?>"><?php the_title(); if( get_field('modelo_propiedad_ready') ): ?> /
					<span class="model"> <?php the_field('modelo_propiedad_ready'); ?></span>
				<?php endif;?></h1>
				

		<div class="entry-content">
			<?php  if (has_excerpt()) : ?>
				<h2 class="excerpt"><?php the_excerpt(); ?></h2>
            <?php endif ?>
			
			<?php the_content(); ?>
		</div>
				
		<?php  $rows = get_field('galeria_imagenes_ready');  ?>
					
		<?php if($rows) { ?>
		
		<div id="project-gallery" class="flexslider">
		
		<?php echo '<ul class="slides">';
		 
			foreach($rows as $row) { ?>

	 		<li data-thumb="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['agregar_imagen_ready'] ?>&w=82&h=82"> <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['agregar_imagen_ready'] ?>&w=506&h=350"/> </li>

			<?php } echo '</ul>';  ?>
		</div>	
		
		<?php } ?>

		<?php edit_post_link( __( 'Edit', 'castroytagle' ), '<span class="edit-link">', '</span>' ); ?>
	</article><!-- #post-## -->

<?php endwhile; // end of the loop. ?>

</div><!--#content-->

<?php get_footer(); ?>
