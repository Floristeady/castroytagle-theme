<?php
/**
 * Template Name: P&aacute;gina Módulos (Beneficios)
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
				
				<?php if (has_excerpt()) : ?>
            	<h2 class="excerpt"><?php $pbasExtracto = strip_tags(get_the_excerpt()); ?>
                <?php print $pbasExtracto ?></h2>
                <?php endif ?>
                
				<?php the_content(); ?>
				
				<?php  $rows = get_field('listado_modulo');  ?>
				
					<?php if($rows) { ?>
					
					<?php echo '<ul id="list-modules">';
					 
						foreach($rows as $row) { ?>
	
				 		<li class="close"> 
				 			<a href="javascript:void(0)" class="title" title="Ver más">
					 		<?php if(  $row['titulo_modulo']  ): ?>
					 			<h3><?php echo $row['titulo_modulo'] ?></h3>
					 		<?php endif;?>
					 			<span class="btn-open"></span>
					 		</a>
					 		
					 		<div class="text">
					 		<?php if( $row['imagen_modulo']  ): ?>
				 				<img alt="titulo_modulo" src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_modulo'] ?>&w=180">
				 			<?php endif;?>
					 		
					 		<?php if( $row['texto_modulo']  ): ?>
					 			<?php echo $row['texto_modulo'] ?>
					 		<?php endif;?>
					 		</div>

				 		</li>
	
						<?php  } ;  
						
					echo '</ul>'; }  ?>
				
				<?php edit_post_link( __( 'Editar', 'castroytagle' ), '', '' ); ?>
			</div>
		</article>

<?php endwhile; ?>

</div>

<?php get_footer(); ?>