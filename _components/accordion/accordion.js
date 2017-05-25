(function _accordion($) {
  $('.accordion .accordion-item h4').on('click', function() {
    $(this).closest('.accordion').find('.accordion-item h4 svg #vertical').stop().fadeIn().closest('.accordion-item').find('> div').stop().slideUp();
    if (!$(this).find('+ div').is(':visible')) $(this).find('svg #vertical').stop().fadeOut();
    $(this).find('+ div').stop().slideToggle();
  });
})(jQuery);
