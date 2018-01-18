function logout() {
    $.ajax("//guard.neetgroup.net/actions/logout.php").done(function() {
        window.location = 'https://guard.neetgroup.net/login.doc';
    });
}

$('.input.button#continue').click(function() {
    $('.input.button#continue').hide();
    $('.dialog.panel.wrapper').show();
    setTimeout(logout, 2500);
});