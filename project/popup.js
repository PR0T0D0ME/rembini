   $(function() {
  $('button', 'div.popup').on('click', function() {
    var $$ = $(this),
        $body = $('body');
    
    $body.data('index', $body.data('index') - 1);
    $$.parent().remove();
  });
  
  $('span[data-popup]').on('click', function() {
    var $$ = $(this),
        $body = $('body'),
        $popup = $('div.popup').first().clone(true);
    
    if (!$body.data('index')) {
      $body.data('index', 999);
    } else {
      $body.data('index', $body.data('index') + 1);
    }
    
    $popup
      .appendTo($('body'))
      .show()
      .find('span')
      .text($$.data('popup'))
      .parent()
      .css({
        'top': $$.offset().top,
        'left': $$.offset().left,
        'z-index': $body.data('index')
      });
  });
  
});