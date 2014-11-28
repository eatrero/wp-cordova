<section class='container testimonial-container'>
  <hr class='style-two'>
  <h2 class='h2-span'> Featured Work </h2>

 <?php $featured = cordova_get_featured();
        foreach ( $featured as $feature ) :
      ?>
  <article class="col-sm-4 featured-work">
      <a href='<?php echo $feature['url']; ?>'>
			<figure class="col-sm-12 col-xs-12 lead-image-container">
        <img class='img-responsive lead-dark' src='<?php echo $feature['feat_image']; ?>' />
				  <figcaption><h3 class='entry-title'><?php echo ($feature['description'] ? $feature['description'] : $feature['title']) ?></h3>
		    	</figcaption>
      </figure>
      </a>
  </article>
      <?php endforeach; ?>

</section>
