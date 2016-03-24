<div id="breadcrumbs" class="resize">
	<p class="resize"><a href="/"> 
	<?php _e('Home') ?></a> <span> > </span> <?php if($post->post_parent) {
	$parent_title = get_the_title($post->post_parent);
	echo $parent_title.'<span> > </span>';
	} ?> <?php the_title(); ?></p>
</div>