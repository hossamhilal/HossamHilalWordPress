<?php
if (post_password_required()) {
    return;
}
?>

<?php ?>
<?php if (have_comments()) : ?>
    <div id="comments" class="comments-area sec-block">

        <div class="title-head sec-title">
            <h4>
                التعليقات
                <span>
                (
                    <?php printf(esc_html(_n('One', '%1$s', get_comments_number(), 'razz')), number_format_i18n(get_comments_number())); ?>
                    )
            </span>
            </h4>
        </div>
        <div class="sec-content">
            <ol class="comments_list comments-wrapper">
                <?php wp_list_comments(array('callback' => 'razz_comment', 'style' => 'ol')); ?>
            </ol>
            <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through  ?>
                <nav id="comment-nav-below" class="navigation" role="navigation">
                    <h1 class="assistive-text section-heading"><?php esc_html_e('Comment navigation', 'razz'); ?></h1>
                    <div
                            class="nav-previous"><?php previous_comments_link(esc_html__('&larr; Older Comments', 'razz')); ?></div>
                    <div
                            class="nav-next"><?php next_comments_link(esc_html__('Newer Comments &rarr;', 'razz')); ?></div>
                </nav>
            <?php endif; ?>
            <?php if (!comments_open() && get_comments_number()) : ?>
                <p class="nocomments"><?php esc_html_e('Comments are closed.', 'razz'); ?></p>
            <?php endif; ?>


        </div>
    </div>
<?php endif; ?>

    <div class="sec-block comments-boxs">
        <div class="sec-title"> اترك تعليق :</div>
        <div class="sec-content">
            <?php
            $commenter = wp_get_current_commenter();
            $req = get_option('require_name_email');
            $aria_req = ($req ? " aria-required='true'" : '');
            $args = array(
                'id_form' => 'commentform',
                'id_submit' => 'submit-comment',
                'class_submit' => 'btn btn-colored',
                'title_reply' => esc_html__('اترك تعليق', 'razz'),
                'title_reply_to' => esc_html__('اترك تعليق على  %s', 'razz'),
                'title_reply_before' => '<div class="title-head"> <h4 id="reply-title" class="comment-reply-title"><span>',
                'title_reply_after' => '</span></h4> </div>',
                'cancel_reply_link' => esc_html__('الغاء الرد', 'razz'),
                'label_submit' => esc_html__('نشر', 'razz'),
                'comment_field' => '<div class="field"><textarea id="comment" class="form-control" placeholder="' . esc_html__(' التعليق  ', 'razz') . '" name="comment"  aria-required="true"></textarea></div>',
                'must_log_in' => '<p class="must-log-in">' . sprintf(__('You must be <a href="%s">logged in</a> to post a comment.', 'razz'), esc_url(wp_login_url(apply_filters('the_permalink', get_permalink())))) . '</p>',
                'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'razz'), esc_url(admin_url('profile.php')), esc_html($user_identity), esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink())))) . '</p>',
                'comment_notes_after' => '',
                'fields' => apply_filters('comment_form_default_fields',
                    array(
                        'author' => '<div class="field"><input id="author" name="author" class="form-control comment-author" type="text" placeholder="' . esc_html__('الاسم *', 'razz') . '" value="' . esc_attr($commenter['comment_author']) . '" size="40"' . $aria_req . ' /></div>',
                        'email' => '<div class="field"><input id="email" name="email" class="form-control comment-email" type="text" placeholder="' . esc_html__('البريد الالكترونى *', 'razz') . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="400"' . $aria_req . ' /></div>',
                        'url' => '<div class="field"><input id="url" name="url" class="form-control comment-website" type="text" placeholder="' . esc_html__('الموقع', 'razz') . '" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></div>'
                    )
                )
            );
            ?>
            <?php comment_form($args); ?>
        </div>
    </div>
