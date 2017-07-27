'use strict';


(function() {
  var elem = document.querySelector('.grid');
  if (elem) {
    const Masonry = require('masonry-layout');
    //const imagesLoaded = require('imagesloaded');
    var msnry = new Masonry(elem, {
      columnWidth: '.grid-sizer',
      percentPosition: true,
      itemSelector: '.grid-item',
    });
  }
}());
