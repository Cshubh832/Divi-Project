<?php
add_action('admin_menu', 'aln_theme_menu');

//create a menu entry in the backend where we can place our settings user interface:
function aln_theme_menu(){
    add_menu_page('Sage Hobbs Settings', 'Sage Hobbs Option', 'administrator', 'aln-theme-settings', 'aln_theme_settings_page','dashicons-admin-generic');
}
// registering our settings
add_action('admin_init', 'aln_register_theme_settings');
function aln_register_theme_settings(){
	register_setting('aln-all', 'facebook');
    register_setting('aln-all', 'tumb');        
    register_setting('aln-all', 'insta'); 
    register_setting('aln-all', 'email');
	
    register_setting('aln-all', 'optin_text');        
    register_setting('aln-all', 'testimonial_subheading');        
    register_setting('aln-all', 'testimonials_text');    
	register_setting('aln-all', 'custom-legal-notice-add-media'); 	
}

function aln_theme_settings_page(){ ?>
    <div class ="aln-wrapme">		
        <form method="post" action="options.php">
            <?php settings_fields( 'aln-all' ); ?>
            <?php do_settings_sections( 'aln-all' ); ?>
			<h1>Social Media</h1> 
            <table class="form-table">
                <tr valign="top">
					<th scope="row">Facebook URL: </th>
					<td><input type="url" name="facebook" value="<?php echo esc_attr( get_option('facebook') ); ?>" /></td>
                </tr>

                <tr valign="top">
					<th scope="row">Tumblr URL: </th>
					<td><input type="url" name="tumb" value="<?php echo esc_attr( get_option('tumb') ); ?>" /></td>
                </tr>
				
				<tr valign="top">
					<th scope="row">Instagram URL: </th>
					<td><input type="url" name="insta" value="<?php echo esc_attr( get_option('insta') ); ?>" /></td>
                </tr>
				<tr valign="top">
					<th scope="row">Email URL: </th>
					<td><input type="text" name="email" value="<?php echo esc_attr( get_option('email') ); ?>" /></td>
                </tr>
				</table>
				<hr>
			<h1>Optin Text</h1> 
				<table class="form-table">
				<tr valign="top">
					
                <th scope="row">Optin Text</th>                
                <td>
				<?php 
					$content   = get_option('optin_text');
					$name = 'optin_text';
					$settings  = array( 'media_buttons' => false );
					wp_editor( $content, $name, $settings );
				?>
                </td>

            </tr>
				
				
            </table>
			<hr>
				<h1>Testimonials</h1> 
			<table class="form-table">
                <tr valign="top">
                <th scope="row"> Name: </th>
                <td><input type="text" name="testimonial_subheading" value="<?php echo esc_attr( get_option('testimonial_subheading') ); ?>" /></td>
                </tr>
				
				  <tr>
				<th scope="row">Description: </th>
                <td>
				<?php 
					$content   = get_option('testimonials_text');
					$name = 'testimonials_text';
					$settings  = array( 'media_buttons' => false );
					wp_editor( $content, $name, $settings );
				?>
				</td>
                </tr>
				<tr valign="top">
                    <th scope="row"></th>
                    <td> <?php submit_button(); ?></td>                    
                </tr>
            </table>
        </form>
    </div>
<?php } ?>
<?php 
add_shortcode('testimonials','aln_testimonials');
function aln_testimonials(){
    ob_start();?>
		<div class="testimonials">
		<div class="et_pb_module et_pb_testimonial et_pb_testimonial_0 clearfix  et_pb_text_align_left et_pb_bg_layout_light et_pb_testimonial_no_image">
		
		<div class="et_pb_testimonial_description">
			<div class="et_pb_testimonial_description_inner"><div class="et_pb_testimonial_content">
			<?php echo get_option('testimonials_text'); ?>
			<span class="et_pb_testimonial_author"><?php echo esc_attr( get_option('testimonial_subheading') ); ?></span>
			</div></div> <!-- .et_pb_testimonial_description_inner -->
			
			
		</div> <!-- .et_pb_testimonial_description -->
	</div> <!-- .et_pb_testimonial -->
	</div> <!-- .et_pb_column -->
	
	<?php
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
}


add_shortcode('aln-socials','aln_socials');
function aln_socials(){
    ob_start();
	if ( false !== et_get_option( 'show_footer_social_icons', true ) ) {
		get_template_part( 'includes/social_icons', 'footer' );
	}
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
} 	

add_action('admin_footer', 'my_custom_fonts'); // admin_head is a hook my_custom_fonts is a function we are adding it to the hook

function my_custom_fonts() {
  echo '<style>
    .aln-wrapme input[type=text], .aln-wrapme input[type=url], .aln-wrapme input[type=email], .aln-wrapme textarea, .aln-textarea {
        width: 50%;
        box-shadow: none !important;
        height: 43px;
    }
    .aln-wrapme {background: #fff;padding: 20px;background-color: #fff;border-left: 4px solid #2d4b8e;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);margin: 20px;
    }
    .aln-wrapme  textarea{
        height: 120px;
    }
	.wp-legalease-media-wrapper{
		position:relative;
		width:90%;
	}
	span.wp-legalease-delete-digital-img {
		position: absolute;
		top: -25px;
		cursor: pointer;
		font-style: normal;
		font-weight: 600;
		background: #fff;
		width: 50px;
		border-radius: 50%;
		height: 50px;
		line-height: 50px;
		float: right;
		text-align: center;
		border: 2px solid #4078bc;
		font-family: sans-serif;
		right: -22px;
		color: #4078bc;
		font-size: 24px;
	}
img.custom-legal-notice-add-media-wr {
        max-width: 100%;
    height: auto;
    overflow: hidden;
}
button.set_custom_images.button {
    float: left;
    margin-right: 20px;
}
button#insert-media-button {
    display: none;
}
  </style>';
}










//
class wnc_social_media_widget extends WP_Widget {

public function __construct() {
$widget_options = array(
'classname' => 'social_media_widget',
'description' => 'Add social media links to your sidebar'
);

parent::__construct( 'social_media_widget', 'Social Media Widget', $widget_options);

}

public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title']);
$facebook = apply_filters( 'facebook_url', $instance['facebook_url']);
$twitter = apply_filters( 'twitter_url', $instance['twitter_url']);
$instagram = apply_filters( 'instagram_url', $instance['instagram_url']);
$pinterest = apply_filters( 'pinterest_url', $instance['pinterest_url']);
$youtube = apply_filters( 'youtube_url', $instance['youtube_url']);

echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'] ?>

<ul class="wnc_social_media_widget">

<?php
if (!empty($instance['facebook_url'])) {
?> <li class="wnc_smw_fb"><a href="<?php echo esc_url('https://facebook.com/' . $facebook) ?>"></a></li><?php
} else {}
if (!empty($instance['twitter_url'])) {
?><li class="wnc_smw_tw"><a href="<?php echo esc_url('https://twitter.com/' . $twitter) ?>"></a></li><?php
} else {}
if (!empty($instance['instagram_url'])) {
?><li class="wnc_smw_in"><a href="<?php echo esc_url('https://instagram.com/' . $instagram) ?>"></a></li><?php
} else {}
if (!empty($instance['pinterest_url'])) {
?><li class="wnc_smw_pi"><a href="<?php echo esc_url('https://pinterest.com/' . $pinterest) ?>"></a></li><?php
} else {}
if (!empty($instance['youtube_url'])) {
?><li class="wnc_smw_yt"><a href="<?php echo esc_url('https://youtube.com/channel/' . $youtube) ?>"></a></li><?php
} else {}?>

</ul>

<?php echo $args['after_widget'];

}

public function form( $instance ){
$title = !empty( $instance['title'] ) ? $instance['title'] : '';
$facebook = !empty( $instance['facebook_url'] ) ? $instance['facebook_url'] : '';
$twitter = !empty( $instance['twitter_url'] ) ? $instance['twitter_url'] : '';
$instagram = !empty( $instance['instagram_url'] ) ? $instance['instagram_url'] : '';
$pinterest = !empty( $instance['pinterest_url'] ) ? $instance['pinterest_url'] : '';
$youtube = !empty( $instance['youtube_url'] ) ? $instance['youtube_url'] : ''; ?>

<p>
<div>

<strong><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: </label></strong><br/>
<input type="text" id="<?php echo $this->get_field_id( 'title' );?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title);?>" />
</div>
<div>
<strong><label for="<?php echo $this->get_field_id( 'facebook_url' ); ?>">Facebook: </label></strong><br/>
<input type="text" id="<?php echo $this->get_field_id( 'facebook_url' );?>" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>" value="<?php echo esc_attr( $facebook );?>" />
</div>
<div>
<strong><label for="<?php echo $this->get_field_id( 'twitter_url' ); ?>">Twitter: </label></strong><br/>
<input type="text" id="<?php echo $this->get_field_id( 'twitter_url' );?>" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>" value="<?php echo esc_attr( $twitter );?>" />
</div>
<div>
<strong><label for="<?php echo $this->get_field_id( 'instagram_url' ); ?>">Instagram: </label></strong><br/>
<input type="text" id="<?php echo $this->get_field_id( 'instagram_url' );?>" name="<?php echo $this->get_field_name( 'instagram_url' ); ?>" value="<?php echo esc_attr( $instagram );?>" />
</div>
<div>
<strong><label for="<?php echo $this->get_field_id( 'pinterest_url' ); ?>">Pinterest: </label><br/></strong>
<input type="text" id="<?php echo $this->get_field_id( 'pinterest_url' );?>" name="<?php echo $this->get_field_name( 'pinterest_url' ); ?>" value="<?php echo esc_attr( $pinterest );?>" />
</div>
<div>
<strong><label for="<?php echo $this->get_field_id( 'youtube_url' ); ?>">Youtube: </label></strong><br/>
<input type="text" id="<?php echo $this->get_field_id( 'youtube_url' );?>" name="<?php echo $this->get_field_name( 'youtube_url' ); ?>" value="<?php echo esc_attr( $youtube );?>" />
</div>

</p><?php
}

public function update( $new_instance, $old_instance) {
$instance = $old_instance;
$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ]);
$instance[ 'facebook_url' ] = strip_tags( $new_instance[ 'facebook_url' ]);
$instance[ 'twitter_url' ] = strip_tags( $new_instance[ 'twitter_url' ]);
$instance[ 'instagram_url' ] = strip_tags( $new_instance[ 'instagram_url' ]);
$instance[ 'pinterest_url' ] = strip_tags( $new_instance[ 'pinterest_url' ]);
$instance[ 'youtube_url' ] = strip_tags( $new_instance[ 'youtube_url' ]);
return $instance;
}

}

function wnc_register_social_media_widget() {
register_widget( 'wnc_social_media_widget');

}
add_action('widgets_init', 'wnc_register_social_media_widget');
?>