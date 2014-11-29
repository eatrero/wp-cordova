<?php while (have_posts()) : the_post(); ?>
  <div class="container">
    <article class="col-sm-12 col-xs-12 blog-article" <?php post_class(); ?>>
      <hr class='style-two'>
      <header class='post-header'>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
      <footer>
        <span class='pull-left'><?php previous_post_link(); ?></span>
        <span class='pull-right'><?php next_post_link(); ?></span>
      </footer>
      <hr class='style-two'>
      <?php comments_template('/templates/comments.php'); ?>
    </article>

  </div>
<?php endwhile; ?>
