<?php while (have_posts()) : the_post(); ?>
  <div class="container">
    <article class="col-sm-12 col-xs-12 blog-article" <?php post_class(); ?>>
      <hr class='style-two'>
      <header>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <hr class='style-two'>
      <footer>
        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </article>
  </div>
<?php endwhile; ?>
