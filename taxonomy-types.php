<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<div id="content" class="projectsale list">
	
	<?php if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $title = $term->name; }?>
	
	<h1 class="page-title"><?php echo $title ?></h1>
	
	<?php include('include/submenu-filter.php'); ?>	
	
	<?php 
		$query = array_merge( $wp_query->query_vars, array( 
		'post_type' => 'projectsale', 
		'orderby' => 'menu_order', 
		'posts_per_page' => 60, 
		'order' => 'ASC'
		 ));
		
		 query_posts( $query );
	 ?>

	<ul id="list-projects">
	<?php if (!have_posts() ) : ?>
		<li id="post-0" class="post error404 not-found ">
			<h1 class="entry-title"><?php _e( '', 'castroytagle' ); ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Estimada visita. <br/> Por el momento no hay proyectos disponibles en esta categoría. <br/> Muchas gracias.', 'castroytagle' ); ?></p>
			</div>
		</li>
	<?php endif; ?>
	
	
	<!-- listado proyectos programado -->
	<?php while (have_posts() ) : the_post(); ?>
		<li class="project <?php /*tax*/ $posttags = get_the_terms($post->ID, 'cities',''); if ($posttags) { foreach($posttags as $tag) { echo $tag->slug . ' ';} } ?>">
		
		   <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'castroytagle' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				
				<span class="box-title">
					<span class="project-title"><?php the_title(); ?></span>
				</span>
				
				<?php if( get_field('lugar_proyecto') ): ?>
				<span class="text"><?php the_field('lugar_proyecto'); ?></span>
				<?php endif;?>
			
				<?php if( get_field('logotipo_del_proyecto') ): ?>
				<span class="logo-project">
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('logotipo_del_proyecto'); ?>&w=246" alt="<?php _e('Logotipo proyecto', 'castroytagle');?>" />
				</span>
				<?php else :  ?> 				
				<span class="logo-project">
					<img src="<?php bloginfo('template_url') ?>/images/elements/default-logo.jpg"/>
				</span>
				<?php endif;?>
				
				<?php if( get_field('imagen_listado_proyecto') ): ?>
				<span class="img">
					<span></span>
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('imagen_listado_proyecto'); ?>&w=246&h=186" alt="<?php the_title(); ?>" />
				</span>
				<?php else :  ?> 				
				<span class="img">
				    <span></span>
					<img src="<?php bloginfo('template_url') ?>/images/elements/default-project.jpg"/>
				</span>
				<?php endif; //end img?>
								
				<?php if( get_field('modelo_del_proyecto') ): ?>
					<span class="model <?php /*tax*/ $posttags = get_the_terms($post->ID, 'types',''); if ($posttags) { foreach($posttags as $tag) { echo $tag->slug . ' ';} } ?>"><?php the_field('modelo_del_proyecto'); ?></span>
				<?php endif;?>
				
				<?php if( get_field('caracteristicas_del_proyecto') ): ?>
				 <span class="data">
					<?php the_field('caracteristicas_del_proyecto'); ?>
				 </span>
				<?php endif;?>
				
				<span class="buttons">
					<?php if( get_field('valor_propiedad') ): ?>
					<span class="value"><?php the_field('valor_propiedad'); ?></span>
					<?php endif;?>					
					<span class="btn" href="<?php the_permalink(); ?>"><?php _e('Ver más', 'castroytagle');?></span>
				</span>
			
			</a>
		</li>
	
	<?php endwhile; // End the loop. Whew. ?>
	
	</ul>

</div>
<?php get_footer(); ?>