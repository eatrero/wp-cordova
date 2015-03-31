<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'roots'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php $i=0; ?>
<div id="content" class="container last-section">
  <?php while (have_posts()) : the_post(); ?>

    <?php if($i==0){ ?>
        <div class='col-sm-12 col-xs-12' style="margin-bottom:8px;">
          <div class='article-container'>
            <?php get_template_part('templates/content', get_post_format()); ?>
          </div>
        </div>

    <?php } else { ?>

    <?php if( $i%2 ){ ?>
        <div class='col-sm-6 col-xs-12 article-container'>
          <div class='blog-thumb-left'>
            <?php get_template_part('templates/contentlarge', get_post_format()); ?>
          </div>
        </div>
    <?php   } else { ?>
        <div class='col-sm-6 col-xs-12 article-container'>
          <div class='blog-thumb-right'>
            <?php get_template_part('templates/contentlarge', get_post_format()); ?>
          </div>
        </div>
    <?php   } ?>

    <?php }
    $i++; ?>

  <?php endwhile; ?>

</div>

<div class="container">
<?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="post-nav">
      <ul class="pager">
        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
      </ul>
    </nav>
<?php endif; ?>
</div>
