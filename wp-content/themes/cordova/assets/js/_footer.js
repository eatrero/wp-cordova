/**
 * Created by edatrero on 12/7/14.
 */
var _ = require('underscore');
var map;
function inline(location) {
  $.getJSON('//maps.googleapis.com/maps/api/geocode/json?address='+ location.location +'&sensor=false', null, function (data) {
    console.log(data);
    console.log(location);
    var p = data.results[0].geometry.location;
    var latlng = new google.maps.LatLng(p.lat, p.lng);
    var marker = new google.maps.Marker({
      position: latlng,
      map: map
    });
    google.maps.event.addListener(marker, 'click', function() {
      window.location = location.url;
      console.log(location.url);
    });

    var infowindow = new google.maps.InfoWindow({
//              content: "<div class='iwContent'>"+addresses[i]+"</div>"
      content: "<a href='"+ location.url +  "'><img src=" + location.feat_image + " width='100' /></a>"
    });
    google.maps.event.addListener(marker, 'mouseover', function() {
      infowindow.open(map,marker);
    });

  });
}

if(document.getElementById('googleMap')){

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
    zoom: 3,
    center: new google.maps.LatLng(35, -97.7),
    zoomControl: true,
    disableDefaultUI: true,
    mapTypeId: 'Styled'
  };

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

  myLocations.map(function(location){
    inline(location);
  });
}
