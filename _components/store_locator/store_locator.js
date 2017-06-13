import _throttle from 'lodash/throttle';

(function storeLocator () {
  let map = null;
  let markers = [];
  let autocomplete;
  let countryRestrict = { country: 'au'};

  const mapElement = document.querySelector('.store-locator--map');
  const markerElements = Array.from(document.querySelectorAll('.store-locator--map .store-locator--marker'));
  const resultsElement = document.querySelector('.store-locator--results');
  const autocompleteElement = document.querySelector('.store-locator--inputs--location input');

  // get options passed from php
  const options = JSON.parse(mapElement.dataset.options);

  let args = {
    center: options.center || {
      lat: -28.076406,
      lng: 153.443729
    },
    zoom: options.zoom || 14,
    scrollwheel: options.scrollwheel === undefined ? true : options.scrollwheel,
    draggable: options.draggable || false,
    disableDefaultUI: options.disableDefaultUI || false
  };

  function initMap () {
    map = new google.maps.Map(mapElement, args);
    markerElements.forEach(markerEl => addMarker(markerEl, map));
    initAutocomplete();
    addListeners();

    // Try HTML5 geolocation.
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        const pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };
        map.panTo(pos);
      }, (err) => console.log('Geolocation failed', err));
    } else {
      // Browser doesn't support Geolocation
      console.log('Browser doesn\'t support Geolocation');
    }
  }

  function initAutocomplete () {
    autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */ (autocompleteElement), {
        types: ['(regions)'],
        componentRestrictions: countryRestrict
    });
  }

  function addListeners () {
    map.addListener('bounds_changed', _throttle(updateVisible, 200));
    autocomplete.addListener('place_changed', onPlaceChanged);
  }

  function onPlaceChanged() {
    var place = autocomplete.getPlace();
    if (place.geometry) {
      map.panTo(place.geometry.location);
      map.setZoom(args.zoom);
    } else {
      autocompleteElement.placeholder = 'Enter a city';
    }
  }

  function updateVisible () {
    const bounds = map.getBounds();
    markers.forEach(marker => {
      const isVisible = bounds.contains(marker.getPosition());
      marker.setVisible(isVisible);
      if (!isVisible) marker.infowindow.close();
    });
    renderResults();
  }

  function renderResults () {
    let results = [];
    markers.forEach(marker => {
      if (!marker.visible) return;
      let markerHTML = `
        <div class="store-locator--results--item">
          ${marker.infowindow.content}
        </div>
      `;
      results.push(markerHTML);
    });
    resultsElement.innerHTML = results.join('');
  }

  function addMarker( markerEl, map ) {
    const center = JSON.parse(markerEl.dataset.center);
    const latlng = new google.maps.LatLng( center.lat, center.lng );
    const marker = new google.maps.Marker({
      position: latlng,
      map: map
    });
    markers.push( marker );
    if( markerEl.innerHTML ) {
      marker.infowindow = new google.maps.InfoWindow({
        content: markerEl.innerHTML
      });
      google.maps.event.addListener(marker, 'click', function() {
        marker.infowindow.open( map, marker );
      });
    }
  }

  initMap();
})();
