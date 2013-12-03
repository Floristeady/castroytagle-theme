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
				
		echo '<li class="'.$currentTodos.'">' . '<a href="' . get_bloginfo('url') . '/?types='.$title.'" title="' . sprintf( __( "View all posts in %s" ), $title ) . '" ' . ' >Ver todo</a></li>';
		
		foreach ($tax_terms as $tax_term) {
		$class = "";
		if ($currentCitie == $tax_term->slug) {
			$class = "current";
		}
		echo '<li class="'.$class.'">' . '<a href="' . get_bloginfo('url') . '/?types='.$term->slug.'&cities='.$tax_term->slug.'" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
		} 

		?>
	</ul>