$tabs = [];
$('li.interface.tab').each(function() { // populate tabs array
    $tabs.push($(this).prop('id'));
});
$tabs.forEach(function(id) { // hide tab content on load
    $('div.interface.tab.input#' + id).hide();
});
if (!$('li.interface.tab.active').length) { // if no tab selected
    $('li.interface.tab#' + $tabs[0]).active( true );
    $('div.interface.tab.input#' + $tabs[0]).show();
}
$('li.interface.tab').click(function() {
    $('li.interface.tab.active').active( false );
    $tabs.forEach(function(id) { // hide all tab content
        $('div.interface.tab.input#' + id).hide();
    });
    $tab = $(this).prop('id');
    $('li.interface.tab#' + $tab).active( true );
    $('div.interface.tab.input#' + $tab).show();
});