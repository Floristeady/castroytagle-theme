<div id="breadcrumbs">
	
	<p class="resize"><a href="/"> <?php _e('Home') ?></a> > 
	
	<?php
	global $post;
	$tipo = "";
	$terms = wp_get_post_terms( $post->ID, 'types');
	
	foreach ($terms as $term) {
		echo '<a href="' . get_bloginfo('url') . '/?types=' . $term->slug . '" >' . $term->name . ' > </a>';
		$tipo = $term->slug;
		break;
	}
	
	$cities = wp_get_post_terms( $post->ID, 'cities');
	
	foreach ($cities as $city) {
		echo '<a href="' . get_bloginfo('url') . '/?types=' . $tipo . '&cities='. $city->slug.'" >' . $city->name . ' > </a>';
		//echo $city->name . ' > ';
		break;
	}
	
	?>
			
	<?php the_title(); ?>
	
	</p>
</div>