<article <?php post_class(); ?>>
  <header>
		<?php $hasFeaturedImage = has_post_thumbnail();?>
		<?php	$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>		
		<?php if($feat_image): ?>
			<div class="col-sm-12 col-xs-12 lead-image-container">
				<a href="<?php the_permalink(); ?>"><img class="img-responsive lead-dark" src="<?php echo $feat_image; ?>"/></a>
		    	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</div>
		<?php endif ?>

    <?php // get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php // the_excerpt(); ?>
  </div>
</article>
