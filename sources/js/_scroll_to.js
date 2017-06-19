/**
 *
 * HOW TO USE:
 *
 * Just add the data attribute "data-scroll-target" to an element
 * Set it with a jQuery selector (#elem | .elem | .elem:nth-child(4))
 * If multiple elements found we will just animate to the first element in the dom
 *
 */

const $ = jQuery

export default () => {
  $(function() {
    $('*[data-scroll-target]').each(function() {
      $(this).on('click', function() {
        var $target = $($(this).data('scroll-target'))
        if ($target.length > 1) $target = $target.first()
        $('html, body').animate({ scrollTop: $target.offset().top }, 1000)
      })
    })
  })
}
