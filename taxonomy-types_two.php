<?php
/**
 * The template for taxonomy "types_two"
 *
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<div id="content" class="projectready list">
    
    <?php $post_type = get_post_type_object( get_post_type($post) ); ?>
	
	<h1 class="page-title"><?php echo $post_type->label ; ?></h1>
	
	<?php include('include/submenu-terms.php'); ?>
	
	<?php 
		$query = array_merge( $wp_query->query_vars, array( 
		'post_type' => 'projectready', 
		'orderby' => 'menu_order', 
		'posts_per_page' => 80, 
		'order' => 'DESC'
		 ));
		
		 query_posts( $query );
	 ?>
	
	<ul id="list-projects">
	<?php if ( ! have_posts() ) : ?>
		<li id="post-0" class="post error404 not-found ">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'castroytagle' ); ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Estimada visita. <br/> Por el momento no hay proyectos disponibles en esta categoría. <br/> Muchas gracias.', 'castroytagle' ); ?></p>
			</div>
		</li>
	<?php endif; ?>
	
	
	<!-- listado proyectos programado -->
	<?php while ( have_posts() ) : the_post(); ?>
		<li class="project-ready <?php /*tax*/ $posttags = get_the_terms($post->ID, 'types_two',''); if ($posttags) { foreach($posttags as $tag) { echo $tag->slug . ' ';} } ?>">
		
		   <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'castroytagle' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				
				<span class="box-title">
					<span class="project-title"><?php the_title(); ?></span>
				</span>
				
				<?php 
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)):
				?>
				<span class="img">
					<span></span>
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=246&h=186"/>
				</span>			
				<?php else :  ?> 				
				<span class="img">
					<span></span>
					<img src="<?php bloginfo('template_url') ?>/images/elements/default-project.jpg"/>
				</span>
				 <?php  endif; //end ?>
				
				<?php if( get_field('modelo_propiedad_ready') ): ?>
					<span class="model <?php /*tax*/ $posttags = get_the_terms($post->ID, 'types_two',''); if ($posttags) { foreach($posttags as $tag) { echo $tag->slug . ' ';} } ?>"><?php the_field('modelo_propiedad_ready'); ?></span>
				<?php endif;?>
								
				<span class="btn" href="<?php the_permalink(); ?>"><?php _e('Ver más', 'castroytagle');?></span>
			
			</a>
		</li>
	
	<?php endwhile; // End the loop. Whew. ?>
	
	</ul>

</div>
<?php get_footer(); ?>