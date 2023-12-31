<?php

/**
 * Merge Topic
 *
 * @package bbPress
 * @subpackage Theme
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

?>

<div id="bbpress-forums" class="bbpress-wrapper">

	<?php bbp_breadcrumb(); ?>

	<?php if ( is_user_logged_in() && current_user_can( 'edit_topic', bbp_get_topic_id() ) ) : ?>

		<div id="merge-topic-<?php bbp_topic_id(); ?>" class="bbp-topic-merge">

			<form id="merge_topic" name="merge_topic" method="post">

				<fieldset class="bbp-form">

          <legend><?php printf( esc_html__( 'Merge topic "%s"', 'vikinger' ), bbp_get_topic_title() ); ?></legend>
          
          <!-- VIKINGER FORUM TOPIC FORM WRAP -->
          <div class="vikinger-forum-topic-form-wrap">

					<div>

						<div class="bbp-template-notice info">
							<ul>
								<li><?php esc_html_e( 'Select the topic to merge this one into. The destination topic will remain the lead topic, and this one will change into a reply.', 'vikinger' ); ?></li>
								<li><?php esc_html_e( 'To keep this topic as the lead, go to the other topic and use the merge tool from there instead.',                                  'vikinger' ); ?></li>
							</ul>
						</div>

						<div class="bbp-template-notice">
							<ul>
								<li><?php esc_html_e( 'Replies to both topics are merged chronologically, ordered by the time and date they were published. Topics may be updated to a 1 second difference to maintain chronological order based on the merge direction.', 'vikinger' ); ?></li>
							</ul>
						</div>

						<fieldset class="bbp-form">
							<legend><?php esc_html_e( 'Destination', 'vikinger' ); ?></legend>
							<div>
								<?php if ( bbp_has_topics( array( 'show_stickies' => false, 'post_parent' => bbp_get_topic_forum_id( bbp_get_topic_id() ), 'post__not_in' => array( bbp_get_topic_id() ) ) ) ) : ?>

                  <!-- FORM ITEM -->
                  <div class="form-item">
                    <!-- FORM SELECT -->
                    <div class="form-select">
                      <label for="bbp_destination_topic"><?php esc_html_e( 'Merge with this topic:', 'vikinger' ); ?></label>
                    <?php
                      bbp_dropdown( array(
                        'post_type'   => bbp_get_topic_post_type(),
                        'post_parent' => bbp_get_topic_forum_id( bbp_get_topic_id() ),
                        'post_status' => bbp_get_public_topic_statuses(),
                        'selected'    => -1,
                        'exclude'     => bbp_get_topic_id(),
                        'select_id'   => 'bbp_destination_topic'
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

								<?php else : ?>

									<label><?php esc_html_e( 'There are no other topics in this forum to merge with.', 'vikinger' ); ?></label>

								<?php endif; ?>

							</div>
						</fieldset>

						<fieldset class="bbp-form">
							<legend><?php esc_html_e( 'Topic Extras', 'vikinger' ); ?></legend>

							<div>

                <?php if ( bbp_is_subscriptions_active() ) : ?>
                  
                  <!-- FORM ITEM -->
                  <div class="form-item">
                    <!-- CHECKBOX WRAP -->
                    <div class="checkbox-wrap">
                      <input name="bbp_topic_subscribers" id="bbp_topic_subscribers" type="checkbox" value="1" checked="checked" />

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

                      <label for="bbp_topic_subscribers"><?php esc_html_e( 'Merge topic subscribers', 'vikinger' ); ?></label>
                    </div>
                    <!-- /CHECKBOX WRAP -->
                  </div>
                  <!-- /FORM ITEM -->

                <?php endif; ?>
                
                  <!-- FORM ITEM -->
                  <div class="form-item">
                    <!-- CHECKBOX WRAP -->
                    <div class="checkbox-wrap">
                      <input name="bbp_topic_favoriters" id="bbp_topic_favoriters" type="checkbox" value="1" checked="checked" />

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

                      <label for="bbp_topic_favoriters"><?php esc_html_e( 'Merge topic favoriters', 'vikinger' ); ?></label>
                    </div>
                    <!-- /CHECKBOX WRAP -->
                  </div>
                  <!-- /FORM ITEM -->

                <?php if ( bbp_allow_topic_tags() ) : ?>
                  
                  <!-- FORM ITEM -->
                  <div class="form-item">
                    <!-- CHECKBOX WRAP -->
                    <div class="checkbox-wrap">
                      <input name="bbp_topic_tags" id="bbp_topic_tags" type="checkbox" value="1" checked="checked" />

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

                      <label for="bbp_topic_tags"><?php esc_html_e( 'Merge topic tags', 'vikinger' ); ?></label>
                    </div>
                    <!-- /CHECKBOX WRAP -->
                  </div>
                  <!-- /FORM ITEM -->

								<?php endif; ?>

							</div>
						</fieldset>

						<div class="bbp-template-notice error">
							<ul>
								<li><?php esc_html_e( 'This process cannot be undone.', 'vikinger' ); ?></li>
							</ul>
						</div>

						<div class="bbp-submit-wrapper">
							<button type="submit" id="bbp_merge_topic_submit" name="bbp_merge_topic_submit" class="button secondary submit"><?php esc_html_e( 'Submit', 'vikinger' ); ?></button>
						</div>
					</div>

          <?php bbp_merge_topic_form_fields(); ?>
          
          </div>
          <!-- /VIKINGER FORUM TOPIC FORM WRAP -->

				</fieldset>
			</form>
		</div>

	<?php else : ?>

		<div id="no-topic-<?php bbp_topic_id(); ?>" class="bbp-no-topic">
			<div class="entry-content"><?php is_user_logged_in()
				? esc_html_e( 'You do not have permission to edit this topic.', 'vikinger' )
				: esc_html_e( 'You cannot edit this topic.',                    'vikinger' );
			?></div>
		</div>

	<?php endif; ?>

</div>