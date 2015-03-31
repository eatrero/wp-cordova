<article <?php post_class(); ?>>
  <header>
		<?php $hasFeaturedImage = has_post_thumbnail();?>
		<?php	$feat_image = image_downsize( get_post_thumbnail_id($post->ID), 'large' ); ?>
		<?php if($feat_image): ?>
			<a href="<?php the_permalink(); ?>">
			<figure class="col-sm-12 col-xs-12 lead-image-container">
				<img class="img-responsive lead-dark" src="<?php echo $feat_image[0]; ?>"/>
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
