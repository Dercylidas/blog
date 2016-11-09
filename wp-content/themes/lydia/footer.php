<footer class="footer inverse-wrapper">

	<?php get_template_part('inc/content-footer', 'widgets'); ?>
	
	<div class="sub-footer">
		<div class="container inner">
			<p class="text-center">
				<?php echo wp_kses(htmlspecialchars_decode(get_option('copyright', 'Configure this message in "appearance" => "customize"')), ebor_allowed_tags()); ?>
			</p>
		</div>
	</div>

</footer>
  
<div class="slide-portfolio-overlay"></div>

</main>

<a href="#0" class="slide-portfolio-item-content-close"><i class="budicon-cancel-1"></i></a>

<?php wp_footer(); ?>
</body>
</html>