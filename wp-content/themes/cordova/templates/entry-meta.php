<h1 class="post-title"><?php echo get_the_title(); ?></h1>
<time class="published post-date" datetime="<?php echo get_the_time('c'); ?>">
	<?php echo get_the_date(); ?>
</time>
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
