<?php
/**
 * SubMenu for Terms
 *
 * @package WordPress
 * @subpackage aasa
 * @since aasa 1.0
 */
?>

<ul id="submenu" class="project">
  <li class="current"><a class="btn-s1" href="javascript:void(0);"><?php _e('Descripción','castroytagle') ?></a></li>
  
  <?php if( get_field('galeria_entorno') || get_field('texto_entorno')): ?>
  	<li><a class="btn-s2" href="javascript:void(0);"><?php _e('Entorno','castroytagle') ?></a></li>
  <?php endif;?>
  
  <?php if( get_field('texto_terminaciones') || get_field('galeria_terminaciones')): ?>
  <li><a class="btn-s3" href="javascript:void(0);"><?php _e('Terminaciones','castroytagle') ?></a></li>
  <?php endif;?>
  
  <?php if( get_field('listado_emplazamiento') || get_field('galeria_emplazamiento')): ?>
  <li><a class="btn-s4" href="javascript:void(0);" rel="m_PageScroll2id"><?php _e('Emplazamiento','castroytagle') ?></a></li>
  <?php endif;?>
  
  <?php if( get_field('informacion_plantas')): ?>
  <li><a class="btn-s5" href="javascript:void(0);" ><?php _e('Plantas','castroytagle') ?></a></li>
  <?php endif;?>
  
  <?php $location = get_field('ubicacion_propiedad');
  if( get_field('link_a_google') || $location['lat'] && $location['lng'] ): ?>
  <li><a class="btn-s6" href="javascript:void(0);" ><?php _e('Ubicación','castroytagle') ?></a></li>
   <?php endif;?>
  
  <li><a class="btn-s7" href="javascript:void(0);" ><?php _e('Contacto','castroytagle') ?></a></li>
</ul>