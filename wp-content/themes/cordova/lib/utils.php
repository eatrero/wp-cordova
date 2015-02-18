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
  $args = array( 'posts_per_page' => 200, 'offset'=> 0 );
  $locations = array();

  $myposts = get_posts( $args );
  foreach ( $myposts as $post ) {
    setup_postdata( $post );
    $location = get_post_meta( $post->ID, 'location', true );
    $url = get_permalink( $post->ID );
    $feat_image = wp_get_attachment_thumb_url( get_post_thumbnail_id($post->ID) );

    if($location) {
      array_push($locations, array('location' => $location, 'url' => $url, 'feat_image' => $feat_image));
    }
  }
  wp_reset_postdata();

  $args = array(
	'sort_order' => 'ASC',
	'sort_column' => 'post_title',
	'hierarchical' => 0,
	'exclude' => '',
	'include' => '',
	'meta_key' => '',
	'meta_value' => '',
	'authors' => '',
	'child_of' => 0,
	'parent' => -1,
	'exclude_tree' => '',
	'number' => '',
	'offset' => 0,
	'post_type' => 'page',
	'post_status' => 'publish');

  $my_pages = get_pages($args);
  foreach ( $my_pages as $post ) {
    setup_postdata( $post );
    $location = get_post_meta( $post->ID, 'location', true );
    $url = get_permalink( $post->ID );
    $feat_image = wp_get_attachment_thumb_url( get_post_thumbnail_id($post->ID) );

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

function cordova_get_portfolio( $category_type ) {
  $args = array( 'posts_per_page' => 100, 'offset'=> 0 );
  $featured = array();

  $myposts = get_posts( $args );

  foreach ( $myposts as $post ) {
    setup_postdata( $post );
    $feature = get_post_meta( $post->ID, 'featured', true );

    if($feature) {
      $url = get_permalink( $post->ID );
      $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      $title = get_the_title( $post->ID );
      $description = get_post_meta( $post->ID, 'description', true );

      $categories = get_the_category( $post->ID );
      if( $categories && $category_type) {
        foreach($categories as $category) {
          if(strcasecmp($category->name, $category_type) == 0)
            array_push($featured, array('order' => $feature, 'url' => $url, 'feat_image' => $feat_image, 'title' => $title, 'description' => $description));
            break;
        }
      } else {
//        array_push($featured, array('order' => $feature, 'url' => $url, 'feat_image' => $feat_image, 'title' => $title, 'description' => $description));
      }
    }
  }
  wp_reset_postdata();

  ksort($featured);

  usort($featured, function($a, $b) {
      return $b['order'] - $a['order'];
  });

  return $featured;
}

// [bartag foo="foo-value"]
function cordova_get_portfolio_sc( $atts ) {
  $a = shortcode_atts( array(
      'category' => ''
  ), $atts );
  $category_type = $a['category'];

  $featured = cordova_get_portfolio($category_type);

  $output = '';
  $i = 0;

  foreach($featured as $feature){
    if($i%3 == 0) {
      $output .= "<div class='row'>";
    }

    $output .= "<article class='col-sm-4 featured-work'>";
    $output .= "<div class='portfolio-thumb'>";
    $output .= "<a href='" . $feature['url'] . "'>";
    $output .= "<figure class='col-sm-12 col-xs-12 lead-image-container'>";
    $output .= "<img class='img-responsive lead-dark' src='" . $feature['feat_image']  . "'>";
    $output .= "<figcaption><h3 class='entry-title'>";
    $output .= $feature['description'] ? $feature['description'] : $feature['title'];
    $output .= "</h3></figcaption></figure></a></div></article>";

    if($i%3 == 2) {
      $output .= "</div>";
    }
    $i++;
  }

  return $output;

}
