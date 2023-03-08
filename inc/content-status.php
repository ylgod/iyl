<?php
/**
 * 文章格式:状态
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="status-avatar"><a href="<?php echo esc_url( the_permalink() ); ?>" title="<?php the_title_attribute( array( 'before' => '', 'after' => '' ) ); ?>" rel="bookmark"><?php echo get_avatar(get_the_author_meta('user_email'), '48');?></a></div>
		<div class="header-meta">
			<span class="author" title="<?php _e('Posted by', 'iyl'); ?>">
				<i class="hjylfont hjyl-user"></i>
				<?php the_author_posts_link(); ?>
			</span>
			<span class="last-updated" title="<?php if ((get_the_modified_time('Y')*365+get_the_modified_time('z')) > (get_the_time('Y')*365+get_the_time('z'))) : ?><?php the_modified_time('Y-m-d H:i:s'); ?><?php else : ?><?php the_time('Y-m-d H:i:s'); ?><?php endif; ?>">
				<i class="hjylfont hjyl-time"></i>
				<?php echo timeago(get_gmt_from_date(get_the_time('Y-m-d H:i:s'))); ?>	
			</span>
			<span class="comments-views">
				<i class="hjylfont hjyl-comment"></i>
				<?php comments_popup_link( __( 'Leave a reply', 'iyl' ), __( '<b>1</b>', 'iyl' ), __( '<b>%</b>', 'iyl' ) ); ?>
			</span>
			<?php edit_post_link( __( 'Edit', 'iyl' ), '<span class="edit-link"><i class="hjylfont hjyl-edit"></i>', '</span>' ); ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( 
				sprintf( 
					__( 'Continue reading%s', 'iyl' ), 
					'<span class="screen-reader-text">  '.get_the_title().'</span>' 
				) 
			);
			wp_link_pages( array( 'before' => '<nav class="page-link"><i class="hjylfont hjyl-feed1"></i><span>' . __( 'Pages:', 'iyl' ) . '</span>', 'after' => '</nav>' ) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php 
			if(is_single()) {
				the_tags('<span class="tags"><i class="hjylfont hjyl-discount"></i>', ', ', '</span>');
			 }
		?>
		<?php
			if(is_home()){
				global $withcomments; $withcomments = true; comments_template("/inc/index-comments.php");
			}
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
