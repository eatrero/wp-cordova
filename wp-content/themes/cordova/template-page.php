<?php
/*
Template Name: Page Template
*/
?>

<h1>template-page.php</h1>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
</div>
