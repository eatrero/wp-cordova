<section class='container testimonial-container'>
  <hr class='style-two'>
  <h2> Featured Work </h2>

 <?php $featured = cordova_get_featured();
        foreach ( $featured as $feature ) :
      ?>
  <article class="col-sm-4 featured-work">
      <a href='<?php echo $feature['url']; ?>'>
      <img class='img-responsive' src='<?php echo $feature['feat_image']; ?>' />
      </a>
  </article>
      <?php endforeach; ?>

</section>
