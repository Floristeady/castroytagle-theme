<div id="breadcrumbs" class="resize">
	
	<p><a href="/"> <?php _e('Home') ?></a><span> > </span>
	<a href="/?types_two=todos"> <?php _e('Proyecto Realizados') ?></a><span> > </span>
	
	<?php
	global $post;
	$tipo = "";
	$terms = wp_get_post_terms( $post->ID, 'types_two');
	
	foreach ($terms as $term) {
		echo '<a href="' . get_bloginfo('url') . '/?types_two=' . $term->slug . '" >' . $term->name . '</a><span> > </span>';
		$tipo = $term->slug;
		break;
	}

	?>
			
	<?php the_title(); ?>
	
	</p>
</div>