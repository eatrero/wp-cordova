<footer class="content-info footer-row" role="contentinfo">
	<div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <section>
    	<div class="row">
	    	<div class="col-sm-6 col-md-4 col-xs-12 hidden-xs hidden-sm">
		    	<h3> My about footer, yo.	</h3>
		    	<img class="img-responsive" src="//placekitten.com/g/300/200" />
	    	</div>

	    	<div class="col-sm-6 col-md-4 col-xs-12 hidden-xs hidden-sm">
	    	  <article class="col-sm-11">
  		    	<h3> Recent Posts	</h3>
	  	    	<p>Brooklyn nulla ut Etsy, mollit eu Intelligentsia mumblecore street art actually hashtag hella dolor Godard irure. Single-origin coffee letterpress photo booth banjo selfies Tumblr, Tonx skateboard commodo. Fanny pack kitsch ea Thundercats. Roof party Austin esse, you probably haven't heard of them labore quinoa consequat. Do placeat et, deserunt next level hella post-ironic dolore meh ex qui sunt freegan +1 voluptate. Kogi normcore ullamco do art party synth, excepteur pork belly farm-to-table odio raw denim. Pug excepteur selvage actually, street art lomo nostrud.</p>
	  	    </article>
	    	</div>

	    	<div class="col-sm-6 col-md-4 col-xs-12">
		    	<h3> Contact Nathan</h3>
		    	<div class="contact-form">
  		    	<?php gravity_form(1, false, false, false, '', true); ?>
  		    </div>
	    	</div>
    	</div>
    </section>

    <div class="copyright-text">©2014 Nathan Cordova. Site Design by <a href="http://beastco.de">BEASTCODE.</a></p>
  </div>

</footer>

<script type="text/javascript">
    // When the document is ready
    $(document).ready(function () {

/*        $('.event-datepicker').datepicker({
            format: "mm/dd/yyyy"
        });
*/
        $( ".event-datepicker" ).datepicker();

    });
</script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
//<![CDATA[

if(document.getElementById('googleMap')){

  var map;
	var color = "#85cad1"; //Set your tint color. Needs to be a hex value.
  var styles = [
      {
        stylers: [
          { saturation: -100 }
        ]
      }
  ];
  var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });

  var myOptions = {
			mapTypeControlOptions: {
				mapTypeIds: ['Styled']
			},
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
      zoom: 2,
      center: new google.maps.LatLng(0, 0),
			zoomControl: true,
			disableDefaultUI: true,
			mapTypeId: 'Styled'
  };
  var addresses;

  var div = document.getElementById('googleMap');

  map = new google.maps.Map($(div)[0], myOptions);
  map.mapTypes.set('Styled', styledMapType);
	var	bounds = new google.maps.LatLngBounds(
		  new google.maps.LatLng(-84.999999, -179.999999),
		  new google.maps.LatLng(84.999999, 179.999999));

  rect = new google.maps.Rectangle({
      bounds: bounds,
      fillColor: color,
      fillOpacity: 0.2,
      strokeWeight: 0,
      map: map
  });

  addresses = [
    <?php
    $locations = cordova_get_locations();
      foreach ( $locations as $location ) :
    ?>
      "<?php echo $location['location']; ?>",
    <?php endforeach;
    ?>
  ];

	var urls = [
    <?php
      foreach ( $locations as $location ) :
    ?>
      "<?php echo $location['url']; ?>",
    <?php endforeach;
    ?>
  ];

  var	feat_images  = [
      <?php
        foreach ( $locations as $location ) :
      ?>
        "<?php echo $location['feat_image']; ?>",
      <?php endforeach;
      ?>
    ];


  console.log(urls);

  for (var i = 0; i < addresses.length; i++) {

    function inline(i) {
      $.getJSON('//maps.googleapis.com/maps/api/geocode/json?address='+addresses[i]+'&sensor=false', null, function (data) {
        var p = data.results[0].geometry.location
        var latlng = new google.maps.LatLng(p.lat, p.lng);
        var marker = new google.maps.Marker({
            position: latlng,
            map: map
        });
        google.maps.event.addListener(marker, 'click', function() {
            window.location = urls[i];
        });

        var infowindow = new google.maps.InfoWindow({
//              content: "<div class='iwContent'>"+addresses[i]+"</div>"
                content: "<a href='"+ urls[i] +  "'><img src=" + feat_images[i]  + " width='100' /></a>"
        });
        google.maps.event.addListener(marker, 'mouseover', function() {
            infowindow.open(map,marker);
        });

      });
    }
    inline(i);
  }
}
</script>
<script>

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
	$("[id='input_1_3']").after('<span class="input-group-btn"><button type="button" class="btn btn-calendar" ng-click="setEventDate($event)"><i class="glyphicon glyphicon-calendar"></i></button></span>');
	$("[id='gform_submit_button_1']").addClass('btn btn-block btn-homepage');

  $('.dropdown-toggle').attr('role','button');
  $('.contact-form').show();

</script>
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
</style>
