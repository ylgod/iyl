<?php
/**
 * 文章格式:视频
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if (is_singular()) {
			if ( is_sticky() ) {
			the_title( sprintf( '<h2 class="entry-title"><i class="hjylfont hjyl-top01"></i> <a href="%1$s" title="%2$s" rel="bookmark">', esc_url( get_permalink()), esc_html(get_the_title()) ), '</a></h2>' );
			}else{
			the_title( sprintf( '<h2 class="entry-title"><a href="%1$s" title="%2$s" rel="bookmark">', esc_url( get_permalink()), esc_html(get_the_title()) ), '</a></h2>' );
			}
		}else{
			echo sprintf( '<span class="header-image"><a href="%1$s" title="%2$s" rel="bookmark">', esc_url( get_permalink()), esc_html(get_the_title()) ).'<i class="hjylfont hjyl-zhibo"></i></a></span>';
		}
		?>
		<div class="header-meta">
			<?php if(is_singular()) { ?>
			<span class="author">
				<i class="hjylfont hjyl-user"></i>
				<?php the_author_posts_link(); ?>
			</span>
			<span class="cat-links">
				<i class="hjylfont hjyl-category"></i>
				<?php the_category(', '); ?>
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
			<?php }else{ ?>
			<span class="image-comments-views">
				<?php comments_popup_link( __( '<i class="hjylfont hjyl-comment"></i>', 'iyl' ), __( '<b>1</b>', 'iyl' ), __( '<b>%</b>', 'iyl' ), '', '' ); ?>
			</span>
			<?php edit_post_link( __( '<i class="hjylfont hjyl-edit"></i>', 'iyl' ), '<span class="image-edit-link">', '</span>' ); ?>
			<?php } ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content <?php if(!is_singular()){ ?>image-entry-content<?php } ?>">
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
				global $withcomments; $withcomments = 1;
				comments_template("/inc/index-comments.php",true);
			}
		?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->