'use strict';

(function($) {

  $('.dropdown-link').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('clicked')
    $(this).parent().find('.taxonomy-filter ul').toggleClass('open');
  })

}(jQuery));
