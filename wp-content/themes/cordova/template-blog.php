<?php
/*
Template Name: Blog Template
*/
?>
<h1>template-blog.php</h1>
<?php while (have_posts()) : the_post(); ?>

  <?php get_template_part('templates/content', 'page'); ?>

<?php endwhile; ?>
