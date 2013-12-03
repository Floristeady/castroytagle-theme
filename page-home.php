<?php
/**
 * Template Name: P&aacute;gina Inicio
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<div id="content-full" class="homepage">


<?php if ( have_posts() ) { ?>
	
	<div id="home-gallery" class="flexslider">
				
				<?php while ( have_posts() ) : the_post(); ?>
				
				<?php  $rows = get_field('imagenes_fondo_inicio');  ?>
				
					<?php echo '<ul class="slides">';?>
				
						<?php if($rows) { ?>
						
						<?php foreach($rows as $row) { ?>
		                
					 		<li> <img style="display:none;" class="this" src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_inicio'] ?>&w=1300&h=700" /> </li>
		
						<?php  }  
							
						}  else  { ?>
							<li> <img style="display:none;" class="this" src="<?php bloginfo('template_url') ?>/images/elements/imagen-back.jpg"/></li>
											
						<?php  echo '</ul>'; } endwhile; ?>

				<?php  } else { ?>
				<img style="display:none;" class="this" src="<?php bloginfo('template_url') ?>/images/elements/imagen-back.jpg"/>  	
				
				<?php } ?>	
				
				<?php wp_reset_postdata();?>	

		</div>

</div><!--#content-->

<?php get_footer(); ?>