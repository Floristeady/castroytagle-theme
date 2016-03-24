<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
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

</div>


<?php get_footer(); ?>