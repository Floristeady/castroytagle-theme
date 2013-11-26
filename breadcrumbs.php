<div id="breadcrumbs">
	<p class="resize"><a href="/"> <?php _e('Home') ?></a> > <?php if($post->post_parent) {
										$parent_title = get_the_title($post->post_parent);
										echo $parent_title.' > ';
										} ?> <?php the_title(); ?></p>
</div>