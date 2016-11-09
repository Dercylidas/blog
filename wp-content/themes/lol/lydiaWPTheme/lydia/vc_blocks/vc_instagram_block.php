<?php 

/**
 * The Shortcode
 */
function ebor_instagram_block_shortcode( $atts, $content = null ) {
	extract( 
		shortcode_atts( 
			array(
				'id' => '',
				'token' => ''
			), $atts 
		) 
	);
	
	ob_start();
?>

	<div class="image-grid col5">
		<div class="items-wrapper">
			<div id="instafeed" class="isotope items" data-limit="5"></div>
		</div>
	</div>
	
	<script type="text/javascript">
		jQuery(document).ready(function(){
			var instagramFeed = new Instafeed({
			    get: 'user',
			    limit: 10,
			    userId: <?php echo esc_js($id); ?>,
			    accessToken: '<?php echo esc_js($token); ?>',
			    resolution: 'low_resolution',
			    template: '<div class="item"><figure class="icon-overlay"><a href="{{link}}"><img src="{{image}}" /></a></figure></div>',
			    after: function() {
			        jQuery('#instafeed .item .icon-overlay a').prepend('<span class="icn-more"></span>');
			        var $portfoliogrid = jQuery('.image-grid .isotope');
			        $portfoliogrid.isotope({
			            itemSelector: '.item',
			            transitionDuration: '0.7s',
			            masonry: {
			                columnWidth: $portfoliogrid.width() / 12
			            },
			            layoutMode: 'masonry'
			        });
			        jQuery(window).resize(function() {
			            $portfoliogrid.isotope({
			                masonry: {
			                    columnWidth: $portfoliogrid.width() / 12
			                }
			            });
			        });
			        $portfoliogrid.imagesLoaded(function() {
			            $portfoliogrid.isotope('layout');
			        });
			    }
			});
			jQuery('#instafeed').each(function() {
			    instagramFeed.run();
			});
		});
	</script>
	
<?php
	$output = ob_get_contents();
	ob_end_clean();
	
	return $output;
}
add_shortcode( 'lydia_instagram_block', 'ebor_instagram_block_shortcode' );

/**
 * The VC Functions
 */
function ebor_instagram_block_shortcode_vc() {
	vc_map( 
		array(
			"icon" => 'lydia-vc-block',
			"name" => esc_html__("Instagram Feed", 'lydia'),
			"base" => "lydia_instagram_block",
			"category" => esc_html__('Lydia WP Theme', 'lydia'),
			'description' => 'A swiper of Instagram images.',
			"params" => array(
				array(
					"type" => "textfield",
					"heading" => esc_html__("Numeric User ID", 'lydia'),
					"param_name" => "id"
				),
				array(
					"type" => "textfield",
					"heading" => esc_html__("Access Token", 'lydia'),
					"param_name" => "token",
					'description' => 'This is the Instagram block, it will grab your latest Instagram images. For this to work, the block requires you enter a numeric ID in the correct field, and also an access token in the correct field. Please grab your numeric Instagram ID & Access Token from here: <a href="https://instagram.com/oauth/authorize/?client_id=467ede5a6b9b48ae8e03f4e2582aeeb3&redirect_uri=http://instafeedjs.com&response_type=token" target="_blank">Get User ID & Token</a>'
				),
			)
		) 
	);
}
add_action( 'vc_before_init', 'ebor_instagram_block_shortcode_vc' );