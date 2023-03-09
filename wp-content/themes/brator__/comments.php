<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package brator
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

// You can start editing here -- including this comment!
if ( have_comments() ) :
	$comment_close = '';
	if ( ! comments_open() ) :
		$comment_close = 'comment-close';
		endif;
	?>
	<div id="comments-area" class="blog-comment-list-area <?php echo esc_attr( $comment_close ); ?>">
		<div class="blog-comment-list-header">
			<h4>
				<?php
				$brator_comment_count = get_comments_number();
				if ( '1' === $brator_comment_count ) {
					printf(
							/* translators: 1: title. */
						esc_html__( 'One Comment', 'brator' )
					);
				} else {
					printf(// WPCS: XSS OK.
							/* translators: 1: comment count number, 2: title. */
						esc_html( _nx( '%1$s Comment', '%1$s Comments ', $brator_comment_count, 'comments title', 'brator' ), 'brator' ),
						number_format_i18n( $brator_comment_count )
					);
				}
				?>
			</h4>
		</div>
		<?php
		if ( have_comments() ) :
			the_comments_navigation();
			?>
			<div class="blog-comment-list-items">
			<?php
			wp_list_comments(
				array(
					'style'      => 'div',
					'callback'   => 'brator_comments',
					'short_ping' => true,
				)
			);
			?>
			</div>
			<?php
				the_comments_navigation();
				// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() ) :
				?>
					<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'brator' ); ?></p>
					<?php
				endif;
			endif;
		?>
	</div>
	<?php
endif; // Check for have_comments().

$is_no_post_thumb = 'comments-form-area';
if ( ! have_comments() ) {
	$is_no_post_thumb = 'comments-form-area no-comment';
}
if ( comments_open() ) :
	$user                 = wp_get_current_user();
	$brator_user_identity = $user->display_name;
	$req                  = get_option( 'require_name_email' );
	$aria_req             = $req ? " aria-required='true'" : '';
	$formargs             = array(
		'class_form'           => 'brator-contact-form-fields blog-post-comment-box-area',
		'class_container'      => $is_no_post_thumb,
		'title_reply'          => esc_html__( 'Leave a Comment', 'brator' ),
		'title_reply_to'       => esc_html__( 'Leave a Comment to %s', 'brator' ),
		'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'brator' ),
		'title_reply_before'   => '<div class="brator-contact-form-area blog-post-comment-header-area"><div class="brator-contact-form-header"><h2 id="reply-title" class="comment-reply-title">',
		'title_reply_after'    => '</h2></div></div>',
		'submit_field'         => '<div class="brator-contact-form-field submit-button">%1$s %2$s</div>',
		'label_submit'         => esc_html__( 'Submit Comment', 'brator' ),
		'comment_notes_before' => '',
		'submit_button'        => '<button type="submit" name="%1$s" id="%2$s" class="%3$s">%4$s</button>',
		'comment_field'        => '<div class="brator-contact-form-field"><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Write your comment here', 'brator' ) . '">' .
		'</textarea></div>',
		'must_log_in'          => '<div>' . sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'brator' ), array( 'a' => array( 'href' => array() ) ) ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</div>',
		'logged_in_as'         => '<div class="logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="%4$s">Log out?</a>', 'brator' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'profile.php' ) ), $brator_user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ), esc_attr__( 'Log out of this account', 'brator' ) ) . '</div>',
		'comment_notes_after'  => '',
		'fields'               => apply_filters(
			'comment_form_default_fields',
			array(
				'author' =>
				'<div class="brator-contact-form-field-two-items"><div class="brator-contact-form-field">'
				. '<input id="author"  name="author" type="text" placeholder="' . esc_attr__( 'Name', 'brator' ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30"' . $aria_req . ' /></div>',
				'email'  =>
				'<div class="brator-contact-form-field">'
				. '<input id="email" name="email" type="text" placeholder="' . esc_attr__( 'Your Email *', 'brator' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
				'" size="30"' . $aria_req . ' /></div></div>',
			)
		),
	);

	comment_form( $formargs );
endif;
