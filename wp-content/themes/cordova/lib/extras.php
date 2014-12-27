<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more($more) {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

/**
 *
 */
function roots_cordova_filter_content($content) {
	if(is_single()) {
		$doc = new DOMDocument();
		if($content){
  		$doc->loadHTML($content);
		}

		$imgs = $doc->getElementsByTagName('img');
		foreach ($imgs as $img) {
			$img->setAttribute('class', 'img-responsive blog-images');
		  if($img->getAttribute('height') > $img->getAttribute('width')){

        $after = $doc->createElement("div","");
        $after->setAttribute('class', 'row');

  			$img->setAttribute('class', 'img-responsive blog-images col-sm-6 col-sm-offset-3');
  			$img->appendChild($after);
			}
		}
		$content = $doc->saveXML();
	}
	return $content;
}
add_filter('the_content', 'roots_cordova_filter_content');
