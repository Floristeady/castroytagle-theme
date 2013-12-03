<?php
/**
 * The Template for single projectsale
 *
 * @package WordPress
 * @subpackage castroytagle
 * @since castroytagle 1.0
 */

get_header(); ?>

<?php include('include/breadcrumbs-projects.php'); ?>

<div id="content">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
		
			<div class="project-top">
				<h1 class="entry-title <?php foreach ( $terms as $term ) {$theterms[] = $term->slug;echo $term->slug .' ';} ?>"><?php the_title(); if( get_field('modelo_del_proyecto') ): ?> /
						<span class="model"> <?php the_field('modelo_del_proyecto'); ?></span>
					<?php endif;?></h1>
				
				<?php include('include/submenu-project.php'); ?>
			</div>
			
			<div class="inner">
			
			<div class="project-content">
							
				<div id="section-1" class=" section">	
					<div class="entry-content">
					<h2 class="excerpt"><?php $pbasExtracto = strip_tags(get_the_excerpt()); ?>
		                <?php print $pbasExtracto ?></h2>
					
					<?php the_content(); ?>
					
					<?php if( get_field('agregar_catalogo') ): ?>
					<a target="_blank" title="<?php _e('Descargar Catálogo','castroytagle') ?>" class="download-pdf back-btn" href="<?php the_field('agregar_catalogo'); ?>"><i class="icon-doc"></i><?php _e('Descargar Catálogo','castroytagle') ?></a>
					<?php endif;?>
					
					</div><!-- .entry-content -->
	
					<?php  $rows = get_field('imagenes');  ?>
							
					<?php if($rows) { ?>
					<div id="project-gallery" class="flexslider">
					
						<?php echo '<ul class="slides">';
						 
							foreach($rows as $row) { ?>
			
					 		<li data-thumb="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_proyecto'] ?>&w=82&h=82"> <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_proyecto'] ?>&w=506&h=350"/> </li>
			
							<?php } echo '</ul>'; ?> 
						</div>	
					<?php	} ?>

				</div><!--#section1-->
				
				
				<?php if( get_field('galeria_entorno') || get_field('texto_entorno')): ?>
				<div id="section-2" class="section">	
						
					<?php  $rows = get_field('galeria_entorno');  ?>							
					<?php if($rows) { ?>
						<div id="entorno-gallery" class="flexslider">
						<?php echo '<ul class="slides">';
						 
							foreach($rows as $row) { ?>
			
					 		<li> <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_entorno'] ?>&w=662&h=480"/> </li>
			
							<?php } echo '</ul>';  ?>
						</div>	
					<?php } ?>
						

					<?php if( get_field('texto_entorno') ): ?>
					<div class="text">
						<p><?php the_field('texto_entorno'); ?></p>
					</div>
					<?php endif;?>
				
				</div>
				<?php endif; //#section2 Entorno?>	
				
				<?php if( get_field('listado_terminaciones') || get_field('galeria_terminaciones')): ?>
				<div id="section-3" class="section">

					<?php  $rows = get_field('listado_terminaciones');  ?>
						
					<?php if($rows) { ?>
					
					<?php echo '<ul class="list">';
					 
						foreach($rows as $row) { ?>
		
				 		<li> <?php echo $row['texto_listado_terminaciones'] ?></li>
		
						<?php } echo '</ul>';  
						
					} ?>

					<?php  $rows = get_field('galeria_terminaciones');  ?>
						
					<?php if($rows) { ?>
					<div class="carousel-gallery flexslider">
					
					<?php echo '<ul class="slides">';
					 
						foreach($rows as $row) { ?>
		
				 		<li><a href="<?php echo $row['imagen_terminaciones'] ?>" class="fancybox" rel="group"> <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_terminaciones'] ?>&w=160&h=120"/></a> </li>
		
						<?php } echo '</ul>';  ?>
						</div>	
					<?php } ?>
	
				</div>
				<?php endif; //#section3 TERMINACIONEs?>	
				
				<?php if( get_field('listado_emplazamiento') || get_field('galeria_emplazamiento')): ?>
				<div id="section-4" class="section">
				
					<?php  $rows = get_field('listado_emplazamiento');  ?>
						
					<?php if($rows) { ?>
					
					<?php echo '<ul class="list">';
					 
						foreach($rows as $row) { ?>
		
				 		<li> <?php echo $row['texto_listado_emplazamiento'] ?></li>
		
						<?php } echo '</ul>';  
						
					} ?>

					<?php $rows = get_field('galeria_emplazamiento');  ?>
						
					<?php if($rows) { ?>
					<div class="carousel-gallery flexslider">
					
					<?php echo '<ul class="slides">';
					 
						foreach($rows as $row) { ?>
						
				 		<li><a href="<?php echo $row['imagen_emplazamiento'] ?>" class="fancybox" rel="group">  <img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['imagen_emplazamiento'] ?>&w=160&h=120"/></a> </li>
		
						<?php } echo '</ul>';  ?>
					</div>	
					<?php } ?>
						
				</div>
				<?php endif; //#section4 EMPLAZAMIENTO ?>	
				
				
				 <?php if( get_field('informacion_plantas')): ?>
				<div id="section-5" class="section-5 section">
				
					<div id="plantas">
						<?php  $rows = get_field('informacion_plantas');  ?>
							
						<?php if($rows) { ?>
						 	<ul>
							<?php foreach($rows as $row) { ?>
								<li>
								<?php if($row['agregar_titulo_planta']) {?>
								<h4><?php echo $row['agregar_titulo_planta'] ?></h4>
								<?php } ?>
								
								<?php if($row['agregar_imagen_planta']) {?>
						 		<span class="img"><a href="<?php echo $row['agregar_imagen_planta'] ?>" class="fancybox"> <span></span><img src="<?php bloginfo('template_url') ?>/timthumb.php?src=<?php echo $row['agregar_imagen_planta'] ?>&w=182&h=142"/></a> </span>
						 		<?php } ?>
						 		
						 		<div class="data">
						 		   <?php if($row['agregar_dividendo']) {?>
						 			<div>
							 			<h5><?php _e('Dividendo:', 'castroytagle') ?></h5> 
							 			<p><?php echo $row['agregar_dividendo'] ?></p>
							 		</div>
							 		<?php } ?>
							 		
							 		<?php if($row['agregar_superficie_total']) {?>
							 		<div>
							 			<h5><?php _e('Superficie Total:', 'castroytagle') ?></h5> 
							 			<p><?php echo $row['agregar_superficie_total'] ?></p>
							 		</div>
							 		<?php } ?>
							 		
							 		<?php if($row['agregar_superficie_construida']) {?>
							 		<div>
							 			<h5><?php _e('Superficie Construída:', 'castroytagle') ?></h5> 
							 			<p><?php echo $row['agregar_superficie_construida'] ?></p>
							 		</div>
							 		<?php } ?>
							 						 		
						 		</div>
						 		
						 		<?php if($row['agregar_valor_planta']) {?>
						 		<div class="value"><?php echo $row['agregar_valor_planta'] ?></div>
						 		<?php } ?>
								</li>
							<?php } ?>
						 	</ul>
						<?php } ?>
						
					</div>
				
				</div>	
				<?php endif; //#section5 PLANTAS ?>
				
				<?php if( get_field('link_a_google') || get_field('ubicacion_propiedad')): ?>
				<div id="section-6" class="section">
					
					<?php if( get_field('ubicacion_propiedad') ): ?>
						<?php 				
						$location = get_field('ubicacion_propiedad');				 
						if( !empty($location) ):
						?>
						<div class="acf-map">
							<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if( get_field('link_a_google') ): ?>
					<a class="back-btn" target="_blank" title="Ver en Google Maps" href="<?php the_field('link_a_google'); ?>"><i class="icon-location"></i><?php _e('Ver Mapa Completo', 'castroytagle') ?></a>
					<?php endif; ?>
				
				</div>
				<?php endif; //#section6 UBICACIón?>
				
				<div id="section-7" class="section">
				
					<div class="contact-data">
						<h3><?php _e('Información de Ventas', 'castroytagle') ?></h3>
					   <?php if( get_field('ejecutiva_contacto') ): ?>
			 			<div>
				 			<h5><?php _e('Ejecutiva:', 'castroytagle') ?></h5> 
				 			<p><?php the_field('ejecutiva_contacto') ?></p>
				 		</div>
				 		<?php endif; ?>
				 		
				 		<?php if( get_field('telefono_contacto') ): ?>
				 		<div>
				 			<h5><?php _e('Teléfono(s) Venta:', 'castroytagle') ?></h5> 
				 			<p><?php the_field('telefono_contacto') ?></p>
				 		</div>
				 		<?php endif; ?>
				 		
				 		<?php if( get_field('horario_contacto') ): ?>
				 		<div>
				 			<h5><?php _e('Horario Sala de Ventas:', 'castroytagle') ?></h5> 
				 			<p><?php the_field('horario_contacto') ?></p>
				 		</div>
				 		<?php endif; ?>
				 		
				 		<?php if( get_field('oficina_ventas') ): ?>
				 		<div>
				 			<h5><?php _e('Oficina Ventas:', 'castroytagle') ?></h5> 
				 			<p><?php the_field('oficina_ventas') ?></p>
				 		</div>
				 		<?php endif; ?>
				 						 		
			 		</div>
				
				</div><!--#section7/Contacto-->		

			</div></div>
			
		</article>

<?php endwhile; // end of the loop. ?>

</div>

<?php get_footer(); ?>
