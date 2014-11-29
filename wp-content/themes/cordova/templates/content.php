<article <?php post_class(); ?>>
  <header>
		<?php $hasFeaturedImage = has_post_thumbnail();?>
		<?php	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<?php if($feat_image): ?>
			<a href="<?php the_permalink(); ?>">
			<figure class="col-sm-12 col-xs-12 lead-image-container">
				<img class="img-responsive lead-dark" src="<?php echo $feat_image; ?>"/>
				  <figcaption>
		    	  <h2 class="entry-title"><?php the_title(); ?></h2>
		    	</figcaption>
			</figure>
			</a>
		<?php endif ?>

    <?php // get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php // the_excerpt(); ?>
  </div>
</article>
