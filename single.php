<?php get_header(); ?>
<?php
	if ( have_posts() ) :
	while ( have_posts() ) :
	the_post();
	get_template_part( 'inc/content', get_post_format() );
	comments_template( '', true );
	endwhile;	
?>
<nav id="nav-single">
	<p class="nav-previous"><?php previous_post_link( '%link', __( 'Previous: %title', 'iyl' ) ); ?></p>
	<p class="nav-next"><?php next_post_link( '%link', __( 'Next: %title', 'iyl' ) ); ?></p>
</nav><!-- #nav-single -->
<?php 
	else :
	get_template_part( 'inc/content','none' ); 
	endif;
	get_sidebar();
	get_footer();
?>