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
	$currentCitie = "";
	$currentTodos = "";
	if (isset($_GET["cities"])) {
		$currentCitie = $_GET["cities"];
	} else {
		$currentTodos = "current";
	}
	$taxonomy = 'cities';
	$tax_terms = get_terms($taxonomy);
	?>
	<ul id="submenu">
		
		<?php
				
		echo '<li class="'.$currentTodos.'">' . '<a href="' . get_bloginfo('url') . '/?types='.$title.'" title="' . sprintf( __( "View all posts in %s" ), $title ) . '" ' . ' >Ver todos</a></li>';
		
		foreach ($tax_terms as $tax_term) {
		$class = "";
		if ($currentCitie == $tax_term->slug) {
			$class = "current";
		}
		
		/*Código para verificar si tiene entradas una determinada ciudad para un determinado tipo de construccion*/
		$args = array(
		    'post_type' => 'projectsale',
		    'post_status' => 'published',
		    'cities' => $tax_term->slug,
		    'types' => $term->slug,
		    'numberposts' => -1
		);
		$num = count( get_posts( $args ) );
		//Preguntamos si el numero de entradas es mayor que 0 para mostrarlo, en caso contrario no se muestra
			if ($num > 0) {
			echo '<li class="'.$class.'">' . '<a href="' . get_bloginfo('url') . '/?types='.$term->slug.'&cities='.$tax_term->slug.'" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . 'class="'.$class.'">' . $tax_term->name.'</a></li>';
			} //Fin if ($num > 0)
		} 

		?>
		
	</ul>