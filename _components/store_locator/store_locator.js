(function storeLocator () {

  let map = null;
  const mapElement = document.querySelector('.store-locator--map');
  // get options passed from php
  const options = JSON.parse(mapElement.dataset.options);

  let args = {
    center: options.center || {
      lat: -34.397,
      lng: 150.644
    },
    zoom: options.zoom || 9,
    scrollwheel: options.scrollwheel === undefined ? true : options.scrollwheel
  };

  initMap();

  function initMap () {
    map = new google.maps.Map(mapElement, args);
  }


})();
