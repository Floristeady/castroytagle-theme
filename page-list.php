<?php
/**
 * Template Name: P&aacute;gina Listado (Manuales)
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

            	<h2 class="excerpt"><?php $pbasExtracto = strip_tags(get_the_excerpt()); ?>
                <?php print $pbasExtracto ?></h2>
                
				<?php the_content(); ?>
				
				<?php  $rows = get_field('manual_proyecto');  ?>
				
					<?php if($rows) { ?>
					
					<?php echo '<ul id="list-documents">';
					 
						foreach($rows as $row) { ?>
	
				 		<li> 
					 		<?php if(  $row['nombre_del_proyecto']  ): ?>
					 			<h3><?php echo $row['nombre_del_proyecto'] ?></h3>
					 		<?php endif;?>
					 		
					 		<?php if( $row['texto_del_proyecto']  ): ?>
					 			<p><?php echo $row['texto_del_proyecto'] ?></p>
					 		<?php endif;?>
					 		
					 		<?php if( $row['agregar_documento']  ): ?>
				 				<a target="_blank"  title="<?php echo $row['nombre_del_proyecto'] ?>" href="<?php echo $row['agregar_documento'] ?>"><i class="icon-doc"></i><?php _e('DESCARGAR MANUAL', 'castroytagle') ?></a>
				 			<?php endif;?>
				 		</li>
	
						<?php  } ;  
						
					echo '</ul>'; }  ?>
				
				<?php edit_post_link( __( 'Editar', 'castroytagle' ), '', '' ); ?>
			</div>
		</article>

<?php endwhile; ?>

</div>

<?php get_footer(); ?>