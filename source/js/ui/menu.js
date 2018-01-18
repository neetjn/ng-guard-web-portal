$items = [];
$('li.interface.menu.item').each(function() {
    $items.push($(this).prop('id'));
});
$items.forEach(function(id) { // hide all menu content
    $('div.interface.menu.input#' + id).hide();
});
if (!$('.interface.menu.item.active').length) { // if no item selected
    $('li.interface.menu.item#' + $items[0]).active( true );
    $('div.interface.menu.input#' + $items[0]).show();
}
$('li.interface.menu.item').click(function(){
    $('li.interface.menu.item.active').active( false );
    $items.forEach(function(id){
        $('div.interface.menu.input#' + id).hide();
        $('div.interface.menu.input#' + id).hide();
    });
    $item = $(this).prop('id');
    $('li.interface.menu.item#' + $item).active( true );
    $('div.interface.menu.input#' + $item).show();
});
