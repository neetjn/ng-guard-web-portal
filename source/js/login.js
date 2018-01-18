$('.input.button#login').click(function() {
    $(".input.button#login").state( false );
    $username = $('.input.textbox#username').val();
    $password = $('.input.textbox#password').val();
    $params =
    {
        username: $username,
        password: $password
    };
    $.ajax({
        url: "//guard.neetgroup.net/actions/login.php",
        type: "POST",
        data: $params,
        success: function(data, textStatus, jqXHR)
        {
            $result = jQuery.parseJSON(data);
            if ($result.result) {
                $.cookie('GUARD_SAVEU', $username);
                window.alert($result.result);
                $('.login.panel.wrapper').hide();
                $('.dialog.panel.wrapper').show();
                setTimeout(function() {
                    window.location = "https://guard.neetgroup.net/home.doc";
                }, 2500);
            } else {
                window.alert($result.error);
                $(".input.button#login").state( true );
                return;
            }
        }
    });
});

$('.input.button#register').click(function() {
    $username = $('.input.textbox#username').val();
    if ($username) {
        window.location = ("https://guard.neetgroup.net/register.doc+" + $username);
    } else {
        window.location = "https://guard.neetgroup.net/register.doc";
    }
});