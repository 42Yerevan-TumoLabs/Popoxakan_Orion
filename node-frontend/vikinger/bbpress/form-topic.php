<?php

/**
 * New/Edit Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

if ( ! bbp_is_single_forum() ) : ?>

<div id="bbpress-forums" class="bbpress-wrapper">

	<?php bbp_breadcrumb(); ?>

<?php endif; ?>

<?php if ( bbp_is_topic_edit() ) : ?>
  
  <?php

    $topic_last_activity_description_data = vikinger_bbpress_topic_last_activity_description_get(bbp_get_topic_id());

    /**
     * Forum Description Notice
     */
    get_template_part('template-part/forum/forum-description-notice', null, [
      'last_activity_description_data' => $topic_last_activity_description_data
    ]);

  ?>

	<?php bbp_get_template_part( 'alert', 'topic-lock' ); ?>

<?php endif; ?>

<?php if ( bbp_current_user_can_access_create_topic_form() ) : ?>

	<div id="new-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-form">

		<form id="new-post" name="new-post" method="post">

			<?php do_action( 'bbp_theme_before_topic_form' ); ?>

			<fieldset class="bbp-form">
				<legend>

					<?php
						if ( bbp_is_topic_edit() ) :
							printf( esc_html__( 'Now Editing &ldquo;%s&rdquo;', 'vikinger' ), bbp_get_topic_title() );
						else :
							( bbp_is_single_forum() && bbp_get_forum_title() )
								? printf( esc_html__( 'Create New Topic in &ldquo;%s&rdquo;', 'vikinger' ), bbp_get_forum_title() )
								: esc_html_e( 'Create New Topic', 'vikinger' );
						endif;
					?>

        </legend>
        
        <!-- VIKINGER FORUM TOPIC FORM WRAP -->
        <div class="vikinger-forum-topic-form-wrap">

				<?php do_action( 'bbp_theme_before_topic_form_notices' ); ?>

				<?php if ( ! bbp_is_topic_edit() && bbp_is_forum_closed() ) : ?>

					<div class="bbp-template-notice">
						<ul>
							<li><?php esc_html_e( 'This forum is marked as closed to new topics, however your posting capabilities still allow you to create a topic.', 'vikinger' ); ?></li>
						</ul>
					</div>

				<?php endif; ?>

				<?php if ( current_user_can( 'unfiltered_html' ) ) : ?>

					<div class="bbp-template-notice">
						<ul>
							<li><?php esc_html_e( 'Your account has the ability to post unrestricted HTML content.', 'vikinger' ); ?></li>
						</ul>
					</div>

				<?php endif; ?>

				<?php do_action( 'bbp_template_notices' ); ?>

				<div>

					<?php bbp_get_template_part( 'form', 'anonymous' ); ?>

					<?php do_action( 'bbp_theme_before_topic_form_title' ); ?>

          <!-- FORM ITEM -->
          <div class="form-item">
            <!-- FORM INPUT -->
            <div class="form-input small">
              <label for="bbp_topic_title"><?php printf( esc_html__( 'Topic Title (Maximum Length: %d):', 'vikinger' ), bbp_get_title_max_length() ); ?></label>
              <input type="text" id="bbp_topic_title" value="<?php bbp_form_topic_title(); ?>" size="40" name="bbp_topic_title" maxlength="<?php bbp_title_max_length(); ?>" />
            </div>
            <!-- /FORM INPUT -->
          </div>
          <!-- /FORM ITEM -->

					<?php do_action( 'bbp_theme_after_topic_form_title' ); ?>

					<?php do_action( 'bbp_theme_before_topic_form_content' ); ?>

					<?php bbp_the_content( array( 'context' => 'topic' ) ); ?>

					<?php do_action( 'bbp_theme_after_topic_form_content' ); ?>

					<?php if ( ! ( bbp_use_wp_editor() || current_user_can( 'unfiltered_html' ) ) ) : ?>

						<p class="form-allowed-tags">
							<label><?php printf( esc_html__( 'You may use these %s tags and attributes:', 'vikinger' ), '<abbr title="HyperText Markup Language">HTML</abbr>' ); ?></label><br />
							<code><?php bbp_allowed_tags(); ?></code>
						</p>

					<?php endif; ?>

					<?php if ( bbp_allow_topic_tags() && current_user_can( 'assign_topic_tags', bbp_get_topic_id() ) ) : ?>

            <?php do_action( 'bbp_theme_before_topic_form_tags' ); ?>
            
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- FORM INPUT -->
              <div class="form-input small">
                <label for="bbp_topic_tags"><?php esc_html_e( 'Topic Tags:', 'vikinger' ); ?></label>
                <input type="text" value="<?php bbp_form_topic_tags(); ?>" size="40" name="bbp_topic_tags" id="bbp_topic_tags" <?php disabled( bbp_is_topic_spam() ); ?> />
              </div>
              <!-- /FORM INPUT -->
            </div>
            <!-- /FORM ITEM -->

						<?php do_action( 'bbp_theme_after_topic_form_tags' ); ?>

					<?php endif; ?>

					<?php if ( ! bbp_is_single_forum() ) : ?>

            <?php do_action( 'bbp_theme_before_topic_form_forum' ); ?>
            
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- FORM SELECT -->
              <div class="form-select">
                <label for="bbp_forum_id"><?php esc_html_e( 'Forum:', 'vikinger' ); ?></label>
              <?php
								bbp_dropdown( array(
									'show_none' => esc_html__( '&mdash; No forum &mdash;', 'vikinger' ),
									'selected'  => bbp_get_form_topic_forum()
								) );
							?>
              <?php

                /**
                 * Icon SVG
                 */
                get_template_part('template-part/icon/icon', 'svg', [
                  'icon'      => 'small-arrow',
                  'modifiers' => 'form-select-icon'
                ]);

              ?>
              </div>
              <!-- /FORM SELECT -->
            </div>
            <!-- /FORM ITEM -->

						<?php do_action( 'bbp_theme_after_topic_form_forum' ); ?>

					<?php endif; ?>

					<?php if ( current_user_can( 'moderate', bbp_get_topic_id() ) ) : ?>

            <?php do_action( 'bbp_theme_before_topic_form_type' ); ?>

            <div class="form-row split">
            
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- FORM SELECT -->
              <div class="form-select">
                <label for="bbp_stick_topic"><?php esc_html_e( 'Topic Type:', 'vikinger' ); ?></label>
              <?php bbp_form_topic_type_dropdown(); ?>
              <?php

                /**
                 * Icon SVG
                 */
                get_template_part('template-part/icon/icon', 'svg', [
                  'icon'      => 'small-arrow',
                  'modifiers' => 'form-select-icon'
                ]);

              ?>
              </div>
              <!-- /FORM SELECT -->
            </div>
            <!-- /FORM ITEM -->

						<?php do_action( 'bbp_theme_after_topic_form_type' ); ?>

            <?php do_action( 'bbp_theme_before_topic_form_status' ); ?>
            
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- FORM SELECT -->
              <div class="form-select">
                <label for="bbp_topic_status"><?php esc_html_e( 'Topic Status:', 'vikinger' ); ?></label>
              <?php bbp_form_topic_status_dropdown(); ?>
              <?php

                /**
                 * Icon SVG
                 */
                get_template_part('template-part/icon/icon', 'svg', [
                  'icon'      => 'small-arrow',
                  'modifiers' => 'form-select-icon'
                ]);

              ?>
              </div>
              <!-- /FORM SELECT -->
            </div>
            <!-- /FORM ITEM -->

            <?php do_action( 'bbp_theme_after_topic_form_status' ); ?>
                </div>

					<?php endif; ?>

					<?php if ( bbp_is_subscriptions_active() && ! bbp_is_anonymous() && ( ! bbp_is_topic_edit() || ( bbp_is_topic_edit() && ! bbp_is_topic_anonymous() ) ) ) : ?>

            <?php do_action( 'bbp_theme_before_topic_form_subscriptions' ); ?>
            
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- CHECKBOX WRAP -->
              <div class="checkbox-wrap">
                <input name="bbp_topic_subscription" id="bbp_topic_subscription" type="checkbox" value="bbp_subscribe" <?php bbp_form_topic_subscribed(); ?> />

                <!-- CHECKBOX BOX -->
                <div class="checkbox-box">
                <?php

                  /**
                   * Icon SVG
                   */
                  get_template_part('template-part/icon/icon', 'svg', [
                    'icon'  => 'cross'
                  ]);

                ?>
                </div>
                <!-- /CHECKBOX BOX -->

              <?php if ( bbp_is_topic_edit() && ( bbp_get_topic_author_id() !== bbp_get_current_user_id() ) ) : ?>

                <label for="bbp_topic_subscription"><?php esc_html_e( 'Notify the author of follow-up replies via email', 'vikinger' ); ?></label>

              <?php else : ?>

                <label for="bbp_topic_subscription"><?php esc_html_e( 'Notify me of follow-up replies via email', 'vikinger' ); ?></label>

              <?php endif; ?>
              </div>
              <!-- /CHECKBOX WRAP -->
            </div>
            <!-- /FORM ITEM -->

						<?php do_action( 'bbp_theme_after_topic_form_subscriptions' ); ?>

					<?php endif; ?>

					<?php if ( bbp_allow_revisions() && bbp_is_topic_edit() ) : ?>

            <?php do_action( 'bbp_theme_before_topic_form_revisions' ); ?>
            
            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- CHECKBOX WRAP -->
              <div class="checkbox-wrap">
                <input name="bbp_log_topic_edit" id="bbp_log_topic_edit" type="checkbox" value="1" <?php bbp_form_topic_log_edit(); ?> />

                <!-- CHECKBOX BOX -->
                <div class="checkbox-box">
                <?php

                  /**
                   * Icon SVG
                   */
                  get_template_part('template-part/icon/icon', 'svg', [
                    'icon'  => 'cross'
                  ]);

                ?>
                </div>
                <!-- /CHECKBOX BOX -->

                <label for="bbp_log_topic_edit"><?php esc_html_e( 'Keep a log of this edit:', 'vikinger' ); ?></label>
              </div>
              <!-- /CHECKBOX WRAP -->
            </div>
            <!-- /FORM ITEM -->

            <!-- FORM ITEM -->
            <div class="form-item">
              <!-- FORM INPUT -->
              <div class="form-input small">
                <label for="bbp_topic_edit_reason"><?php printf( esc_html__( 'Optional reason for editing:', 'vikinger' ), bbp_get_current_user_name() ); ?></label>
                <input type="text" value="<?php bbp_form_topic_edit_reason(); ?>" size="40" name="bbp_topic_edit_reason" id="bbp_topic_edit_reason" />
              </div>
              <!-- /FORM INPUT -->
            </div>
            <!-- /FORM ITEM -->

						<?php do_action( 'bbp_theme_after_topic_form_revisions' ); ?>

					<?php endif; ?>

					<?php do_action( 'bbp_theme_before_topic_form_submit_wrapper' ); ?>

					<div class="bbp-submit-wrapper">

						<?php do_action( 'bbp_theme_before_topic_form_submit_button' ); ?>

						<button type="submit" id="bbp_topic_submit" name="bbp_topic_submit" class="button secondary submit"><?php esc_html_e( 'Submit', 'vikinger' ); ?></button>

						<?php do_action( 'bbp_theme_after_topic_form_submit_button' ); ?>

					</div>

					<?php do_action( 'bbp_theme_after_topic_form_submit_wrapper' ); ?>

				</div>

        <?php bbp_topic_form_fields(); ?>
        
        </div>
        <!-- /VIKINGER FORUM TOPIC FORM WRAP -->

			</fieldset>

			<?php do_action( 'bbp_theme_after_topic_form' ); ?>

		</form>
	</div>

<?php elseif ( bbp_is_forum_closed() ) : ?>

	<div id="forum-closed-<?php bbp_forum_id(); ?>" class="bbp-forum-closed">
		<div class="bbp-template-notice">
			<ul>
				<li><?php printf( esc_html__( 'The forum &#8216;%s&#8217; is closed to new topics and replies.', 'vikinger' ), bbp_get_forum_title() ); ?></li>
			</ul>
		</div>
	</div>

<?php else : ?>

	<div id="no-topic-<?php bbp_forum_id(); ?>" class="bbp-no-topic">
		<div class="bbp-template-notice">
			<ul>
				<li><?php is_user_logged_in()
					? esc_html_e( 'You cannot create new topics.',               'vikinger' )
					: esc_html_e( 'You must be logged in to create new topics.', 'vikinger' );
				?></li>
			</ul>
		</div>

		<?php if ( ! is_user_logged_in() ) : ?>

			<?php bbp_get_template_part( 'form', 'user-login' ); ?>

		<?php endif; ?>

	</div>

<?php endif; ?>

<?php if ( ! bbp_is_single_forum() ) : ?>

</div>

<?php endif;
