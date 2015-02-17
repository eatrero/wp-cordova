<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <style>
  hr.style-two {
    clear: both;
    float: none;
    width: 100%;
    height: 1px;
    margin: 1.4em 0;
    border: none;
    background: #333;
    background-image: -webkit-gradient(
      linear,
      left bottom,
      right bottom,
      color-stop(0, rgb(255,255,255)),
      color-stop(0.1, rgb(180,180,180)),
      color-stop(0.9, rgb(180,180,180)),
      color-stop(1, rgb(255,255,255))
    );
    background-image: -moz-linear-gradient(
      left center,
      rgb(255,255,255) 0%,
      rgb(221,221,221) 10%,
      rgb(221,221,221) 90%,
      rgb(255,255,255) 100%
    );
  }

  hr.hr-after-meta {
    clear: both;
    float: none;
    width: 100%;
    height: 1px;
    margin: 1.4em 0;
    border: none;
    background: #333;
    background-image: -webkit-gradient(
      linear,
      left bottom,
      right bottom,
      color-stop(0.2, rgb(255,255,255)),
      color-stop(0.4, rgb(180,180,180)),
      color-stop(0.6, rgb(180,180,180)),
      color-stop(0.8, rgb(255,255,255))
    );
    background-image: -moz-linear-gradient(
      left center,
      rgb(255,255,255) 20%,
      rgb(221,221,221) 70%,
      rgb(221,221,221) 90%,
      rgb(255,255,255) 100%
    );
    text-align: center;
  }

  hr.hr-footer {
      clear: both;
      float: none;
      width: 100%;
      height: 1px;
      margin: 1.4em 0;
      border: none;
      background: #333;
      background-image: -webkit-gradient(
        linear,
        left bottom,
        right bottom,
        color-stop(0.2, #eff0ef),
        color-stop(0.4, rgb(180,180,180)),
        color-stop(0.6, rgb(180,180,180)),
        color-stop(0.8, #eff0ef)
      );
      background-image: -moz-linear-gradient(
        left center,
        #eff0ef 20%,
        rgb(221,221,221) 70%,
        rgb(221,221,221) 90%,
        #eff0ef 100%
      );
      text-align: center;
    }

  </style>
</head>
