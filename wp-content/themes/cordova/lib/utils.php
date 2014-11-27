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

    array_push($locations, array('location' => $location, 'url' => $url, 'feat_image' => $feat_image));
  }
  wp_reset_postdata();

  return $locations;
}
