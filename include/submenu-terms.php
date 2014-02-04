<?php
/**
 * SubMenu for Terms
 *
 * @package WordPress
 * @subpackage aasa
 * @since aasa 1.0
 */
?>


<?php

$args = array(
  'taxonomy'     => 'types_two',
  'hide_empty'   => 1,
  'orderby'      => 'name',
  'show_count'   => 0,      // 1 for yes, 0 for no
  'pad_counts'   => 0,      // 1 for yes, 0 for no
  'hierarchical' => 0,      // 1 for yes, 0 for no
  'order'        => 'DESC',
  'title_li'     => ''
);
?>
<ul id="submenu">
  <?php wp_list_categories( $args ); ?>
</ul>