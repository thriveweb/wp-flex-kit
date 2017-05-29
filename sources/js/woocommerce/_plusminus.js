const $ = jQuery

export default () => {
  if (!$('.plusminusbutton').length) return
  $('.plusminusbutton').on( 'click', function() {
    var oldValue = $(this).parent().find('.input-text.qty').val(),
    newVal = 0;
    if ($(this).hasClass('plus')) newVal = parseFloat(oldValue) + 1;
    else if (oldValue > 0) newVal = parseFloat(oldValue) - 1;
    $(this).parent().find('.input-text.qty').val(newVal).trigger('input');
  })
}
