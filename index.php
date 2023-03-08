<?php get_header(); ?>
<?php
	if ( have_posts() ) :
	while ( have_posts() ) :
	the_post();
	get_template_part( 'inc/content', get_post_format() );
	endwhile;
?>
<nav class="hjylNav">
	<?php
	// 翻页导航.
	the_posts_pagination( array(
	'prev_text'          => __('Prev', 'iyl'),
	'next_text'          => __('Next', 'iyl'),
	) );
	?>
</nav>
<?php 
	else :
	get_template_part( 'inc/content','none' ); 
	endif;
	get_sidebar();
	get_footer();
?>