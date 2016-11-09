<?php 

/**
 * Here is all the custom colours for the theme.
 * $handle is a reference to the handle used with wp_enqueue_style()
 */	
if(!( function_exists('ebor_less_vars') )){ 
	function ebor_less_vars( $vars, $handle = 'ebor-theme-styles' ) {

		$vars['text']             = get_option('colour_text', '#5b5b5b');
		$vars['highlight']        = get_option('colour_highlight', '#70aed2');
		$vars['highlight_hover']  = get_option('colour_highlight_hover', '#62a3c8');
		$vars['headings']         = get_option('colour_headings', '#3b3b3b');
		$vars['meta']             = get_option('colour_meta', '#999999');
		
	    return $vars;
	}
	add_filter( 'less_vars', 'ebor_less_vars', 10, 2 );
}

/*
Register Fonts
*/
if(!( function_exists('ebor_fonts_url') )){
	function ebor_fonts_url(){
	    $font_url = '';
	    
	    /*
	    	Translators: If there are characters in your language that are not supported
	   		by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== _x( 'on', 'Google font: on or off', 'lydia' ) ) {
	        $font_url = add_query_arg( 'family', urlencode( 'Montserrat:400,700|Karla:400,400italic,700,700italic' ), "//fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
}

/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
if(!( function_exists('ebor_load_scripts') )){
	function ebor_load_scripts() {
			
		//Enqueue Styles
		wp_enqueue_style( 'ebor-google-font', ebor_fonts_url(), array(), '1.0.0' );
		wp_enqueue_style( 'ebor-bootstrap', EBOR_THEME_DIRECTORY . 'style/css/bootstrap.min.css' );
		wp_enqueue_style( 'ebor-plugins', EBOR_THEME_DIRECTORY . 'style/css/plugins.css' );
		wp_enqueue_style( 'ebor-theme-styles', EBOR_THEME_DIRECTORY . 'style/css/theme.less' );
		wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
		wp_enqueue_style( 'ebor-fonts', EBOR_THEME_DIRECTORY . 'style/type/icons.css' );
		
		//Enqueue Scripts
		if ( is_ssl() ) {
		    wp_enqueue_script('ebor-googlemapsapi', 'https://maps-api-ssl.google.com/maps/api/js?sensor=false&v=3.exp', array( 'jquery' ), false, true);
		} else {
		    wp_enqueue_script('ebor-googlemapsapi', 'http://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp', array( 'jquery' ), false, true);
		}
		wp_enqueue_script( 'ebor-bootstrap', EBOR_THEME_DIRECTORY . 'style/js/bootstrap.min.js', array('jquery'), false, true  );
		wp_enqueue_script( 'ebor-plugins', EBOR_THEME_DIRECTORY . 'style/js/plugins.js', array('jquery'), false, true  );
		wp_enqueue_script( 'ebor-scripts', EBOR_THEME_DIRECTORY . 'style/js/scripts.js', array('jquery'), false, true  );
		
		//Enqueue Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		$cats_css = false;
		
		$cats = get_categories('hide_empty=0');
		foreach( $cats as $cat ){
			$colour = get_option('cat_'. $cat->term_id .'_colour', '#70aed2');
			$cats_css .= '
				.cat'. $cat->term_id .' span a { background-color: rgba('. ebor_hex2rgb($colour) .', 0.9); }
				.cat'. $cat->term_id .'span a:hover { background-color: '. $colour .'; }
			';
		}
		
		wp_add_inline_style( 'ebor-style', $cats_css );
		
		//Add custom CSS ability
		wp_add_inline_style( 'ebor-style', get_option('custom_css') );
	}
	add_action('wp_enqueue_scripts', 'ebor_load_scripts', 110);
}

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * 
 * @since version 1.0
 * @author TommusRhodus
 */
if(!( function_exists('ebor_admin_load_scripts') )){
	function ebor_admin_load_scripts(){
		wp_enqueue_style( 'ebor-theme-admin-css', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.css' );
		wp_enqueue_script( 'ebor-theme-admin-js', EBOR_THEME_DIRECTORY . 'admin/ebor-theme-admin.js', array('jquery'), false, true  );
		wp_enqueue_style( 'ebor-fonts', EBOR_THEME_DIRECTORY . 'style/type/icons.css' );
	}
	add_action('admin_enqueue_scripts', 'ebor_admin_load_scripts', 200);
}