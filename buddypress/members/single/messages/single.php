<?php
/**
 * Member single message
 *
 * @package BuddyPress
 * @subpackage Templatepack
 */
?>
<?php do_action( 'bp_before_message_thread_content' ); ?>

<?php if ( bp_thread_has_messages() ) : ?>

<div class="messages-content-wrap">

        <?php // h#? h1, h2, h3 ?>
        <h3><?php bp_the_thread_subject(); ?></h3>

        <?php /**  message thread details ************/ ?>

        <p>

            <span>
                <?php if ( !bp_get_the_thread_recipients() ) : ?>

                    <?php _e( 'You are alone in this conversation.', 'buddypress' ); ?>

                <?php else : ?>

                    <?php printf( __( 'Conversation between %s and you.', 'buddypress' ), bp_get_the_thread_recipients() ); ?>

                <?php endif; ?>
            </span>

            <span>
                <a class="button confirm" href="<?php bp_the_thread_delete_link(); ?>" title="<?php _e( 'Delete Message', 'buddypress' ); ?>"><?php _e( 'Delete', 'buddypress' ); ?></a>
            </span>

        </p>

        <?php /**  end message details ************/ ?>


    <?php do_action( 'bp_before_message_thread_list' ); ?>

    <?php while ( bp_thread_messages() ) : bp_thread_the_message(); ?>

    <article class="<?php bp_the_thread_message_alt_class(); ?>">

        <?php /** message metadata ****************/ ?>
        <header>

            <?php do_action( 'bp_before_message_meta' ); ?>

            <p>
                <span>
                    <?php bp_the_thread_message_sender_avatar( 'type=thumb&width=30&height=30' ); ?>
                </span>

                <span>

                    <?php if ( bp_get_the_thread_message_sender_link() ) : ?>

                        <a href="<?php bp_the_thread_message_sender_link(); ?>" title="<?php bp_the_thread_message_sender_name(); ?>"><?php bp_the_thread_message_sender_name(); ?></a>

                    <?php else : ?>

                        <?php bp_the_thread_message_sender_name(); ?>

                    <?php endif; ?>

                </span>

                <span>

                    <?php bp_the_thread_message_time_since(); ?>

                </span>

            </p>

            <?php do_action( 'bp_after_message_meta' ); ?>

        </header>
        <?php /** end message metadata ************/ ?>

        <?php do_action( 'bp_before_message_content' ); ?>

        <div class="message-content">

            <?php bp_the_thread_message_content(); ?>

        </div>

        <?php do_action( 'bp_after_message_content' ); ?>

    </article>

<?php endwhile; ?>

<?php /**               Here be the reply form, this needs some work
                        and is copied here with only basic revisions to markup with some div bloat removed
                        but may need to be put.
                        The classes are carried over from existing form as likely necessary?
                        */ ?>

        <form id="send-reply" action="<?php bp_messages_form_action(); ?>" method="post" class="standard-form">


                <div class="message-metadata">

                    <?php do_action( 'bp_before_message_meta' ); ?>

                    <div class="avatar-box">

                        <?php bp_loggedin_user_avatar( 'type=thumb&height=30&width=30' ); ?>

                        <span><?php _e( 'Send a Reply', 'buddypress' ); ?></span>

                    </div>

                    <?php do_action( 'bp_after_message_meta' ); ?>

                </div><!-- .message-metadata -->

                <div class="message-content">

                    <?php do_action( 'bp_before_message_reply_box' ); ?>

                    <textarea name="content" id="message_content" rows="15" cols="40"></textarea>

                    <?php do_action( 'bp_after_message_reply_box' ); ?>

                    <div class="submit">
                        <input type="submit" name="send" value="<?php _e( 'Send Reply', 'buddypress' ); ?>" id="send_reply_button"/>
                    </div>

                    <input type="hidden" id="thread_id" name="thread_id" value="<?php bp_the_thread_id(); ?>" />
                    <input type="hidden" id="messages_order" name="messages_order" value="<?php bp_thread_messages_order(); ?>" />
                    <?php wp_nonce_field( 'messages_send_message', 'send_message_nonce' ); ?>

                </div><!-- .message-content -->

        </form><!-- #send-reply -->

</div><!-- / .messages-content-wrap -->

<?php endif; ?>
