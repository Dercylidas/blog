<?php 
	global $post;
	$header_images = get_post_meta($post->ID, '_ebor_gallery_images', 1); 
?>

<div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-<?php the_ID(); ?>">
	<div class="slide-portfolio-item-detail">
		<div class="inner2">
			
			<div class="text-center">
				<?php 
					the_title('<h2>', '</h2>');
					the_content();
				?>
			</div>
			
			<div class="divide25"></div>
			
			<?php if( is_array($header_images) ) : ?>
			<ul class="basic-gallery text-center">
				<?php 
					foreach( $header_images as $id => $content ){
						echo '<li>'. wp_get_attachment_image($id, 'full') .'</li>';
					}
				?>
			</ul>
			<?php endif; ?>
			
		</div>
	</div>
</div>
