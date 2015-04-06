<?php
/*
Template Name: Location Template
*/
?>

<?php while (have_posts()) : the_post(); ?>
<h1 class="post-title"><?php echo get_the_title(); ?></h1>

  <?php get_template_part('templates/page', 'header'); ?>
<div style='text-align:center;margin-top:10px;line-height:20px;'>
    <p>Share this post</p>
    <?php $perm = get_permalink();?>
    <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink($post->ID)); ?>&t=<?php echo urlencode($post->post_title); ?>"><i class="fa fa-facebook-official fa-2x"></i></a>
    <a class="twitter-share-button"
       href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>"
      data-url="<?php echo $perm;?>"
      data-count="vertical" target="_blank">
    <i class="fa fa-twitter-square fa-2x"></i>
    </a>
</div>
<hr class='hr-after-meta'>

  <?php get_template_part('templates/content', 'page'); ?>

<?php endwhile; ?>

<div style='text-align:center;margin-top:10px;line-height:20px;margin-bottom:50px;'>
    <h3>Share this post</h3>
    <?php $perm = get_permalink();?>
    <a href="https://www.facebook.com/dialog/share?app_id=814169431964357&display=popup&href=<?php echo $perm;?>&redirect_uri=<?php echo $perm;?>" target="_blank"><i class="fa fa-facebook-official fa-3x"></i></a>
    <a class="twitter-share-button"
       href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>"
      data-url="<?php echo $perm;?>"
      data-count="vertical" target="_blank">
    <i class="fa fa-twitter-square fa-3x"></i>
    </a>
</div>
</div>
