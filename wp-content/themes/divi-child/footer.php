
<?php
if ( et_theme_builder_overrides_layout( ET_THEME_BUILDER_HEADER_LAYOUT_POST_TYPE ) || et_theme_builder_overrides_layout( ET_THEME_BUILDER_FOOTER_LAYOUT_POST_TYPE ) ) {
    // Skip rendering anything as this partial is being buffered anyway.
    // In addition, avoids get_sidebar() issues since that uses
    // locate_template() with require_once.
    return;
}?>

<?php if(!is_page('free-estimate') && !is_home()) {?>
<div id="footer-form" class="et_pb_section et_pb_section_4 et_pb_with_background et_section_regular">
				
<div class="et_pb_row et_pb_row_8">
<div class="et_pb_column et_pb_column_1_2 et_pb_column_15  et_pb_css_mix_blend_mode_passthrough">


<div class="et_pb_module et_pb_text et_pb_text_3  et_pb_text_align_left et_pb_bg_layout_light">


<div class="et_pb_text_inner"><h2>Have a project for us?</h2>
<p>We can manage any pavement services in the San Antonio, Texas area. We do asphalt paving or maintenance on any personal driveways and commercial roads and parking lots. We would be happy to speak to you about your project and provide you with a free estimate.</p></div>
</div> <!-- .et_pb_text -->
</div> <!-- .et_pb_column -->
<div class="et_pb_column et_pb_column_1_2 et_pb_column_16  et_pb_css_mix_blend_mode_passthrough et-last-child">

<div class="et_pb_module et_pb_text et_pb_text_4  et_pb_text_align_left et_pb_bg_layout_light">


<div class="et_pb_text_inner"><div role="form" class="wpcf7" id="wpcf7-f115-p18-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"><p role="status" aria-live="polite" aria-atomic="true"></p> <ul></ul></div>
<?php echo do_shortcode('[contact-form-7 id="115" title="Contact form 1"]'); ?>
</div></div>
</div> <!-- .et_pb_text -->
</div> <!-- .et_pb_column -->


</div> <!-- .et_pb_row -->


</div>
<?php }?>

<?php

/**
 * Fires after the main content, before the footer is output.
 *
 * @since 3.10
 */
do_action( 'et_after_main_content' );

if ( 'on' === et_get_option( 'divi_back_to_top', 'false' ) ) : ?>

	<span class="et_pb_scroll_top et-pb-icon"></span>

<?php endif;

if ( ! is_page_template( 'page-template-blank.php' ) ) : ?>

			<footer id="main-footer">
				<?php get_sidebar( 'footer' ); ?>


		<?php
			if ( has_nav_menu( 'footer-menu' ) ) : ?>

				<div id="et-footer-nav">
					<div class="container">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'footer-menu',
								'depth'          => '1',
								'menu_class'     => 'bottom-nav',
								'container'      => '',
								'fallback_cb'    => '',
							) );
						?>
					</div>
				</div> <!-- #et-footer-nav -->

			<?php endif; ?>

				<div id="footer-bottom">
					<div class="container clearfix">
				<?php
					if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
						get_template_part( 'includes/social_icons', 'footer' );
					}

					// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
					echo et_core_fix_unclosed_html_tags( et_core_esc_previously( et_get_footer_credits() ) );
					// phpcs:enable
				?>
					</div>	<!-- .container -->
				</div>
			</footer> <!-- #main-footer -->
		</div> <!-- #et-main-area -->

<?php endif; // ! is_page_template( 'page-template-blank.php' ) ?>

	</div> <!-- #page-container -->

	<?php wp_footer(); ?>
</body>
</html>
