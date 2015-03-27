<footer class="content-info footer-row" role="contentinfo">
	<div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <section>
    	<div class="row">

	    	<div class="col-sm-6 col-md-4 col-xs-12 hidden-xs hidden-sm">
	    	  <article class="col-sm-11">
  		    	<h3 class="h3-span"> Recent Posts	</h3>
  		    	<hr class="hr-footer">
  		    	<ul class="post-ul">
  		    	<?php $recent_posts = cordova_get_recent_posts(); ?>
            <?php
              foreach ( $recent_posts as $post ) :
            ?>
              <li class="post-li"><a href="<?php echo $post['url']; ?>"><?php echo $post['title']; ?></a></li>
            <?php endforeach;
            ?>
            </ul>
  		    	<hr class="hr-footer">
	  	    </article>
	    	</div>

	    	<div class="col-sm-6 col-md-4 col-xs-12 instagram-footer">
		    	<h3 class="h3-span"> Instagram	</h3>
		    	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
  		    	<p class='result'></p>
		    	</div>
	    	</div>

	    	<hr class="style-two visible-xs seperator-xs">

	    	<div class="col-sm-6 col-md-4 col-xs-12">
		    	<h3 class="h3-span"> Contact Nathan</h3>
 		    	<div class="contact-form">
  		    	<?php gravity_form(1, false, false, false, '', true); ?>
  		    </div>
	    	</div>
    	</div>
    </section>

    <div class="copyright-text">©2014 Nathan Cordova. Site Design by <a href="http://beastco.de">BEASTCODE.</a></p>
  </div>

</footer>

<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>



<script type="text/javascript">
  <?php $locations = cordova_get_locations(); ?>

  var myLocations = [
  <?php
    foreach ( $locations as $location ) :
  ?>
  { location : "<?php echo $location['location']; ?>", url : "<?php echo $location['url']; ?>", feat_img : "<?php echo $location['feat_image']; ?>"},
<?php endforeach;
  ?>

];
</script>

<script src="<?php echo get_template_directory_uri() . '/assets/js/footer.js' ?> ">

<script>


</script>

<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {
      $( ".event-datepicker" ).datepicker({ minDate: "+1D", maxDate: "+5Y" });
      $( "p.testimonial").widont();

      $("[id='field_1_5']","[id='field_1_2']").wrapAll('<div class="row">');
      $("[id='field_1_3']","[id='field_1_4']").wrapAll('<div class="row">');
      $('.ginput_container').children().removeClass('medium');
      $("[id='field_1_5']").wrap('<div class="form-group col-md-6 col-sm-12 col-xs-6"></div>');
      $("[id='field_1_2']").wrap('<div class="form-group col-md-6 col-sm-12 col-xs-6"></div>');
      $("[id='field_1_3']").wrap('<div class="form-group col-md-6 col-sm-12 col-xs-6"></div>');
      $("[id='field_1_4']").wrap('<div class="form-group col-md-6 col-sm-12 col-xs-6"></div>');

      $("[id='input_1_5']").addClass('form-control');
      $("[id='input_1_2']").addClass('form-control');
      $("[id='input_1_3']").addClass('form-control').wrap('<p class="input-group">');
      $("[id='input_1_3']").addClass('form-control').css('margin-top','0px');
      $("[id='input_1_3']").addClass('form-control').css('width','100%').css('border-radius','0px');
      $("[id='input_1_4']").addClass('form-control');
      $("[id='input_1_3']").after('<span class="input-group-btn"><button id="cal-btn" type="button" class="btn btn-calendar event-datepicker"><i class="glyphicon glyphicon-calendar"></i></button></span>');
      $("[id='gform_submit_button_1']").addClass('btn btn-block btn-homepage');

      $('.dropdown-toggle').attr('role','button');

      $('#input_1_3').attr('id','input_1_3_a');
      $('#cal-btn').attr('id','cal-btn_a');

      $("#cal-btn_a").click(function(){
        $("#input_1_3_a").datepicker('show');
      });

      $("#cal-btn").click(function(){
        $("#input_1_3").datepicker('show');
      });

      $('.contact-form').show();
    });
</script>

<script>

  $.ajax({
  type: "GET",
  dataType: "jsonp",
  url: "https://api.instagram.com/v1/users/1556471062/media/recent/?client_id=bf9bcae024a64386a723ee9187139ec9"
   }). done(function( data ) {
    var recent_post_url = data.data[0].images.standard_resolution.url;
    console.log(data.data[0].location.name);
//    console.log(data.data[0].images.thumbnail);
    $(".result").html("<a href='http://instagram.com/ncordovaphoto' target='_blank'><figure class='lead-image-container2'> <img src='" + recent_post_url + "' class='img-responsive'/><figcaption><h2 class='entry-title'>" + (data.data[0].location.name  ? data.data[0].location.name  :'' ) + "</h2></figcaption></figure> </a>");
  });

</script>
