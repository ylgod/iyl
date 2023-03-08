<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'iyl' ); ?></p>
<?php return;endif; ?>
<?php if ( have_comments() ) : ?>
		<h3 id="comments-title"><span><i class="hjylfont hjyl-comment"></i><?php comments_popup_link( __( ' Leave a reply', 'iyl' ), __( ' 1 Comment ', 'iyl' ), __( ' % Comments', 'iyl' ),'comments-views',__( ' Comments Off', 'iyl' ) ); ?></span></h3>
	<div class="commentlist single-commentlist" id="comments">
        <ol>
		<?php wp_list_comments( array( 'callback' => 'hjyl_index_comment','type' => 'comment' ) );?>
			<p id="comments-nav">
				<?php paginate_comments_links('prev_text='.__('Previous', 'iyl').'&next_text='.__('Next', 'iyl').'');?>
			</p>
    </ol>
</div>
<?php endif; ?>

<?php 
		
		$aria_req = ( $req ? " aria-required='true'" : '' );
       	$fields =  array(
        'author' => '<div id="comment-author-info" class="row screen-reader-text"><p class="comment-form-author"><label for="author" class="screen-reader-text">'.__( 'Name*', 'iyl' ).'</label><i class="hjylfont hjyl-user"></i><input class="form-control" id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ) . '" size="10"' . $aria_req . 'placeholder="'.__( 'Name*', 'iyl' ).'" /></p>',
        'email'  => '<p class="comment-form-email"><label for="email" class="screen-reader-text">'.__( 'Email*', 'iyl' ).'</label><i class="hjylfont hjyl-email"></i><input class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="10"' . $aria_req . ' placeholder="'.__( 'Email*', 'iyl' ).'" /></p>',
        'url'    => '<p class="comment-form-url"><label for="url" class="screen-reader-text">'.__( 'Website*', 'iyl' ).'</label><i class="hjylfont hjyl-link"></i><input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="10" placeholder="'.__( 'Website', 'iyl' ).'" /></p></div>',
    );
    $comment_form_args = array(
        'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
        'comment_field'        => '<p class="comment-form-comment"><textarea class="form-control" ' . $aria_req . ' rows="1" cols="10" name="comment" id="comment" placeholder="'.__('Click here and Reply...', 'iyl').'"></textarea></p>',
        'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'iyl' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
        'comment_notes_before' => null,
        'comment_notes_after'  => null,
        'id_form'              => 'commentform',
        'class_form'           => 'comment-form',
        'id_submit'            => 'submit',
        'class_submit'         => 'btn btn-danger screen-reader-text',
        'title_reply'          => null,
        'title_reply_to'       => __( 'Leave a Reply to %s', 'iyl'),
        'cancel_reply_link'    => __( 'Cancel reply', 'iyl'),
        'label_submit'         => __( 'Post Comment', 'iyl'),
    );
    comment_form($comment_form_args);
 ?>


<?php
    /*output Trackbacks and Pingbacks*/
    $havepings="pings";
    foreach($comments as $comment){
        if(get_comment_type() != 'comment' && $comment->comment_approved != '0'){
        $havepings = 1;
        break;
    }}if($havepings == 1) :
?>
<div id="pings">
	<h3 id="pings-title"><span><i class="hjylfont hjyl-link"></i><a><?php _e('Pingbacks', 'iyl'); ?></a></span></h3>
		<ul id="pinglist"><?php wp_list_comments('type=pings&per_page=0&callback=hjyl_pings'); ?></ul>
</div>

<?php endif; ?>