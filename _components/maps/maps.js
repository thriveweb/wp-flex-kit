const $ = jQuery;

function new_map( $el ) {
	const $markers = $el.find('.marker');
	const args = {
		center: new google.maps.LatLng(0, 0),
		mapTypeId	: google.maps.MapTypeId.ROADMAP,
		draggable: false,
		disableDefaultUI: true,
		scrollwheel: false,
		styles: [{'featureType': 'administrative','elementType': 'all','stylers': [{'visibility': 'on'},{'saturation': -100},{'lightness': 20}]},{'featureType': 'road','elementType': 'all','stylers': [{'visibility': 'on'},{'saturation': -100},{'lightness': 40}]},{'featureType': 'water','elementType': 'all','stylers': [{'visibility': 'on'},{'saturation': -10},{'lightness': 30}]},{'featureType': 'landscape.man_made','elementType': 'all','stylers': [{'visibility': 'simplified'},{'saturation': -60},{'lightness': 10}]},{'featureType': 'landscape.natural','elementType': 'all','stylers': [{'visibility': 'simplified'},{'saturation': -60},{'lightness': 60}]},{'featureType': 'poi','elementType': 'all','stylers': [{'visibility': 'off'},{'saturation': -100},{'lightness': 60}]},{'featureType': 'transit','elementType': 'all','stylers': [{'visibility': 'off'},{'saturation': -100},{'lightness': 60}]}],
		zoom: 14,
	};
	const map = new google.maps.Map( $el[0], args);
	map.markers = [];
	$markers.each(function(){
		add_marker( $(this), map );
	});
	center_map( map );
	window.addEventListener('resize', () => center_map( map ));
	return map;
}

function add_marker( $marker, map ) {
	const latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	const marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});
	map.markers.push( marker );
	if( $marker.html() ) {
		const infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.open( map, marker );
		});
	}
}

function center_map( map ) {
	const bounds = new google.maps.LatLngBounds();
	$.each( map.markers, function( i, marker ){
		const latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
		bounds.extend( latlng );
	});
	if( map.markers.length === 1 ) {
		map.setCenter( bounds.getCenter() );
		map.setZoom( 14 );
	} else {
		map.fitBounds( bounds );
	}

	// Recentering map
	// map.panBy(-((window.innerWidth / 2) / 3), 0)

}

(function singleInitMap($) {
	window.singleInitMap = function () {
		$('.cp-map').each(function(){
			new_map( $(this) );
		})
	}
})(jQuery)
