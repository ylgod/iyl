<?php
//首页评论列表模板
if ( ! function_exists( 'hjyl_index_comment' ) ) :
function hjyl_index_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) { 
		$page = ( get_query_var('cpage') ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );
		$cpp=get_option('comments_per_page');
		$commentcount = $cpp * ($page - 1);
	}
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<?php if(is_singular()) { ?>
		<span class="floor">
			<?php if (!empty(get_option('thread_comments'))) { ?>
				<?php if(!$parent_id = $comment->comment_parent) {printf('#%s', ++$commentcount);} ?>
			<?php }else{ ?>
				<?php printf('#%s', ++$commentcount); ?>
			<?php } ?>
		</span>
		<?php } ?>
		<div id="comment-<?php comment_ID(); ?>" class="comment">
		<div class="comment-author vcard">
			<?php
				echo get_avatar( $comment, 32, $default="", $comment->comment_author );
			?>
			<div class="comment_meta">
				<?php printf( '<cite class="fn"> %s </cite>', get_comment_author_link() ); ?>
				<?php if(function_exists('wpua_custom_output')) {wpua_custom_output();} //支持WP-UserAgent插件 ?>
			<span class="reply">
                <?php
                $defaults = array('add_below' => 'comment', 'respond_id' => 'respond', 'reply_text' => '<span class="reply-button">-<i class="hjylfont hjyl-at"></i></span>');
                comment_reply_link(array_merge($defaults, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
                ?>
			</span><!-- .reply -->
			</div>
		</div><!-- .comment-author .vcard -->
			<div class="comment-body">
				<?php comment_text(); ?>
				<p><a class="comment_time" href="#comment-<?php comment_ID() ?>" title="<?php printf( '%s', comment_date('Y/m/d '),  comment_time()); ?>"><?php printf(__('%s','iyl'), time_ago()); ?></a></p>
			</div>

				
		</div><!-- #comment-##  -->

<?php }endif;
//pingback and trackback
function hjyl_pings($comment, $args, $depth) {
    if('pingback' == get_comment_type()) $pingtype = 'Pingback';
    else $pingtype = 'Trackback';
	$GLOBALS['comment'] = $comment;
?>
    <li id="comment-<?php echo $comment->comment_ID ?>">
        [<?php echo $pingtype; ?>] <?php comment_author_link(); ?>
		<span class="ping_time"><?php echo mysql2date('Y.m.d', $comment->comment_date); ?></span>
<?php }

// WordPress AJAX Comments
if(!function_exists('fa_ajax_comment_err')) :

    function fa_ajax_comment_err($a) {
        header('HTTP/1.0 500 Internal Server Error');
        header('Content-Type: text/plain;charset=UTF-8');
        echo $a;
        exit;
    }

endif;

if(!function_exists('fa_ajax_comment_callback')) :

    function fa_ajax_comment_callback(){
        $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
        if ( is_wp_error( $comment ) ) {
            $data = $comment->get_error_data();
            if ( ! empty( $data ) ) {
            	fa_ajax_comment_err($comment->get_error_message());
            } else {
                exit;
            }
        }
        $user = wp_get_current_user();
        do_action('set_comment_cookies', $comment, $user);
        $GLOBALS['comment'] = $comment; //Modify according to your comment structure. If you use the default topic, you don't need to modify
        ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>"  class="comment">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'iyl' ); ?></em><br />
				<?php endif; ?>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment,$size='32',$comment->comment_author); ?>
				<div class="comment-meta">
					<h4><?php printf( __( '%s', 'iyl'), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h4>
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" title="<?php printf( __( '%1$s at %2$s', 'iyl' ), get_comment_date(),  get_comment_time() ); ?>"><?php printf(__('%s','iyl'), time_ago()); ?></a>
				</div>
				</div>
				<div class="comment-body"><?php comment_text(); ?></div>
			</div>
        </li>
        <?php die();
    }

endif;

add_action('wp_ajax_nopriv_ajax_comment', 'fa_ajax_comment_callback');
add_action('wp_ajax_ajax_comment', 'fa_ajax_comment_callback');
