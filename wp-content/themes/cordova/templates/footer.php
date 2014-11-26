<footer class="content-info footer-row" role="contentinfo">
	<div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
    <section>
    	<div class="row">
	    	<div class="col-sm-6 col-md-4 col-xs-12 hidden-xs hidden-sm">
		    	<h2> My about footer, yo.	</h2>
		    	<img class="img-center" src="http://placekitten.com/g/250/250" />
	    	</div>

	    	<div class="col-sm-6 col-md-4 col-xs-12 hidden-xs hidden-sm">
		    	<h2> Posts.	</h2>
		    	<p> Brooklyn nulla ut Etsy, mollit eu Intelligentsia mumblecore street art actually hashtag hella dolor Godard irure. Single-origin coffee letterpress photo booth banjo selfies Tumblr, Tonx skateboard commodo. Fanny pack kitsch ea Thundercats. Roof party Austin esse, you probably haven't heard of them labore quinoa consequat. Do placeat et, deserunt next level hella post-ironic dolore meh ex qui sunt freegan +1 voluptate. Kogi normcore ullamco do art party synth, excepteur pork belly farm-to-table odio raw denim. Pug excepteur selvage actually, street art lomo nostrud.</p>
	    	</div>

	    	<div class="col-sm-6 col-md-4 col-xs-12">
		    	<h3> Contact.</h3>
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

        $('.event-datepicker').datepicker({
            format: "mm/dd/yyyy"
        });

    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
//<![CDATA[

if(document.getElementById('googleMap')){

	var geocoder = new google.maps.Geocoder();
	var address = "San Diego, CA, 92111"; //Add your address here, all on one line.
	addresses = ["San Diego, CA 92111",
							 "Cancun, Mexico",
							 "Sydney, Australia"];

	var latitude;
	var longitude;
	var color = "#85cad1"; //Set your tint color. Needs to be a hex value.

	function getGeocode() {
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
	    		latitude = results[0].geometry.location.lat();
				longitude = results[0].geometry.location.lng();
				initGoogleMap();
	    	}
		});
	}

	function initGoogleMap() {
		var styles = [
		    {
		      stylers: [
		        { saturation: -100 }
		      ]
		    }
		];

		var options = {
			mapTypeControlOptions: {
				mapTypeIds: ['Styled']
			},
			center: new google.maps.LatLng(latitude, longitude),
			zoom: 2,
			scrollwheel: false,
			navigationControl: false,
			mapTypeControl: false,
			zoomControl: true,
			disableDefaultUI: true,
			mapTypeId: 'Styled'
		};
		var div = document.getElementById('googleMap');
		var map = new google.maps.Map(div, options);
		marker = new google.maps.Marker({
		    map:map,
		    draggable:false,
		    animation: google.maps.Animation.DROP,
		    position: new google.maps.LatLng(latitude,longitude)
		});
		var styledMapType = new google.maps.StyledMapType(styles, { name: 'Styled' });
		map.mapTypes.set('Styled', styledMapType);

		var infowindow = new google.maps.InfoWindow({
		      content: "<div class='iwContent'>"+address+"</div>"
		});
		google.maps.event.addListener(marker, 'click', function() {
		    window.location = "http://local.wordpress.dev/blog";
		});
		google.maps.event.addListener(marker, 'mouseover', function() {
		    infowindow.open(map,marker);
		});


		bounds = new google.maps.LatLngBounds(
		  new google.maps.LatLng(-84.999999, -179.999999),
		  new google.maps.LatLng(84.999999, 179.999999));

		rect = new google.maps.Rectangle({
		    bounds: bounds,
		    fillColor: color,
		    fillOpacity: 0.2,
		    strokeWeight: 0,
		    map: map
		});

		var listener = google.maps.event.addListener(map, "idle", function() {
			$('#map-banner').show();
			$("#map-header").fitText(1.2, { minFontSize: '20px', maxFontSize: '400px'});
		  google.maps.event.removeListener(listener);
		});

	}
	google.maps.event.addDomListener(window, 'load', getGeocode);
//]]>
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
