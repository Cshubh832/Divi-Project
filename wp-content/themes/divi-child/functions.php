<?php 
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'quicksand-font', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap' );
    wp_enqueue_style( 'caveat-font', 'https://fonts.googleapis.com/css2?family=Caveat+Brush&display=swap' );
}

include_once get_stylesheet_directory().'/includes/theme-settings.php';

function wpdocs_enqueue_custom_admin_style() {
        wp_register_script( 'custom_wp_admin_js', get_stylesheet_directory_uri() . '/assets/js/admin-js.js', false, '1.0.0' );
        wp_enqueue_script( 'custom_wp_admin_js' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );

add_action ( 'admin_enqueue_scripts', function () {
    if (is_admin ())
        wp_enqueue_media ();
} );



//Breadcrumb
function get_breadcrumb() {
	if (is_front_page()) {
		echo '';
    }elseif(is_home()){
    	echo '<a href="'.home_url().'" rel="nofollow">Home</a> / '.'News';
    }else{
    	echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
	    if (is_category() || is_single()) {
	        echo " / ";
	        the_category(' &bull; ');
	            if (is_single()) {
	                echo "  /  ";
	                the_title();
	            }
	    } elseif (is_page()) {
	        echo " / ";
	        echo the_title();
	    } elseif (is_search()) {
	        echo " / Search Results for... ";
	        echo '"<em>';
	        echo the_search_query();
	        echo '</em>"';
	    }
    }
}

// Changing excerpt more
function new_excerpt_more($more) {
	global $post;
	return ' <a href="'. get_permalink($post->ID) . '">' . 'Read More &raquo;' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');