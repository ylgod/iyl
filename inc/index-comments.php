<?php if ( post_password_required() ) : ?>
<?php return;endif; ?>
<?php if ( have_comments() ) : ?>
<div class="commentlist index-commentlist" id="comments">
	<i class="hjylfont hjyl-comment1"></i>
	<ol>
	<?php wp_list_comments( array( 'callback' => 'hjyl_index_comment', 'type' => 'comment', 'format' => 'html5', 'per_page' => 3, 'reverse_top_level' => true, 'reverse_children' => true ));?>
    <p id="comments-nav">
        <?php paginate_comments_links('prev_text='.__('Previous', 'iyl').'&next_text='.__('Next', 'iyl').''); ?>
    </p>
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
        'logged_in_as'         => null,
        'comment_notes_before' => null,
        'comment_notes_after'  => null,
        'id_form'              => 'commentform',
        'class_form'              => 'commentform-'.get_the_ID(),
        'id_submit'            => 'submit',
        'class_submit'            => 'btn btn-danger screen-reader-text',
        'title_reply'          => null,
        'title_reply_to'       => __( 'Leave a Reply to %s', 'iyl'),
        'cancel_reply_link'    => __( 'Cancel reply', 'iyl'),
        'label_submit'         => __( 'Post Comment', 'iyl'),
    );
    comment_form($comment_form_args);
 ?>
 </ol>
</div>
<?php endif; ?>