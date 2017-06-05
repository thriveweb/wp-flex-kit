(function simple_header ($) {
  var is_mobile = $(window).width() <= 1000
  const $nav = $('header nav')

  // hamburger icon
  const $burger = $('#hamburger')
  $(window).on('click', function(e) {
    if (is_mobile && !$(e.target).closest('header').length && $nav.is(':visible')) $burger.trigger('click');
  });
  $burger.on('click', function() {
    $(this).toggleClass('change'), $nav.slideToggle()
  });

  $(window).on('resize', function() {
    is_mobile = $(window).width() <= 1000
    if (!is_mobile) { if (!$nav.is(':visible')) $nav.show() }
    else $nav.hide(), $burger.removeClass('change');
  })

  // submenu handler
  const $nav_children = $nav.find('li.menu-item-has-children')
  if ($nav_children.length) {
    $nav_children.each(function(i, elem) {
      $(this).find('> a').bind('click', function(e) {
        e.preventDefault(), $(elem).find('.sub-menu').slideToggle();
      })
      $(window).on('click', function(e) {
        if ($(e.target).parents('li.menu-item-has-children').length === 0) $(elem).find('.sub-menu').slideUp();
      })
    })
  }
})(jQuery)
