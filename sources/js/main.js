import fastclick from './_fastclick';
import fonts from './_fonts';

function init () {
  fastclick();
  fonts();
  featuredSlider();
  window.initMap = map;
}

init();
