<div class="meta">

	<span class="date">
		<?php the_time( get_option('date_format') ); ?>
	</span>
	
	<?php if( comments_open() ) : ?> 
		<span class="comments">
			<a href="<?php comments_link(); ?>"><i class="icon-chat-1"></i> <?php comments_number( '0','1','%' ); ?></a>
		</span>
	<?php endif; ?>

</div>