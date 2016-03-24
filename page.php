<?php
/**
 * Template Name: P&aacute;gina General
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<?php include('include/breadcrumbs.php'); ?>

<div id="content">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<?php include('include/submenu-pages.php'); ?>	
					
			<div class="entry-content">
				
				<?php  if (has_excerpt()) : ?>
            	<h2 class="excerpt"><?php $pbasExtracto = strip_tags(get_the_excerpt()); ?>
                <?php print $pbasExtracto ?></h2>
                <?php endif ?>
                
				<?php the_content(); ?>
				
				
				<?php  $rows = get_field('galeria_imagenes_general');  ?>
				
					<?php if($rows) { ?>
					<div id="page-gallery" class="flexslider">
					<?php echo '<ul class="slides">';
					 
						foreach($rows as $row) { ?>
	
				 		<li> <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_galeria_general'] ?>&w=786&h=430"/> </li>
	
						<?php  } ; ?> 
					</div>
					<?php  echo '</ul>'; }  ?>

				
				<?php edit_post_link( __( 'Editar', 'castroytagle' ), '', '' ); ?>
			</div>
		</article>

<?php endwhile; ?>

</div>

<?php get_footer(); ?>