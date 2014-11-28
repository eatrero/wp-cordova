<?php
/**
 * Utility functions
 */
function is_element_empty($element) {
  $element = trim($element);
  return !empty($element);
}

// Tell WordPress to use searchform.php from the templates/ directory
function roots_get_search_form($form) {
  $form = '';
  locate_template('/templates/searchform.php', true, false);
  return $form;
}
add_filter('get_search_form', 'roots_get_search_form');


function cordova_get_locations() {
  $args = array( 'posts_per_page' => 20, 'offset'=> 0 );
  $locations = array();

  $myposts = get_posts( $args );
  foreach ( $myposts as $post ) {
    setup_postdata( $post );
    $location = get_post_meta( $post->ID, 'location', true );
    $url = get_permalink( $post->ID );
    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

    if($location) {
      array_push($locations, array('location' => $location, 'url' => $url, 'feat_image' => $feat_image));
    }
  }
  wp_reset_postdata();

  return $locations;
}

function cordova_get_featured() {
  $args = array( 'posts_per_page' => 60, 'offset'=> 0 );
  $featured = array();

  $myposts = get_posts( $args );
  foreach ( $myposts as $post ) {
    setup_postdata( $post );
    $feature = get_post_meta( $post->ID, 'featured', true );
    $title = get_the_title( $post->ID );

    if($feature) {
      $url = get_permalink( $post->ID );
      $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      $description = get_post_meta( $post->ID, 'description', true );
      array_push($featured, array('order' => $feature, 'url' => $url, 'feat_image' => $feat_image, 'title' => $title, 'description' => $description));
    }

  }
  wp_reset_postdata();

  ksort($featured);

  usort($featured, function($a, $b) {
      return $b['order'] - $a['order'];
  });

  return $featured;
}

function cordova_get_recent_posts() {
  $args = array( 'posts_per_page' => 5, 'offset'=> 0 );
  $recent = array();

  $myposts = get_posts( $args );

  foreach ( $myposts as $post ) {
    setup_postdata( $post );

    $url = get_permalink( $post->ID );
    $title = get_the_title( $post->ID );

    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    array_push($recent, array('url' => $url, 'feat_image' => $feat_image, 'title' => $title));
  }

  wp_reset_postdata();

  return $recent;
}

function cordova_get_portfolio( $type ) {
  $args = array( 'posts_per_page' => 60, 'offset'=> 0 );
  $featured = array();

  $myposts = get_posts( $args );
  foreach ( $myposts as $post ) {
    setup_postdata( $post );
    $feature = get_post_meta( $post->ID, 'featured', true );

    if($feature) {
      $url = get_permalink( $post->ID );
      $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      array_push($featured, array('order' => $feature, 'url' => $url, 'feat_image' => $feat_image));
    }

  }
  wp_reset_postdata();

  ksort($featured);

  usort($featured, function($a, $b) {
      return $b['order'] - $a['order'];
  });

  return $featured;
}
