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

<div id="content">
	
	<?php if( is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $title = $term->name; }?>
	
	<h1 class="page-title"><?php echo $title ?></h1>
	
	<?php
	$taxonomy = 'cities';
	$tax_terms = get_terms($taxonomy);
	?>
	<ul id="submenu">
		<?php
		foreach ($tax_terms as $tax_term) {
		//echo '<li>' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
		echo '<li>' . '<a href="' . get_bloginfo('url') . '/?types='.$title.'&cities='.$tax_term->name.'" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
		} 
		
		echo '<li>' . '<a href="' . get_bloginfo('url') . '/?types='.$title.'" title="' . sprintf( __( "View all posts in %s" ), $title ) . '" ' . '>Ver todo</a></li>';
		?>
	</ul>
	
	<ul id="list-projects">
	<?php if ( ! have_posts() ) : ?>
		<li id="post-0" class="post error404 not-found ">
			<h1 class="entry-title"><?php _e( 'Nothing Found', 'castroytagle' ); ?></h1>
			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'castroytagle' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</li>
	<?php endif; ?>
	
	
	<!-- listado proyectos programado -->
	<?php while ( have_posts() ) : the_post(); ?>
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
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php the_field('logotipo_del_proyecto'); ?>&w=180&h=80" alt="<?php _e('Logotipo proyecto', 'castroytagle');?>" />
				</span>
				<?php endif;?>
				
				<?php 
					$domsxe = simplexml_load_string(get_the_post_thumbnail($post->ID, 'big'));
					$thumbnailsrc = "";
					if (!empty($domsxe))
						$thumbnailsrc = $domsxe->attributes()->src;
					if (!empty($thumbnailsrc)):
				?>
				<span class="img">
					<img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php print $thumbnailsrc; ?>&w=246&h=186"/>
				</span>			
				<?php endif; //end ?>
				
				<?php if( get_field('modelo_del_proyecto') ): ?>
					<span class="model" class="<?php /*tax*/ $posttags = get_the_terms($post->ID, 'types',''); if ($posttags) { foreach($posttags as $tag) { echo $tag->slug . ' ';} } ?>"><?php the_field('modelo_del_proyecto'); ?></span>
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